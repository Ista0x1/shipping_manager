<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWearhousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wearhouses', function (Blueprint $table) {
            $table->id();
            $table->integer('chwal')->default(0);
            $table->integer('petit_coli')->default(0);
            $table->integer('grand_coli')->default(0);
            $table->integer('nas')->default(0);
            $table->integer('f1')->default(0);
            $table->integer('f2')->default(0);
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
        Schema::dropIfExists('wearhouses');
    }
}
