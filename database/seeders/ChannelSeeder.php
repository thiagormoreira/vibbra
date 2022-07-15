<?php

namespace Database\Seeders;

use App\Models\Channel;
use App\Models\WebPush;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Channel::factory()->create([
            'channelable_id' => WebPush::first()->id ?? WebPush::factory()->create()->id,
            'channelable_type' => WebPush::class,
        ]);
    }
}
