<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidesTasksTitleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slides_tasks_title', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("slide_id")->unsigned();
            $table->text("task");
            $table->timestamps();
        });

        Schema::table('slides_tasks_title', function($table) {
            $table->foreign('slide_id')
                ->references('id')
                ->on('slides_list')
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
        Schema::dropIfExists('slides_tasks_title');
    }
}
