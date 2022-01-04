<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooleanTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boolean_tasks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('slide_lesson_id')->unsigned();
            $table->bigInteger('reading_id')->unsigned();
            $table->text('quest');
            $table->tinyInteger('answert');
            $table->timestamps();
        });

        Schema::table('boolean_tasks', function (Blueprint $table) {
            $table->foreign('reading_id')
                ->references('id')
                ->on('boolean_tasks_reading')
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
        Schema::dropIfExists('boolean_tasks');
    }
}
