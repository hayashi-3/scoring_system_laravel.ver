<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorrectAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('correct_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('questions_id');
            $table->string('answer', 255);
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrent();

            // 外部キー制約
            $table->foreign('questions_id')
                    ->references('id')
                    ->on('questions')
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
        Schema::dropIfExists('correct_answers');
    }
}
