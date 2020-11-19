<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
        $table->bigIncrements('id');
        $table->string('login', 15)->unique();
        $table->string('name', 30);
        $table->string('email', 100)->unique();
        $table->string('password');
        $table->rememberToken();
        $table->timestamp('last_sign_in_at')->nullable();
        $table->timestamp('current_sign_in_at')->nullable();
        $table->timestamps();
        $table->softDeletes();
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
