<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullabel();
            $table->string('city_origin')->nullable();
            $table->string('city_final')->nullable();
            $table->string('adress_origin')->nullable();
            $table->string('adress_final')->nullable();
            $table->string('zip_origin')->nullable();
            $table->string('zip_final')->nullable();
            $table->string('phone_origin')->nullable();
            $table->string('phone_final')->nullable();
            $table->date('date_origin')->nullable();
            $table->string('status')->nullable();
            $table->integer('status_value')->nullable();
            $table->string('note')->nullable();
            $table->unsignedBigInteger('method_id')->nullable();
            $table->foreign('method_id')->references('id')->on('shipping_methods')->onDelete('cascade');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->decimal('total', 8, 2)->nullable();
            $table->decimal('tax_amount', 8, 2)->nullable();
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
        Schema::dropIfExists('shippings');
    }
}
