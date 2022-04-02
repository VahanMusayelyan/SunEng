<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooleanTasksReadingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boolean_tasks_reading', function (Blueprint $table) {
            $table->id();
            $table->text('reading');
            $table->bigInteger('slide_lesson_id')->unsigned();
            $table->timestamp("created_at")->nullable()->useCurrent();
            $table->timestamp("updated_at")->nullable()->useCurrent();
        });

        Schema::table('boolean_tasks_reading', function (Blueprint $table) {
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
        Schema::dropIfExists('boolean_tasks_reading');
    }
}
