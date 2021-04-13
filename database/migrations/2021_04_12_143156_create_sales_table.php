<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('discount_id')->nullable();
            $table->string('discount_name')->nullable();
            $table->decimal('discount', 5,2)->nullable();
            $table->decimal('discount_amount', 10, 2)->nullable();

            $table->decimal('total_price', 10, 2);
            $table->integer('total_quantity');
            $table->decimal('subtotal_amount', 10, 2);
            $table->decimal('subtotal_amount_no_vat', 10, 2);
            $table->decimal('total_amount', 10, 2);

            $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('sales');
    }
}
