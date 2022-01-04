<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_tasks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('slide_lesson_id')->unsigned();
            $table->text('question');
            $table->timestamps();
        });

        Schema::table('general_tasks', function (Blueprint $table) {
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
        Schema::dropIfExists('general_tasks');
    }
}
