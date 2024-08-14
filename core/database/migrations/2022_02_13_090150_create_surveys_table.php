<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();

            $table->integer('category_id')->default(0);
            $table->string('name');
            $table->string('image');
            $table->tinyInteger('age_limit')->default(0);
            $table->tinyInteger('country_limit')->default(0);
            $table->integer('start_age')->default(0);
            $table->integer('end_age')->default(0);
            $table->text('country');
            $table->tinyInteger('status')->default(1);
            $table->longText('users');

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
        Schema::dropIfExists('surveys');
    }
}
