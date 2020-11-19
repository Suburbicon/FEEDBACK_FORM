<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('firstname', 255);
          $table->string('lastname', 255);
          $table->string('secondname', 255)->nullable();
          $table->string('email', 50)->unique();
          $table->string('phone_mobile', 12)->index();
          $table->string('phone_landline', 12)->nullable();
          $table->string('phone_landline_adt', 5)->nullable();
          $table->boolean('entity')->default(0);
          $table->text('adt_info')->nullable();
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
        Schema::dropIfExists('members');
    }
}
