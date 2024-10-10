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

}
