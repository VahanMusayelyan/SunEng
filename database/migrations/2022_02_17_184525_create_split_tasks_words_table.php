<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSplitTasksWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('split_tasks_words', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("split_task_id")->unsigned();
            $table->string("word");
        });

        Schema::table('split_tasks_words', function (Blueprint $table) {
            $table->foreign("split_task_id")
                ->references('id')
                ->on('split_tasks')
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
        Schema::dropIfExists('split_tasks_words');
    }
}
