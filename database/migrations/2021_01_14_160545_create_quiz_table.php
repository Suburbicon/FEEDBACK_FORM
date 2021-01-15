<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('liked');
            $table->string('not_liked');
            $table->string('rating');
            $table->text('comment');
            $table->text('comment_stars');
            $table->string('name');
            $table->string('phone');
            $table->string('id_city', 255);
            $table->string('id_department', 255);
            $table->string('id_sector', 255);
            $table->string('recomendation_rating');
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
        Schema::dropIfExists('quiz');
    }
}
