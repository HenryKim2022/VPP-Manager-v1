<?php

namespace App\Http\Controllers\UserPanels\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DaftarLogin_Model;
use App\Models\Karyawan_Model;
use App\Models\DaftarWS_Model;
use App\Models\Monitoring_Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;


class WorksheetController extends Controller
{
    //
    public function index(Request $request)
    {
        $projectID = $request->input('projectID');
        $wsID = $request->input('wsID');
        $wsDate = Carbon::parse($request->input('wsDate'));

        $process = $this->setPageSession("Manage Daily Worksheet", "m-worksheet");
        if ($process) {
            // $loadDataWS = Monitoring_Model::with('karyawan', 'project', 'dailyws')->where('id_monitoring', $monitoringId)->first();


            // $loadDataWS = DaftarWS_Model::with('project', 'project.client', 'monitoring', 'task')->where('id_ws', $wsID)->first();

            // // In your controller where you load the data
            // $loadDataWS = DaftarWS_Model::with([
            //     'project',
            //     'project.client',
            //     'monitoring',
            //     'task' => function ($query) use ($wsDate) {
            //         $query->whereDate('start_time_task', $wsDate);
            //     },
            //     'task.monitor' => function ($query) use ($projectID) {
            //         $query->where('id_project', $projectID);
            //     }
            // ])->where('id_ws', $wsID)
            //     ->whereDate('working_date_ws', $wsDate)
            //     ->first();
            $loadDataWS = DaftarWS_Model::with([
                'project',
                'project.client',
                'monitoring',
                'task' => function ($query) use ($wsDate) {
                    $query->whereDate('created_at', $wsDate);
                },
                'task.monitor' => function ($query) use ($projectID) {
                    $query->where('id_project', $projectID);
                }
            ])->where('id_ws', $wsID)
                ->whereDate('working_date_ws', $wsDate)
                ->first();


            // dd($loadDataWS->toArray());



            // $loadRelatedDailyWS = Monitoring_Model::with('karyawan', 'project', 'worksheet')->where('id_project', $projectID)->first();
            $loadRelatedDailyWS = DaftarWS_Model::with('karyawan', 'project', 'monitoring')->where('id_project', $projectID)->first();


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
                'loadDataWS' => $loadDataWS,
                'loadRelatedDailyWS' => $loadRelatedDailyWS,
                'employee_list' => Karyawan_Model::withoutTrashed()->get(),
                'authenticated_user_data' => $authenticated_user_data,
            ];
            return $this->setReturnView('pages/userpanels/pm_dataworksheet', $data);
        }
    }
}
