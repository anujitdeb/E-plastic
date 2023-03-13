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
        Schema::create('global_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->nullable()->default('Demo Site');
            $table->string('site_title')->nullable()->default('Demo Site');
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('site_email')->nullable()->default('email@email.com');
            $table->string('site_phone')->nullable()->default('0123456789');
            $table->string('site_address')->nullable()->default('Demo Address');
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('pinterest')->nullable();
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
        Schema::dropIfExists('global_settings');
    }
};
