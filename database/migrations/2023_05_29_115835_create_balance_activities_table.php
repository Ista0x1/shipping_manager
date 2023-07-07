<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalanceActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balance_activities', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount')->default(0);
            // plus moin is when money in and out
            $table->integer('plus_moin')->default(1);
            $table->string('currency')->nullable();
            $table->string('Created_by')->nullable();
            $table->unsignedBigInteger('balance_id');
            $table->foreign('balance_id')->references('id')->on('balances')->onDelete('cascade');
            $table->dateTime('date');
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
        Schema::dropIfExists('balance_activities');
    }
}
