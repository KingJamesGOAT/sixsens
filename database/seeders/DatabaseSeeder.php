<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ─── User ───────────────────────────────────────────
        DB::table('users')->insert([
            'email'      => 'admin@hug.ch',
            'password'   => Hash::make('password'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // ─── Companies ──────────────────────────────────────
        $companies = [
            ['name' => 'EPFL', 'color' => "000000"],
            ['name' => 'Heig-VD', 'color' => "ffffff"],
            ['name' => 'Unil',  'color' => "666666"],
        ];

        foreach ($companies as $company) {
            $companyId = DB::table('companies')->insertGetId([
                'name'        => $company['name'],
                'logo'        => null,
                'color'       => $company['color'],
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ]);

            DB::table('collections')->insert([
                //  2 collectes passées année courante
                [
                    'company_id'     => $companyId,
                    'start'          => Carbon::now()->subMonths(3)->setTime(8, 0),
                    'end'            => Carbon::now()->subMonths(3)->setTime(16, 0),
                    'nb_employee'    => 1000 + rand(0, 100),
                    'nb_registered'  => 200 + rand(0, 20),
                    'nb_blood_pouch' => 190 + rand(0, 10),
                    'onedoc_link'    => null,
                    'created_at'     => Carbon::now(),
                    'updated_at'     => Carbon::now(),
                ],
                [
                    'company_id'     => $companyId,
                    'start'          => Carbon::now()->subMonths(1)->setTime(9, 0),
                    'end'            => Carbon::now()->subMonths(1)->setTime(17, 0),
                    'nb_employee'    => 1100 + rand(0, 100),
                    'nb_registered'  => 180 + rand(0, 20),
                    'nb_blood_pouch' => 170 + rand(0, 10),
                    'onedoc_link'    => null,
                    'created_at'     => Carbon::now(),
                    'updated_at'     => Carbon::now(),
                ],

                // 1 collecte future année courante
                [
                    'company_id'     => $companyId,
                    'start'          => Carbon::now()->addMonths(2)->setTime(8, 0),
                    'end'            => Carbon::now()->addMonths(2)->setTime(16, 0),
                    'nb_employee'    => 1200 + rand(0, 100),
                    'nb_registered'  => null,
                    'nb_blood_pouch' => null,
                    'onedoc_link'    => null,
                    'created_at'     => Carbon::now(),
                    'updated_at'     => Carbon::now(),
                ],

                // 5 collectes de l'année passée
                [
                    'company_id'     => $companyId,
                    'start'          => Carbon::create(2025, 2, 12)->setTime(8, 0),
                    'end'            => Carbon::create(2025, 2, 12)->setTime(16, 0),
                    'nb_employee'    => 950 + rand(0, 100),
                    'nb_registered'  => 210 + rand(0, 20),
                    'nb_blood_pouch' => 180 + rand(0, 10),
                    'onedoc_link'    => null,
                    'created_at'     => Carbon::now(),
                    'updated_at'     => Carbon::now(),
                ],
                [
                    'company_id'     => $companyId,
                    'start'          => Carbon::create(2025, 4, 8)->setTime(9, 0),
                    'end'            => Carbon::create(2025, 4, 8)->setTime(17, 0),
                    'nb_employee'    => 1050 + rand(0, 100),
                    'nb_registered'  => 190 + rand(0, 20),
                    'nb_blood_pouch' => 175 + rand(0, 10),
                    'onedoc_link'    => null,
                    'created_at'     => Carbon::now(),
                    'updated_at'     => Carbon::now(),
                ],
                [
                    'company_id'     => $companyId,
                    'start'          => Carbon::create(2025, 6, 20)->setTime(8, 0),
                    'end'            => Carbon::create(2025, 6, 20)->setTime(16, 0),
                    'nb_employee'    => 1150 + rand(0, 100),
                    'nb_registered'  => 220 + rand(0, 20),
                    'nb_blood_pouch' => 195 + rand(0, 10),
                    'onedoc_link'    => null,
                    'created_at'     => Carbon::now(),
                    'updated_at'     => Carbon::now(),
                ],
                [
                    'company_id'     => $companyId,
                    'start'          => Carbon::create(2025, 9, 5)->setTime(9, 0),
                    'end'            => Carbon::create(2025, 9, 5)->setTime(17, 0),
                    'nb_employee'    => 1000 + rand(0, 100),
                    'nb_registered'  => 200 + rand(0, 20),
                    'nb_blood_pouch' => 185 + rand(0, 10),
                    'onedoc_link'    => null,
                    'created_at'     => Carbon::now(),
                    'updated_at'     => Carbon::now(),
                ],
                [
                    'company_id'     => $companyId,
                    'start'          => Carbon::create(2025, 11, 14)->setTime(8, 0),
                    'end'            => Carbon::create(2025, 11, 14)->setTime(16, 0),
                    'nb_employee'    => 1100 + rand(0, 100),
                    'nb_registered'  => 215 + rand(0, 20),
                    'nb_blood_pouch' => 190 + rand(0, 10),
                    'onedoc_link'    => null,
                    'created_at'     => Carbon::now(),
                    'updated_at'     => Carbon::now(),
                ],
            ]);
        }
    }
}
