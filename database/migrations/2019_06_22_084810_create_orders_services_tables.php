<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersServicesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
      Schema::create('orders_services', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('name', 255);
        $table->string('description', 255);
        $table->integer('deadline_hours')->nullable();
        $table->unsignedInteger('parent_id')->index()->nullable()->references('id')->on('services')->onDelete('SET NULL');
        $table->timestamps();
      });

      Schema::create('orders_services_mapping', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->unsignedInteger('order_id')->nullable()->references('id')->on('orders')->onDelete('SET NULL');
        $table->unsignedInteger('service_id')->nullable()->references('id')->on('services')->onDelete('SET NULL');
        $table->unique(['order_id', 'service_id']);
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('orders_services');
      Schema::dropIfExists('orders_services_mapping');
    }
}
