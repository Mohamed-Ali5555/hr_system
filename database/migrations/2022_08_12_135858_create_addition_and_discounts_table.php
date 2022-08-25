<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdditionAndDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addition_and_discounts', function (Blueprint $table) {
            $table->id();
             $table->decimal('discount');
             $table->decimal('addition');

            $table->string('week_holiday')->nullable();
            $table->decimal('hour_price');
            $table->decimal('total');

            // $table->string('employer');

            // $table->unsignedBigInteger('section_id');
            // $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');

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
        Schema::dropIfExists('addition_and_discounts');
    }
}
