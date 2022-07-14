<?php

namespace Database\Seeders;

use App\Models\App;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App::factory()->create([
            'user_id' => User::first()->id,
        ]);
    }
}
