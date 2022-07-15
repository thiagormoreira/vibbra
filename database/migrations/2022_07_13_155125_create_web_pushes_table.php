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
        Schema::create('web_pushes', function (Blueprint $table) {
            $table->id();
            $table->string('site_name');
            $table->string('site_address');
            $table->string('site_url_icon');

            $table->string('allow_notification_message_text');
            $table->string('allow_notification_allow_button_text');
            $table->string('allow_notification_deny_button_text');

            $table->string('welcome_notification_message_title');
            $table->string('welcome_notification_message_text');
            $table->string('welcome_notification_enable_url_redirect');
            $table->string('welcome_notification_url_redirect');

            $table->unsignedBigInteger('app_id');
            //$table->unsignedBigInteger('channel_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('web_pushes');
    }
};
