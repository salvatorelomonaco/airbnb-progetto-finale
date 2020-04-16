<?php

use Illuminate\Database\Seeder;


class ApartmentServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        //
        DB::table('apartment_service')->insert([
            [
                'apartment_id' => 1,
                'service_id' => 1
            ]
        ]);

        DB::table('apartment_service')->insert([
            [
                'apartment_id' => 1,
                'service_id' => 2
            ]
        ]);

        DB::table('apartment_service')->insert([
            [
                'apartment_id' => 1,
                'service_id' => 3
            ]
        ]);

        DB::table('apartment_service')->insert([
            [
                'apartment_id' => 2,
                'service_id' => 1
            ]
        ]);

        DB::table('apartment_service')->insert([
            [
                'apartment_id' => 2,
                'service_id' => 2
            ]
        ]);

        DB::table('apartment_service')->insert([
            [
                'apartment_id' => 2,
                'service_id' => 3
            ]
        ]);

        DB::table('apartment_service')->insert([
            [
                'apartment_id' => 2,
                'service_id' => 6
            ]
        ]);

        DB::table('apartment_service')->insert([
            [
                'apartment_id' => 3,
                'service_id' => 2
            ]
        ]);

        DB::table('apartment_service')->insert([
            [
                'apartment_id' => 3,
                'service_id' => 5
            ]
        ]);

        DB::table('apartment_service')->insert([
            [
                'apartment_id' => 4,
                'service_id' => 2
            ]
        ]);

        DB::table('apartment_service')->insert([
            [
                'apartment_id' => 4,
                'service_id' => 6
            ]
        ]);

        DB::table('apartment_service')->insert([
            [
                'apartment_id' => 4,
                'service_id' => 1
            ]
        ]);

        DB::table('apartment_service')->insert([
            [
                'apartment_id' => 5,
                'service_id' => 4
            ]
        ]);

        DB::table('apartment_service')->insert([
            [
                'apartment_id' => 5,
                'service_id' => 2
            ]
        ]);
    }
}
