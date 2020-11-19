<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('id_number', 50)->unique();
          $table->string('name', 191)->index();
          $table->string('short_name', 255);
          $table->unsignedInteger('type_id')->index()->nullable()->references('id')->on('companies_types')->onDelete('SET NULL');
          $table->string('email', 50)->unique();
          $table->string('phone', 15)->unique();
          $table->string('address_legal', 255)->nullable();
          $table->string('address_actual', 255)->nullable();
          $table->string('address_mailing', 255)->nullable();
          $table->unsignedInteger('activity_id')->nullable()->index()->references('id')->on('companies_activity')->onDelete('SET NULL');
          $table->string('director_firstname', 255);
          $table->string('director_lastname', 255);
          $table->string('director_secondname', 255)->nullable();
          $table->boolean('kbe');

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
        Schema::dropIfExists('companies');
    }
}
