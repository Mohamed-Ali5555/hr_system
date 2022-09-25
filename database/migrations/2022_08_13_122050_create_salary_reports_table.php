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

       
            $table->date('report_date')->nullable();

            
            $table->integer('total_attendace_days')->default(0); // that he staty 
            $table->integer('total_absent_days')->default(0);

            $table->integer('total_hours_amount')->default(0); // that he staty 
            // $table->integer('total_price_amount')->default(0);
            $table->decimal('hour_price')->default(0);

      
            $table->integer('total_hours_overtime')->default(0);  //that he over stay or depature
            $table->integer('total_hours_discount')->default(0);

            $table->integer('discount_total')->default(0);  // that not get

            $table->decimal('total')->default(0); //all total
           

            $table->unsignedBigInteger('section_id')->nullable();
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
          
          
            

            $table->unsignedBigInteger('employer_id')->nullable();
            $table->foreign('employer_id')->references('id')->on('employeers')->onDelete('cascade');
         
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
