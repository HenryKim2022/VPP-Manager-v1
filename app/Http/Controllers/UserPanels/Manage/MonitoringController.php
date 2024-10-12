<?php

namespace App\Http\Controllers\UserPanels\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karyawan_Model;
use App\Models\Projects_Model;
use App\Models\DaftarDWS_Model;
use App\Models\Monitoring_Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


class MonitoringController extends Controller
{
    //
    public function index(Request $request)
    {
        $process = $this->setPageSession("Manage Project Monitoring", "m-prj/m-monitoring-worksheet/mondws");
        if ($process) {
            $loadDaftarMonDWSFromDB = [];
            $loadDaftarMonDWSFromDB = Projects_Model::with('client', 'team', 'monitor', 'dailyws')->find($request->input('projectID'));

            $user = auth()->user();
            $authenticated_user_data = Karyawan_Model::with('daftar_login.karyawan', 'daftar_login_4get.karyawan', 'jabatan.karyawan')->find($user->id_karyawan);

            // // $modalData = [
            // //     'modal_add' => '#add_projectModal',
            // //     'modal_edit' => '#editprojectModal',
            // //     'modal_delete' => '#delete_projectModal',
            // //     'modal_reset' => '#reset_projectModal',
            // // ];

            $data = [
                'loadDaftarMonDWSFromDB' => $loadDaftarMonDWSFromDB,
                // 'modalData' => $modalData,
                // 'client_list' => Kustomer_Model::withoutTrashed()->get(),
                // 'team_list' => Team_Model::withoutTrashed()->get(),
                // 'dailyws_list' => DaftarDWS_Model::withoutTrashed()->get(),

                'authenticated_user_data' => $authenticated_user_data,
            ];
            return $this->setReturnView('pages/userpanels/pm_mondws', $data);
        }
    }

}
