<?php

namespace App\Http\Controllers\UserPanels\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

class EngTeamController extends Controller
{
    //
    public function index(Request $request)
    {
        $process = $this->setPageSession("Manage Teams", "m-teams");
        if ($process) {
            $loadDaftarTeamFromDB = [];
            $loadDaftarTeamFromDB = Team_Model::withoutTrashed()->get();

            $user = auth()->user();
            $authenticated_user_data = Karyawan_Model::with('daftar_login.karyawan', 'daftar_login_4get.karyawan', 'jabatan.karyawan')->find($user->id_karyawan);

            $modalData = [
                'modal_add' => '#add_teamModal',
                'modal_edit' => '#edit_teamModal',
                'modal_delete' => '#delete_teamModal',
                'modal_reset' => '#reset_teamModal',
            ];

            $data = [
                'loadDaftarTeamFromDB' => $loadDaftarTeamFromDB,
                'modalData' => $modalData,
                'employee_list' => Karyawan_Model::withoutTrashed()->get(),
                'authenticated_user_data' => $authenticated_user_data,
            ];
            return $this->setReturnView('pages/userpanels/pm_daftarteam', $data);
        }
    }




    public function add_team(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'team-karyawan-id'  => 'required',
            ],
            [
                'team-karyawan-id' => 'The employee field is required.',
            ]
        );
        if ($validator->fails()) {
            $toast_message = $validator->errors()->all();
            Session::flash('errors', $toast_message);
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $id_karyawan = $request->input('team-karyawan-id');
        if ($id_karyawan) {          // IF Check-in
            $teams = new Team_Model();
            $teams->na_team = $request->input('team-name');
            $teams->id_karyawan = $id_karyawan;
            $teams->save();

            $authenticated_user_data = Team_Model::find($teams->user_id);      // Re-auth after saving
            $user = auth()->user();
            $authenticated_user_data = Karyawan_Model::with('daftar_login.karyawan', 'jabatan.karyawan')->find($user->id_karyawan);
            Session::put('authenticated_user_data', $authenticated_user_data);

            Session::flash('success', ['Team added successfully!']);
        }
        return redirect()->back();
    }


    public function get_team(Request $request)
    {
        $timID = $request->input('timID');
        $karyawanID = $request->input('karyawanID');

        $daftarTim = Team_Model::where('id_team', $timID)->first();
        if ($daftarTim) {
            if ($daftarTim->id_karyawan) {
                $daftarTim->load('karyawan');
            }
            $karyawan = $daftarTim->karyawan;
            $employeeList = [];
            if ($karyawan) {
                $employeeList = Karyawan_Model::all()->map(function ($user) use ($karyawan) {
                    $selected = ($user->id_karyawan == $karyawan->id_karyawan);
                    return [
                        'value' => $user->id_karyawan,
                        'text' => $user->na_karyawan,
                        'selected' => $selected,
                    ];
                });
            } else {
                $employeeList = Karyawan_Model::withoutTrashed()->get()->map(function ($user) {
                    return [
                        'value' => $user->id_karyawan,
                        'text' => $user->na_karyawan,
                        'selected' => false,
                    ];
                });
            }

            // Return queried data as a JSON response
            return response()->json([
                'id_team' => $timID,
                'na_team' => $daftarTim->na_team,
                'id_karyawan' => $karyawanID,
                'employeeList' => $employeeList,
            ]);
        } else {
            // Handle the case when the Team_Model with the given timID is not found
            return response()->json(['error' => 'Team_Model not found'], 404);
        }
    }


    public function edit_team(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'team_name'  => 'required',
                'bsvalidationcheckbox1'  => 'required',
            ],
            [
                'team_name' => 'The team name field is required.',
                'bsvalidationcheckbox1'  => 'The saving agreement field is required.',
            ]
        );
        if ($validator->fails()) {
            $toast_message = $validator->errors()->all();
            Session::flash('errors', $toast_message);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $tim = Team_Model::find($request->input('team_id'));
        if ($tim) {
            $tim->na_team = $request->input('team_name');
            $id_karyawan = $request->input('edit-team-karyawan-id');
            $tim->id_karyawan = $id_karyawan;
            $tim->save();

            $user = auth()->user();
            $authenticated_user_data = Karyawan_Model::with('daftar_login.karyawan', 'jabatan.karyawan')->find($user->id_karyawan);
            Session::put('authenticated_user_data', $authenticated_user_data);

            Session::flash('success', ['Team updated successfully!']);
            return Redirect::back();
        } else {
            Session::flash('errors', ['Err[404]: Team update failed!']);
        }
    }




    public function delete_team(Request $request)
    {
        $timID = $request->input('team_id');
        $tim = Team_Model::with('karyawan')->where('id_team', $timID)->first();
        if ($tim) {
            $tim->delete();

            $authenticated_user_data = Team_Model::find($tim->id_team);      // Re-auth after saving
            $user = auth()->user();
            $authenticated_user_data = Karyawan_Model::with('daftar_login.karyawan', 'jabatan.karyawan')->find($user->id_karyawan);
            Session::put('authenticated_user_data', $authenticated_user_data);

            Session::flash('success', ['Team deletion successful!']);
        } else {
            Session::flash('errors', ['Err[404]: Team deletion failed!']);
        }
        return redirect()->back();
    }

    public function reset_team(Request $request)
    {
        Team_Model::query()->delete();
        DB::statement('ALTER TABLE tb_eng_team AUTO_INCREMENT = 1');

        $user = auth()->user();
        $authenticated_user_data = Karyawan_Model::with('daftar_login.karyawan', 'jabatan.karyawan')->find($user->id_karyawan);
        Session::put('authenticated_user_data', $authenticated_user_data);

        Session::flash('success', ['All team data reset successfully!']);
        return redirect()->back();
    }


}
