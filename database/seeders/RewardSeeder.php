<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RewardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rewards')->insert([
            'customer_id' => 1,
            'credits' => 100,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-01-05 16:37:03',
        ]);

        DB::table('rewards')->insert([
            'customer_id' => 2,
            'credits' => 100,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-01-05 16:37:03',
        ]);

        DB::table('rewards')->insert([
            'customer_id' => 3,
            'credits' => 100,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-02-01 16:37:03',
        ]);

        DB::table('rewards')->insert([
            'customer_id' => 1,
            'redeem' => 10,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-02-01 16:37:03',
        ]);

        DB::table('rewards')->insert([
            'customer_id' => 1,
            'redeem' => 30,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-02-03 16:37:03',
        ]);

        DB::table('rewards')->insert([
            'customer_id' => 1,
            'redeem' => 25,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-02-04 16:37:03',
        ]);
        DB::table('rewards')->insert([
            'customer_id' => 1,
            'credits' => 500,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-02-04 16:37:03',
        ]);
        DB::table('rewards')->insert([
            'customer_id' => 1,
            'redeem' => 150,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-02-05 16:37:03',
        ]);
        DB::table('rewards')->insert([
            'customer_id' => 1,
            'credits' => 200,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-02-05 16:37:03',
        ]);
        DB::table('rewards')->insert([
            'customer_id' => 1,
            'redeem' => 100,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-02-09 16:37:03',
        ]);

        DB::table('rewards')->insert([
            'customer_id' => 3,
            'credits' => 100,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-02-09 16:37:03',
        ]);
        DB::table('rewards')->insert([
            'customer_id' => 4,
            'credits' => 100,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-02-09 16:37:03',
        ]);
        DB::table('rewards')->insert([
            'customer_id' => 5,
            'credits' => 100,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-02-09 16:37:03',
        ]);
        DB::table('rewards')->insert([
            'customer_id' => 6,
            'credits' => 100,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-02-09 16:37:03',
        ]);
        DB::table('rewards')->insert([
            'customer_id' => 7,
            'credits' => 100,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-02-09 16:37:03',
        ]);
        DB::table('rewards')->insert([
            'customer_id' => 8,
            'credits' => 100,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-02-09 16:37:03',
        ]);
        DB::table('rewards')->insert([
            'customer_id' => 9,
            'credits' => 100,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-02-09 16:37:03',
        ]);
        DB::table('rewards')->insert([
            'customer_id' => 10,
            'credits' => 100,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-02-09 16:37:03',
        ]);
        DB::table('rewards')->insert([
            'customer_id' => 11,
            'credits' => 100,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-02-09 16:37:03',
        ]);
        DB::table('rewards')->insert([
            'customer_id' => 12,
            'credits' => 100,
            'agency_id' => 1,
            'client_id' => 1,
            'created_at' => '2021-02-09 16:37:03',
        ]);
    }
}
