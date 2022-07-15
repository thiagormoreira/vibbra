<?php

namespace Database\Seeders;

use App\Models\App;
use App\Models\Notification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Notification::factory(10)->create([
            'message_title' => 'Notification Title',
            'message_text' => 'Notification Text',
            'app_id' => App::first()->id ?? App::factory()->create()->id,
            'send_date' => null,
        ]);

        Notification::factory(10)->create([
            'message_title' => 'Notification Title',
            'message_text' => 'Notification Text',
            'app_id' => App::first()->id ?? App::factory()->create()->id,
            'send_date' => now(),
        ]);
    }
}
