<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enters', function (Blueprint $table) {
            $table->id();
            $table->decimal('dinar_amount',12,2)->default(0);
            $table->string('currency')->default('euro');
            $table->decimal('amount')->default(0);
            $table->decimal('exchange')->default(0);
            $table->dateTime('date');
            $table->string('city')->nullable();
            $table->string('Created_by', 999);
            $table->timestamps();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enters');
    }
}
