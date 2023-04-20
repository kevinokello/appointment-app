<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile')->nullable();
            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->string('username')->nullable();
            $table->string('slug')->nullable();
            $table->string('image')->nullable();
            $table->string('designation')->nullable();
            $table->string('details')->nullable();
            $table->string('experience')->nullable();
            $table->string('qualifications')->nullable();
            $table->string('address')->nullable();
            $table->string('featured')->nullable();
            $table->string('ev')->nullable();
            $table->string('social')->nullable();
            $table->string('verification_code')->nullable();
            $table->string('status')->nullable()->default(1);

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('user_type')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
