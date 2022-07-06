<?php

namespace Database\Seeders;

use App\Models\Invite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InviteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Invite::factory()
            ->count(10)
            ->create();
    }
}
