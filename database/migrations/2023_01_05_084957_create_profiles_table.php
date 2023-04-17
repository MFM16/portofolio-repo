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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('name');
            $table->string('nickname');
            $table->string('email')->unique();
            $table->text('address')->nullable();
            $table->text('biography')->nullable();
            $table->string('job')->nullable();
            $table->text('job_description')->nullable();
            $table->string('photo')->default('profil-img/default-user.png');
            $table->string('logo')->default('logo-img/default-logo.png');
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
        Schema::dropIfExists('profiles');
    }
};
