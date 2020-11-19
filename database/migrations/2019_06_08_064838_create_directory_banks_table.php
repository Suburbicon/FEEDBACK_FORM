<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirectoryBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('directory_banks', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('name', 255);
          $table->string('full_name', 255);
          $table->string('bik', 20);
          $table->unsignedSmallInteger('code')->index();
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
        Schema::dropIfExists('directory_banks');
    }
}
