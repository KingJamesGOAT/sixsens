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
            ['name' => 'EPFL',        'color' => "000000", 'nb_employee' => 120],
            ['name' => 'Heig-VD', 'color' => "ffffff", 'nb_employee' => 85],
            ['name' => 'Unil',  'color' => "666666", 'nb_employee' => 60],
        ];

        foreach ($companies as $company) {
            $companyId = DB::table('companies')->insertGetId([
                'name'        => $company['name'],
                'logo'        => null,
                'color'       => $company['color'],
                'nb_employee' => $company['nb_employee'],
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ]);

            // ─── 2 collectes passées + 1 future par company ─
            DB::table('collections')->insert([
                [
                    'id_company'     => $companyId,
                    'start'          => Carbon::now()->subMonths(3)->setTime(8, 0),
                    'end'            => Carbon::now()->subMonths(3)->setTime(16, 0),
                    'nb_employee'    => $company['nb_employee'] - 20,
                    'nb_blood_pouch' => 35,
                    'onedoc_link'    => null,
                    'created_at'     => Carbon::now(),
                    'updated_at'     => Carbon::now(),
                ],
                [
                    'id_company'     => $companyId,
                    'start'          => Carbon::now()->subMonths(1)->setTime(9, 0),
                    'end'            => Carbon::now()->subMonths(1)->setTime(17, 0),
                    'nb_employee'    => $company['nb_employee'] - 10,
                    'nb_blood_pouch' => 28,
                    'onedoc_link'    => null,
                    'created_at'     => Carbon::now(),
                    'updated_at'     => Carbon::now(),
                ],
                [
                    'id_company'     => $companyId,
                    'start'          => Carbon::now()->addMonths(2)->setTime(8, 0),
                    'end'            => Carbon::now()->addMonths(2)->setTime(16, 0),
                    'nb_employee'    => $company['nb_employee'],
                    'nb_blood_pouch' => null,
                    'onedoc_link'    => null,
                    'created_at'     => Carbon::now(),
                    'updated_at'     => Carbon::now(),
                ],
            ]);
        }
    }
}
