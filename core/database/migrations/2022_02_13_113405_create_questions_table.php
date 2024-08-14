<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();

            $table->integer('survey_id')->default(0);
            $table->string('question');
            $table->tinyInteger('type')->default(1);
            $table->tinyInteger('custom_input')->default(0);
            $table->tinyInteger('custom_input_type')->default(0);
            $table->string('custom_question');
            $table->text('options');

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
        Schema::dropIfExists('questions');
    }
}
