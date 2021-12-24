<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homeworks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("lesson_id")->unsigned();
            $table->bigInteger("homework_id")->unsigned();
            $table->timestamps();
        });

        Schema::table('homeworks', function($table) {
            $table->foreign('lesson_id')
                ->references('id')
                ->on('lessons')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('homework_id')
                ->references('id')
                ->on('homeworks_list')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('homeworks', function (Blueprint $table) {
            $table->unique(["lesson_id", "homework_id"], 'lesson_homework_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('homeworks');
    }
}
