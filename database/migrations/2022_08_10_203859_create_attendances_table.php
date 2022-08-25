<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            
            // $table->string('employer');
            $table->string('slug')->unique();

            $table->time('start_time');
            $table->time('end_time');
            $table->date('today');

            $table->unsignedBigInteger('employer_id');
            $table->foreign('employer_id')->references('id')->on('employeers')->onDelete('cascade');
            $table->enum('status',['attendance ','upsent']);



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
