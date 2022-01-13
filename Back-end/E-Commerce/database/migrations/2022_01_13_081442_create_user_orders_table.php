<?php

use Brick\Math\BigInteger;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_orders', function (Blueprint $table) {
            $table->string('order_id')->primary();
            $table->foreignId('user_id')->constrained('users', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->string('user_name');
            $table->string('status');
            $table->string('product');
            $table->string('order_quantity');
            $table->string('user_email');
            $table->string('user_contact');
            $table->string('user_address');
            $table->BigInteger('order_price');
            $table->string('coupon')->nullable();
            $table->string('payment_method');
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
        Schema::dropIfExists('user_orders');
    }
}
