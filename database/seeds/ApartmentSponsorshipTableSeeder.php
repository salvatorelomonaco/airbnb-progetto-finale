<?php

use Illuminate\Database\Seeder;


class ApartmentSponsorshipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        //
        DB::table('apartment_sponsorship')->insert([
            [
                'apartment_id' => 1,
                'sponsorship_id' => 1,
                'start_date' => '2020-03-23 09:40:18'
            ]
        ]);

        DB::table('apartment_sponsorship')->insert([
            [
                'apartment_id' => 1,
                'sponsorship_id' => 2,
                'start_date' => '2020-03-01 09:40:18'
            ]
        ]);

        DB::table('apartment_sponsorship')->insert([
            [
                'apartment_id' => 1,
                'sponsorship_id' => 3,
                'start_date' => '2020-03-22 09:40:18'
            ]
        ]);

        DB::table('apartment_sponsorship')->insert([
            [
                'apartment_id' => 2,
                'sponsorship_id' => 1,
                'start_date' => '2020-03-18 09:40:18'
            ]
        ]);

        DB::table('apartment_sponsorship')->insert([
            [
                'apartment_id' => 2,
                'sponsorship_id' => 2,
                'start_date' => '2020-03-17 09:40:18'
            ]
        ]);

        DB::table('apartment_sponsorship')->insert([
            [
                'apartment_id' => 2,
                'sponsorship_id' => 3,
                'start_date' => '2020-03-12 09:40:18'
            ]
        ]);

        DB::table('apartment_sponsorship')->insert([
            [
                'apartment_id' => 3,
                'sponsorship_id' => 2,
                'start_date' => '2020-03-15 09:40:18'
            ]
        ]);

        DB::table('apartment_sponsorship')->insert([
            [
                'apartment_id' => 3,
                'sponsorship_id' => 1,
                'start_date' => '2020-03-12 09:40:18'
            ]
        ]);

        DB::table('apartment_sponsorship')->insert([
            [
                'apartment_id' => 4,
                'sponsorship_id' => 2,
                'start_date' => '2020-03-13 09:40:18'
            ]
        ]);

        DB::table('apartment_sponsorship')->insert([
            [
                'apartment_id' => 4,
                'sponsorship_id' => 1,
                'start_date' => '2020-03-03 09:40:18'
            ]
        ]);

        DB::table('apartment_sponsorship')->insert([
            [
                'apartment_id' => 4,
                'sponsorship_id' => 3,
                'start_date' => '2020-03-10 09:40:18'
            ]
        ]);

        DB::table('apartment_sponsorship')->insert([
            [
                'apartment_id' => 5,
                'sponsorship_id' => 1,
                'start_date' => '2020-03-10 09:40:18'
            ]
        ]);

        DB::table('apartment_sponsorship')->insert([
            [
                'apartment_id' => 5,
                'sponsorship_id' => 2,
                'start_date' => '2020-03-15 09:40:18'
            ]
        ]);
    }
}
