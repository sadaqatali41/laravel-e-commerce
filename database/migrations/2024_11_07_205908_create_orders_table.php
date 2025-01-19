<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'id')->cascadeOnDelete();
            $table->string('name');
            $table->string('email');
            $table->string('mobile');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('pincode');
            $table->string('apartment');
            $table->string('coupon_cd')->nullable();
            $table->integer('coupon_val');
            $table->integer('order_status')->default(1)->comment('1=Placed, 2=On The Way, 3=Delivered, 4=Cancelled');
            $table->enum('payment_type', ['COD', 'GT']);
            $table->enum('payment_status', ['PENDING', 'SUCCESS', 'FAILED']);
            $table->string('payment_id')->nullable();
            $table->integer('total_amt');
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
        Schema::dropIfExists('orders');
    }
};
