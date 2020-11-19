<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies_activity', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('name', 255);
          $table->string('description', 255);
          $table->unsignedInteger('parent_id')->index()->nullable()->references('id')->on('companies_activity')->onDelete('SET NULL');
          $table->boolean('to_display');
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
        Schema::dropIfExists('companies_activity');
    }
}
