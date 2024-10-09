<?php

namespace Database\Seeders;

use App\Models\DaftarLogin_Model;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tb_DaftarLoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $loginList = [
            // Username,    email,                  pass,       type,   id_kar, id_cli
            ['admin',       'admin@mail.com',       '123456',   2,      1,      null],
            ['karyawan1',   'karyawan1@mail.com',   '123456',   3,      2,      null],
            ['karyawan2',   'karyawan2@mail.com',   '123456',   4,      3,      null],
            ['client1',     'client1@mail.com',     '123456',   1,      null,   1],
        ]; // Example userlogin values

        foreach ($loginList as $index => $login) {
            $username = $login[0];
            $email = $login[1];
            $password = $login[2];
            $userType = $login[3];
            $idKaryawan = $login[4];
            $idClient = $login[5];

            $existingUser = DaftarLogin_Model::where('username', $username)->first();

            if ($existingUser) {
                $existingUser->update([
                    'email' => $email,
                    'password' => bcrypt($password),
                    'type' => $userType,
                    'id_karyawan' => $idKaryawan,
                    'id_client' => $idClient,
                ]);
            } else {
                DaftarLogin_Model::create([
                    'username' => $username,
                    'email' => $email,
                    'password' => bcrypt($password),
                    'type' => $userType,
                    'id_karyawan' => $idKaryawan,
                    'id_client' => $idClient,
                ]);
            }
        }
    }
}
