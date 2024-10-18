<?php

namespace App\Http\Controllers\UserPanels\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Projects_Model;
use App\Models\Monitoring_Model;
use App\Models\DaftarWS_Model;
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
            $loadDaftarProjectsFromDB = Projects_Model::with(['karyawan', 'client', 'team', 'worksheet', 'monitor'])->withoutTrashed()->get();


            $user = auth()->user();
            $authenticated_user_data = Karyawan_Model::with('daftar_login.karyawan', 'daftar_login_4get.karyawan', 'jabatan.karyawan')->find($user->id_karyawan);

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
                'co_auth' =>  [$authenticated_user_data->id_karyawan, $authenticated_user_data->na_karyawan],
                'worksheet_list' => DaftarWS_Model::withoutTrashed()->get(),
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

        // dd($request->input('co-id'));

        $inst = new Projects_Model();
        $inst->id_project = $request->input('project-id');
        $inst->na_project = $request->input('project-name');
        $inst->id_client = $request->input('client-id');
        $inst->id_karyawan = $request->input('co-id');
        $inst->id_team = $request->input('team-id');


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
            // Handle the case when the Jabatan_Model with the given projectID is not found
            return response()->json(['error' => 'Project_Model not found'], 404);
        }
    }




    public function edit_project(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'edit-project-id'  => [
                    'sometimes',
                    'required',
                    'string',
                    Rule::unique('tb_projects', 'id_project')->ignore($request->input('edit-project-id'), 'id_project')
                ],
                'bsvalidationcheckbox1' => 'required',

            ],
            [
                'edit-project-id.required'  => 'The project-id field is required.',
                'bsvalidationcheckbox1.required' => 'The saving agreement field is required.',

            ]
        );
        if ($validator->fails()) {
            $toast_message = $validator->errors()->all();
            Session::flash('errors', $toast_message);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $prj = Projects_Model::find($request->input('e-project-id'));
        if ($prj) {
            $prj->id_project = $request->input('edit-project-id');
            $prj->na_project = $request->input('edit-project-name');
            $clientID = $request->input('edit-client-id');
            $prj->id_client = $clientID;
            $prj->save();

            $user = auth()->user();
            $authenticated_user_data = Karyawan_Model::with('daftar_login.karyawan', 'jabatan.karyawan')->find($user->id_karyawan);
            Session::put('authenticated_user_data', $authenticated_user_data);

            Session::flash('success', ['Project updated successfully!']);
            return Redirect::back();
        } else {
            Session::flash('errors', ['Err[404]: Project update failed!']);
        }

        return redirect()->back();
    }



    public function delete_project(Request $request)
    {
        $projectID = $request->input('project_id');
        $project = Projects_Model::with('client', 'team')->where('id_project', $projectID)->first();
        if ($project) {
            $project->delete();
            Session::flash('success', ['Project deletion successful!']);
        } else {
            Session::flash('errors', ['Err[404]: Project deletion failed!']);
        }
        return redirect()->back();
    }


    public function reset_project(Request $request)
    {
        Projects_Model::query()->delete();
        DB::statement('ALTER TABLE tb_projects AUTO_INCREMENT = 1');

        $user = auth()->user();
        $authenticated_user_data = Karyawan_Model::with('daftar_login.karyawan', 'jabatan.karyawan')->find($user->id_karyawan);
        Session::put('authenticated_user_data', $authenticated_user_data);

        Session::flash('success', ['All project data reset successfully!']);
        return redirect()->back();
    }


    // public function get_prjmondws(Request $request)
    // {
    //     if ($request->isMethod('post')) {
    //     } elseif ($request->isMethod('get')) {
    //         $loadDaftarMonDWSFromDB = Projects_Model::with('client', 'pcoordinator', 'team', 'monitor', 'worksheet')->find($request->input('projectID'));
    //         // Handle GET request if needed
    //         $user = auth()->user();
    //         $authenticated_user_data = Karyawan_Model::with('daftar_login.karyawan', 'daftar_login_4get.karyawan', 'jabatan.karyawan')->find($user->id_karyawan);

    //         $dwsRecords = $loadDaftarMonDWSFromDB;
    //         dd($dwsRecords->toArray());



    //         $data = [
    //             'loadDaftarMonDWSFromDB' => $loadDaftarMonDWSFromDB,
    //             'authenticated_user_data' => $authenticated_user_data,
    //         ];
    //         return $this->setReturnView('pages/userpanels/pm_mondws', $data);
    //         // return response()->json(['message' => 'GET request received'], 200);

    //     }
    // }





    public function get_prjmondws(Request $request)
    {
        $process = $this->setPageSession("Manage Projects", "m-projects");
        if ($process) {

            $projectId = $request->input('projectID');
            if (!$projectId) {
                return back()->with('error', 'Project ID is required.');
            }

            try {
                $project = Projects_Model::with(['client', 'pcoordinator', 'team', 'monitor', 'task', 'worksheet'])
                    ->findOrFail($projectId);

                // // $tree = $this->buildMonitoringTree($project);
                // $loadDataDailyWS = DaftarWS_Model::with('project', 'monitoring')->where('id_monitoring', $monitoringId)->first();
                // $clientData = $loadDataDailyWS->getClientData();
                // $loadRelatedDailyWS = Monitoring_Model::with('karyawan', 'project', 'worksheet')->where('id_monitoring', $monitoringId)->first();

                // dd($project->toarray());
                // $loadDataDailyWS = $project->worksheet->where('id_monitoring', $project->monitor->id_monitoring);
                // Retrieve all daily work statuses with the matching id_monitoring

                // $loadDataDailyWS = DaftarWS_Model::where('id_monitoring', $project->monitor[0]['id_monitoring'])->get();
                $user = auth()->user();
                $authenticatedUser = Karyawan_Model::with(['daftar_login.karyawan', 'daftar_login_4get.karyawan', 'jabatan.karyawan'])
                    ->findOrFail($user->id_karyawan);

                $loadDataDailyWS = [];
                if ($loadDataDailyWS) {
                    $loadDataDailyWS = DaftarWS_Model::where('id_project', $project->monitor[0]['id_project'])->get();
                }
                // dd($loadDataDailyWS);
                // $clientData = DaftarWS_Model::with('project', 'monitoring')->where('id_project', $project->monitor[0]['id_project'])->first()->getClientData();
                $data = [
                    'loadDaftarMonDWSFromDB' => $project, // Use the Eloquent model directly
                    'project' => $project,
                    'authenticated_user_data' => $authenticatedUser,
                    'loadDataDailyWS' => $loadDataDailyWS,
                    // 'clientData' => $clientData,
                ];

                return view('pages.userpanels.pm_mondws', $data);
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                return Session::flash('errors', ['Err[404]: Project not found!']);
            }
        }
    }



    // // Helper function to build the monitoring tree
    // private function buildMonitoringTree(Projects_Model $project): array
    // {
    //     $tree = [];
    //     foreach ($project->monitor as $monitor) {
    //         $node = [
    //             'text' => $monitor->task,
    //             'children' => [],
    //         ];

    //         foreach ($project->worksheet->where('id_monitoring', $monitor->id_monitoring) as $ws) {
    //             $node['children'][] = [
    //                 'text' => $ws->descb_dws, // Or any other relevant field
    //                 'id' => $ws->id_dws,       // Add an ID for better jstree management
    //                 'url' => route('worksheet.show', ['dwsId' => $dws->id_ws]),
    //             ];
    //         }
    //         $tree[] = $node;
    //     }
    //     return $tree;
    // }
    // // 'url' => 'x',



}
