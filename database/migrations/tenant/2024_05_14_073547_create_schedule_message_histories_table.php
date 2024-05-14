<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schedule_message_histories', function (Blueprint $table) {
            $table->id();
            $table->timestamp('is_sent')->nullable()->comment('When sent from the queue');
            $table->timestamp('sent_at')->nullable()->comment('Sent or not sent');
            $table->unsignedBigInteger('receiver_id');
            $table->unsignedBigInteger('email_template_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('receiver_id')->references('id')->on('users');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('email_template_id')->references('id')->on('email_templates');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_message_histories');
    }
};
