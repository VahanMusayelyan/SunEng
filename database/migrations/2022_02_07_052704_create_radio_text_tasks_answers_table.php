<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRadioTextTasksAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('radio_text_tasks_answers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("radio_text_task_id")->unsigned();
            $table->string("answer")->nullable();
            $table->tinyInteger("correct")->nullable();
            $table->timestamp("created_at")->nullable()->useCurrent();
            $table->timestamp("updated_at")->nullable()->useCurrent();
        });

        Schema::table('radio_text_tasks_answers', function (Blueprint $table) {
            $table->foreign("radio_text_task_id")
                ->references('id')
                ->on('radio_text_tasks')
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
        Schema::dropIfExists('radio_text_tasks_answers');
    }
}
