<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_reports', function (Blueprint $table) {
            $table->id();

            // $table->string('first_name')->nullable();
            $table->float('salary')->default(0)->nullable();
            // $table->enum('status',['attendance ','upsent'])->default('attendance')->nullable();
            $table->string('attendance')->nullable();
            $table->string('upsent')->nullable();

            $table->decimal('discount')->nullable();
            $table->decimal('addition')->nullable();

            $table->string('week_holiday')->nullable();
            $table->decimal('hour_price')->nullable();
            $table->decimal('total')->nullable();
            $table->date('date')->nullable();

            $table->unsignedBigInteger('section_id')->nullable();
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
          
          
            $table->unsignedBigInteger('addition_id')->nullable();
            $table->foreign('addition_id')->references('id')->on('addition_and_discounts')->onDelete('cascade');

            $table->unsignedBigInteger('employer_id')->nullable();
            $table->foreign('employer_id')->references('id')->on('employeers')->onDelete('cascade');

            $table->unsignedBigInteger('attendance_id')->nullable();
            $table->foreign('attendance_id')->references('id')->on('attendances')->onDelete('cascade');
            $table->decimal('all_total')->nullable();
            $table->softDeletes();

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
        Schema::dropIfExists('salary_reports');
    }
}
