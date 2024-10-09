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
                // 'site_name' => TheApp_Model::where('na_setting', 'CompanyName')->withoutTrashed()->first(),
                // 'site_year' => TheApp_Model::where('na_setting', 'SiteCopyrightYear')->withoutTrashed()->first(),
                // 'aboutus_data' => TheApp_Model::where('na_setting', 'AboutUSText')->withoutTrashed()->first(),
                // 'company_addr' => TheApp_Model::where('na_setting', 'CompanyAddress')->withoutTrashed()->first(),
                // 'company_phone' => TheApp_Model::where('na_setting', 'CompanyPhone')->withoutTrashed()->first(),
                // 'company_email' => TheApp_Model::where('na_setting', 'CompanyEmail')->withoutTrashed()->first(),
                'loadDaftarTeamFromDB' => $loadDaftarTeamFromDB,
                'modalData' => $modalData,
                'employee_list' => Karyawan_Model::withoutTrashed()->get(),
                'authenticated_user_data' => $authenticated_user_data,
            ];
            return $this->setReturnView('pages/userpanels/pm_daftarteam', $data);
        }
    }



}
