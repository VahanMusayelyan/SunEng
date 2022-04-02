<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTwoPartTasksAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('two_part_tasks_answers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('slide_lesson_id')->unsigned();
            $table->bigInteger("question_first")->unsigned();
            $table->bigInteger("question_second")->unsigned();
            $table->timestamp("created_at")->nullable()->useCurrent();
            $table->timestamp("updated_at")->nullable()->useCurrent();
        });

        Schema::table('two_part_tasks_answers', function (Blueprint $table) {
            $table->foreign('question_first')
                ->references('id')
                ->on('two_part_tasks')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('question_second')
                ->references('id')
                ->on('two_part_tasks')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('slide_lesson_id')
                ->references('id')
                ->on('slides')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('two_part_tasks_answers');
    }
}
