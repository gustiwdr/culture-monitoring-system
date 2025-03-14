<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->date('activity_date');
            $table->integer('target_participants');
            $table->unsignedBigInteger('division_id');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->enum('approval_status', ['pending', 'approved_by_head', 'approved_by_admin', 'rejected_by_head', 'rejected_by_admin'])->default('pending');
            $table->enum('activity_status', ['scheduled', 'done', 'canceled'])
                ->default('scheduled');
            $table->text('remarks')->nullable();
            $table->timestamps();

            $table->foreign('division_id')->references('id')->on('divisions');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
