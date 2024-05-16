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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type')->comment('either sms or mobile');
            $table->string('user_type');
            $table->unsignedBigInteger('email_template_id');
            $table->timestamp('published_at')->default(now());
            $table->boolean('status')->default(false);
            $table->unsignedBigInteger('user_id')->comment('created_by');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('email_template_id')->references('id')->on('email_templates');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compaigns');
    }
};
