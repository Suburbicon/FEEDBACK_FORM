<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appeals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('phone');
            $table->string('name');
            $table->text('comment');
            $table->string('id_city', 255);
            $table->string('id_department', 255);
            $table->string('id_sector', 255);
            $table->string('recomendation_rating');
            $table->timestamps();
//            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appeals');
    }
}
