<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parties', function (Blueprint $table) {
            $table->id();
            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->string('party_code')->nullable();
            $table->text('address')->nullable();
            $table->string('gst_no')->nullable();
            $table->string('mobile')->nullable();
            $table->string('round_1')->default(1050)->comment('below to 0.99');
            $table->string('round_2')->default(1050)->comment('1.00 - 2.00');
            $table->string('round_3')->default(900)->comment('2.01 - 3.00');
            $table->string('round_4')->default(850)->comment('3.01 - 5.00');
            $table->string('round_5')->default(850)->comment('5.01 - 7.00');
            $table->string('round_6')->default(850)->comment('7 to up');
            $table->string('fancy_1')->default(1400)->comment('below to 0.50');
            $table->string('fancy_2')->default(1400)->comment('0.50 - 0.99');
            $table->string('fancy_3')->default(1350)->comment('1.00 - 2.00');
            $table->string('fancy_4')->default(1200)->comment('2.01 - 5.00');
            $table->string('fancy_5')->default(1100)->comment('5.01 - 9.99');
            $table->string('fancy_6')->default(1050)->comment('10 to up');
            $table->string('is_active')->default(1)->nullable();
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
        Schema::dropIfExists('parties');
    }
}
