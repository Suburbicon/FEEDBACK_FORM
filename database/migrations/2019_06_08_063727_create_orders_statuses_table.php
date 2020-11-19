<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
      Schema::create('orders_statuses', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('status', 30);
        $table->boolean('show_tab')->default(0);
        $table->timestamps();
      });

      DB::table('orders_statuses')->insert(
        array(
          'status' => 'API заявки',
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
          'show_tab' => 1
        )
      );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_statuses');
    }
}
