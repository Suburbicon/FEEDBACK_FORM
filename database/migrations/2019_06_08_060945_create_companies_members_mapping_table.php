<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesMembersMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies_members_mapping', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedInteger('company_id')->nullable()->references('id')->on('companies')->onDelete('SET NULL');
          $table->unsignedInteger('member_id')->nullable()->references('id')->on('members')->onDelete('SET NULL');
          $table->unique(['company_id', 'member_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies_members_mapping');
    }
}
