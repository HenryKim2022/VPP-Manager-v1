<?php

namespace App\Http\Controllers\UserPanels\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Projects_Model;
use App\Models\DaftarDWS_Model;
use App\Models\Kustomer_Model;
use App\Models\Team_Model;
use App\Models\Karyawan_Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


class ProjectsController extends Controller
{
    public function index(Request $request)
    {
        $process = $this->setPageSession("Manage Projects", "m-projects");
        if ($process) {
            $loadDaftarProjectsFromDB = [];
            $loadDaftarProjectsFromDB = Projects_Model::with(['client', 'team', 'dailyws'])->withoutTrashed()->get();

            $user = auth()->user();
            $authenticated_user_data = Karyawan_Model::with('daftar_login.karyawan', 'daftar_login_4get.karyawan', 'jabatan.karyawan')->find($user->id_karyawan);

            // $user = auth()->user();
            // $authenticated_user_data = Karyawan_Model::with('daftar_login.karyawan', 'jabatan.karyawan')->find($user->id_karyawan);

            $modalData = [
                'modal_add' => '#add_projectModal',
                'modal_edit' => '#editprojectModal',
                'modal_delete' => '#delete_projectModal',
                'modal_reset' => '#reset_projectModal',
            ];

            $data = [
                'loadDaftarProjectsFromDB' => $loadDaftarProjectsFromDB,
                'modalData' => $modalData,
                'client_list' => Kustomer_Model::withoutTrashed()->get(),
                'team_list' => Team_Model::withoutTrashed()->get(),
                'dailyws_list' => DaftarDWS_Model::withoutTrashed()->get(),

                'authenticated_user_data' => $authenticated_user_data,
            ];
            return $this->setReturnView('pages/userpanels/pm_daftarproject', $data);
        }
    }



    public function add_project(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'project-id' => [
                    'sometimes',
                    'required',
                    'string',
                    Rule::unique('tb_projects', 'id_project')->ignore($request->input('project-id'), 'id_project')->whereNull('deleted_at')
                ],
                'project-name'  => 'sometimes|required'

            ],
            [
                'project-id' => 'The project-id field is required.',
                'project-name' => 'The project-name field is required.'
            ]
        );

        if ($validator->fails()) {
            $toast_message = $validator->errors()->all();
            Session::flash('errors', $toast_message);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Perform the uniqueness check before saving the record
        if (Projects_Model::withTrashed()->where('id_project', $request->input('project-id'))->exists()) {
            $toast_message = ['The project-id has already been taken.'];
            Session::flash('n_errors', $toast_message);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $inst = new Projects_Model();
        $inst->id_project = $request->input('project-id');
        $inst->na_project = $request->input('project-name');
        $inst->id_client = $request->input('client-id');

        Session::flash('success', ['Project added successfully!']);
        $inst->save();
        return redirect()->back();
    }



    public function get_project(Request $request)
    {
        $prjID = $request->input('prjID');
        $prjName = $request->input('prjName');
        $clientID = $request->input('clientID');

        $daftarProjects = Projects_Model::where('id_project', $prjID)->first();
        if ($daftarProjects) {
            if ($daftarProjects->id_client) {
                $daftarProjects->load('client');
            }
            $ourClients = $daftarProjects->client;
            $clientList = [];
            if ($ourClients) {
                $clientList = Kustomer_Model::all()->map(function ($o_client) use ($ourClients) {
                    $selected = ($o_client->id_client == $ourClients->id_client);
                    return [
                        'value' => $o_client->id_client,
                        'text' => $o_client->na_client,
                        'selected' => $selected,
                    ];
                });
            } else {
                $clientList = Kustomer_Model::withoutTrashed()->get()->map(function ($o_client) {
                    return [
                        'value' => $o_client->id_client,
                        'text' => $o_client->na_client,
                        'selected' => false,
                    ];
                });
            }

            // Return queried data as a JSON response
            return response()->json([
                'id_project' => $prjID,
                'na_project' => $daftarProjects->na_project,
                'id_client' => $clientID,
                'clientList' => $clientList,
            ]);

        } else {
            // Handle the case when the Jabatan_Model with the given jabatanID is not found
            return response()->json(['error' => 'Project_Model not found'], 404);
        }

    }




    public function edit_project(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'username'  => [
                    'sometimes',
                    'required',
                    'string',
                    Rule::unique('tb_daftar_login', 'username')->ignore($request->input('user_id'), 'user_id')
                ],
                'email'     => [
                    'sometimes',
                    'required',
                    'email',
                    Rule::unique('tb_daftar_login', 'email')->ignore($request->input('user_id'), 'user_id')
                ],
                // 'new-password'          => 'required|min:6',
                // 'confirm-new-password'  => 'required|same:new-password',
            ],
            [
                'username.required'  => 'The username field is required.',
                'email.required' => 'The email field is required.',
                // 'new-password.required' => 'The new-password field is required.',
                // 'confirm-new-password.required' => 'The password-confirmation field is required.',
            ]
        );

        if ($validator->fails()) {
            $toast_message = $validator->errors()->all();
            Session::flash('errors', $toast_message);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $daftarLogin = DaftarLogin_Model::find($request->input('user_id'));
        if ($daftarLogin) {
            $daftarLogin->username = $request->input('username');
            $daftarLogin->email = $request->input('email');

            if ($request->input('new-password')){
                $daftarLogin->password = bcrypt($request->input('new-password'));
            }

            $daftarLogin->type = $request->input('type');
            $daftarLogin->save();

            $authenticated_user_data = DaftarLogin_Model::find($daftarLogin->user_id);      // Re-auth after saving
            $user = auth()->user();
            $authenticated_user_data = Karyawan_Model::with('daftar_login.karyawan', 'jabatan.karyawan')->find($user->id_karyawan);
            Session::put('authenticated_user_data', $authenticated_user_data);

            Session::flash('success', ['Your account data was updated!']);
        } else {
            Session::flash('errors', ['Err[404]: Failed to update user account!']);
        }

        return redirect()->back();
    }






}
