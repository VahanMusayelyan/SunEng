<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSplitTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('split_tasks', function (Blueprint $table) {
            $table->id();
            $table->text("split_text");
            $table->bigInteger('slide_lesson_id')->unsigned();
            $table->timestamp("created_at")->nullable()->useCurrent();
            $table->timestamp("updated_at")->nullable()->useCurrent();
        });

        Schema::table('split_tasks', function (Blueprint $table) {
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
        Schema::dropIfExists('split_tasks');
    }
}
