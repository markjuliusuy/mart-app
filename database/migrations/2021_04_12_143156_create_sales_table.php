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
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_id_number')->nullable();
            $table->string('customer_contact_number')->nullable();
            $table->boolean('customer_is_pwd_sc')->nullable();

            $table->unsignedBigInteger('discount_id')->nullable();
            $table->string('discount_name')->nullable();
            $table->decimal('discount', 10,2)->nullable();
            $table->decimal('discount_amount', 10, 2)->nullable();

            $table->decimal('total_price', 10, 2);
            $table->integer('total_quantity');
            $table->integer('total_discount')->nullable();
            $table->decimal('subtotal_amount', 10, 2);
            $table->decimal('subtotal_amount_no_vat', 10, 2)->nullable();
            $table->decimal('total_amount', 10, 2);
            $table->decimal('tendered_amount', 10, 2);
            $table->decimal('change_amount', 10, 2);
            $table->decimal('grand_total', 10, 2);
            $table->string('notes')->nullable();
            $table->string('transaction_type')->nullable();
            $table->integer('status')->nullable();

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
