<?php

namespace Database\Seeders;

use App\Models\Channel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

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
            AppSeeder::class,
            ChannelSeeder::class,
            NotificationSeeder::class,
            EmailSeeder::class,
            SmsSeeder::class,
        ]);

        Artisan::call('passport:install');
    }
}
