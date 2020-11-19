<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_permissions', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedInteger('role_id')->nullable()->references('id')->on('roles')->onDelete('SET NULL');
          $table->string('slug', 50)->default('')->index();
          $table->string('description')->default('');
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
        Schema::dropIfExists('users_permissions');
    }
}
