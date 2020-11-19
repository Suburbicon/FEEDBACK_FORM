<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedInteger('company_id')->index()->nullable()->references('id')->on('companies')->onDelete('SET NULL');
          $table->unsignedInteger('member_id')->index()->nullable()->references('id')->on('members')->onDelete('SET NULL');
          $table->unsignedInteger('status_id')->index()->nullable()->references('id')->on('statuses')->onDelete('SET NULL');
          $table->text('comment');
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
        Schema::dropIfExists('orders');
    }
}
