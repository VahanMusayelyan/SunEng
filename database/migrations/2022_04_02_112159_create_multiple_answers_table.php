<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMultipleAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multiple_answers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('mult_ans_quest_id')->unsigned();
            $table->text('answer')->nullable();
            $table->tinyInteger('correct')->default(0);
            $table->timestamp("created_at")->nullable()->useCurrent();
            $table->timestamp("updated_at")->nullable()->useCurrent();
        });

        Schema::table('multiple_answers', function (Blueprint $table) {
            $table->foreign('mult_ans_quest_id')
                ->references('id')
                ->on('multiple_answers_questions')
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
        Schema::dropIfExists('multiple_answers');
    }
}
