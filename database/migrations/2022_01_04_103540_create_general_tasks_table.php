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
            $table->text('question');
            $table->bigInteger('reading_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('general_tasks', function (Blueprint $table) {
            $table->foreign('reading_id')
                ->references('id')
                ->on('general_tasks_reading')
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
