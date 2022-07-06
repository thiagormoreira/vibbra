<?php

namespace Database\Seeders;

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

        $this->call([
            UserSeeder::class,
            LocationSeeder::class,
            DealSeeder::class,
            BidSeeder::class,
            DeliverySeeder::class,
            InviteSeeder::class,
            MessageSeeder::class,
        ]);

    }
}
