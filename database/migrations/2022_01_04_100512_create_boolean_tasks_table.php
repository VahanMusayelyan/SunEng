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

            $table->bigInteger('reading_id')->unsigned();
            $table->text('question');
            $table->tinyInteger('answer');
            $table->timestamp("created_at")->nullable()->useCurrent();
            $table->timestamp("updated_at")->nullable()->useCurrent();
        });

        Schema::table('boolean_tasks', function (Blueprint $table) {
            $table->foreign('reading_id')
                ->references('id')
                ->on('boolean_tasks_reading')
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
