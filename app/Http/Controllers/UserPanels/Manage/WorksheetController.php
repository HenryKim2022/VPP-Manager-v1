<?php

namespace App\Http\Controllers\UserPanels\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DaftarLogin_Model;
use App\Models\Karyawan_Model;
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
    public function index(Request $request)
    {
        $process = $this->setPageSession("Manage Worksheets", "m-worksheet");
        if ($process) {
            // $loadDaftarWorksheetFromDB = [];
            // $loadDaftarWorksheetFromDB = DaftarLogin_Model::with(['karyawan'])->withoutTrashed()->get();

            $user = auth()->user();
            $authenticated_user_data = Karyawan_Model::with('daftar_login.karyawan', 'jabatan.karyawan')->find($user->id_karyawan);

            $modalData = [
                'modal_add' => '#add_userModal',
                'modal_edit' => '#edit_userModal',
                'modal_delete' => '#delete_userModal',
                'modal_reset' => '#reset_userModal',
            ];

            $data = [
                // 'loadDaftarWorksheetFromDB' => $loadDaftarWorksheetFromDB,
                'modalData' => $modalData,
                'employee_list' => Karyawan_Model::withoutTrashed()->get(),
                'authenticated_user_data' => $authenticated_user_data,
            ];
            return $this->setReturnView('pages/userpanels/pm_daftarworksheet', $data);
        }
    }
}
