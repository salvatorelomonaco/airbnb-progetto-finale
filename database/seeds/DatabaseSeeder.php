<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // NOTA:
        // You need to run the ">composer dump-autoload" command to generate a new classmap
        // every time you add a file to database/, otherwise it will not be autoloaded.

         $this->call(UsersTableSeeder::class);
         $this->call(ApartmentsTableSeeder::class);
         $this->call(MessagesTableSeeder::class);
         $this->call(InfosTableSeeder::class);
         $this->call(SponsorshipsTableSeeder::class);
         $this->call(ServicesTableSeeder::class);

         // tabelle ponte
         $this->call(ApartmentServiceTableSeeder::class);
         $this->call(ApartmentSponsorshipTableSeeder::class);

    }
}
