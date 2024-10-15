<?php

namespace App\Http\Controllers\UserPanels\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DaftarLogin_Model;
use App\Models\Karyawan_Model;
use App\Models\DaftarDWS_Model;
use App\Models\Monitoring_Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\SoftDeletes;


class WorksheetController extends Controller
{
    //
    public function index($monitoringId)
    {
        $process = $this->setPageSession("Manage Daily Worksheet", "m-worksheet");
        if ($process) {
            // $loadDaftarWorksheetFromDB = [];
            // $loadDaftarWorksheetFromDB = DaftarLogin_Model::with(['karyawan'])->withoutTrashed()->get();
            // $loadDataDailyWS = Monitoring_Model::with(['karyawan', 'project', 'dailyws'])
            // ->findOrFail($monitoringId);


            $loadDataDailyWS = Monitoring_Model::with('karyawan', 'project', 'dailyws')->where('id_monitoring', $monitoringId)->first();


            $user = auth()->user();
            $authenticated_user_data = Karyawan_Model::with('daftar_login.karyawan', 'jabatan.karyawan')->find($user->id_karyawan);

            // $modalData = [
            //     'modal_add' => '#add_userModal',
            //     'modal_edit' => '#edit_userModal',
            //     'modal_delete' => '#delete_userModal',
            //     'modal_reset' => '#reset_userModal',
            // ];

            $data = [
                // 'loadDaftarWorksheetFromDB' => $loadDaftarWorksheetFromDB,
                // 'modalData' => $modalData,
                'loadDataDailyWS' => $loadDataDailyWS,
                'employee_list' => Karyawan_Model::withoutTrashed()->get(),
                'authenticated_user_data' => $authenticated_user_data,
            ];
            return $this->setReturnView('pages/userpanels/pm_dataworksheet', $data);
        }
    }



}
