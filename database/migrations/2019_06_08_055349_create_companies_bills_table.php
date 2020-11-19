<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies_bills', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('iban', 30)->unique();
          $table->unsignedInteger('bank_id')->index()->nullable()->references('id')->on('banks')->onDelete('SET NULL');
          $table->unsignedInteger('company_id')->index()->nullable()->references('id')->on('companies')->onDelete('SET NULL');
          $table->string('currency', 5);
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
        Schema::dropIfExists('companies_bills');
    }
}
