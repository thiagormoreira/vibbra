<?php

namespace Database\Seeders;

use App\Models\App;
use App\Models\WebPush;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebPushSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WebPush::factory()->create();
    }
}
