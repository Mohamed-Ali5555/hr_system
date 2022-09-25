<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employeers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');

            $table->string('address');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone');
            $table->date('date');
            $table->enum('type',['mail','femail'])->default('mail');
            $table->date('date_of_contact')->nullable();
            $table->time('start_time');
            $table->time('end_time');
            $table->float('salary')->default(0);
            $table->string('national_id');
            $table->string('nationality');
            $table->decimal('hour_price')->default(0);


            $table->string('photo')->nullable();
            $table->mediumText('note')->nullable();
            $table->unsignedBigInteger('section_id');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->enum('status',['pending','accept'])->default('accept');

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
        Schema::dropIfExists('employeers');
    }
}
