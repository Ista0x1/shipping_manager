<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
           $table->string('name');
            $table->string('description')->nullabel();
            $table->string('status')->nullable()->default('غير مدفوعة');
            $table->integer('status_value')->nullable()->default(2);
            $table->date('invoice_date')->nullable();
            $table->date('due_date')->nullable();
            $table->integer('isshipping')->default(2);
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->unsignedBigInteger('tax_id')->nullable();
            $table->foreign('tax_id')->references('id')->on('taxes')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->decimal('total', 8, 2)->nullable();
            $table->decimal('tax_amount', 8, 2)->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
