<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManageFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_feedback', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('book_id');
            $table->integer('good_feedback_id')->nullable();
            $table->integer('improve_feedback_id')->nullable();
            $table->text('mispronounce')->nullable();
            $table->text('incorrect')->nullable();
            $table->text('check_homework')->nullable();
            $table->text('topic')->nullable();
            $table->text('homework');
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
        Schema::dropIfExists('manage_feedback');
    }
}
