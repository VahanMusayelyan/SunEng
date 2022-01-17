<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlideLessonIdToRadioTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('radio_tasks', function (Blueprint $table) {
            $table->bigInteger('slide_lesson_id')->unsigned();

        });

        Schema::table('radio_tasks', function (Blueprint $table) {
            $table->foreign("slide_lesson_id")
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
        Schema::table('radio_tasks', function (Blueprint $table) {
            //
        });
    }
}
