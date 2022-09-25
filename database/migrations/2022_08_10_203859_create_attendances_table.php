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
            

            $table->time('attendance_time')->nullable();
            $table->time('depature_time')->nullable();
            $table->date('date')->nullable();
            $table->date('absent_date')->nullable();
            $table->integer('total_hours_amount')->default(0);  //that he stay
            $table->integer('total_hours_price')->default(0);  //that he stay and there price
            $table->integer('diff_hours_over')->default(0);  //that he get over 
            $table->integer('diff_hours_discount')->default(0);  //that he late

            $table->integer('discount_total')->default(0);  //that he absent
            $table->string('status');  //that he stay
            $table->integer('value_status')->default(1);  //that he stay

            $table->unsignedBigInteger('employer_id');
            $table->foreign('employer_id')->references('id')->on('employeers')->onDelete('cascade');
            



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
