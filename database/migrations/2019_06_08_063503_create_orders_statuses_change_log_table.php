<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersStatusesChangeLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_statuses_change_log', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedInteger('old_status')->index();
          $table->unsignedInteger('new_status')->index();
          $table->unsignedInteger('order_id')->index()->nullable()->references('id')->on('orders')->onDelete('SET NULL');
          $table->unsignedInteger('user_id')->index()->nullable()->references('id')->on('users')->onDelete('SET NULL');
          $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_statuses_change_log');
    }
}
