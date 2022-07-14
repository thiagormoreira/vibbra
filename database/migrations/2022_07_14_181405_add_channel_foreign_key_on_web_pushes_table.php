<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('web_pushes', function (Blueprint $table) {
//            $table->unsignedBigInteger('channel_id');
//            $table->foreign('channel_id')->references('id')->on('channels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('web_pushes', function (Blueprint $table) {
//            $table->dropColumn('channel_id');
//            $table->dropForeign('web_pushes_channel_id_foreign');
        });
    }
};
