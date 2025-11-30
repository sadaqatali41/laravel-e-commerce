<?php

use App\Enums\OrderStatus;
use App\Enums\PaymentType;
use App\Enums\PaymentStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('order_status', array_column(OrderStatus::cases(), 'value'))
                    ->default(OrderStatus::PLACED->value)
                    ->comment(OrderStatus::comments())
                    ->change();
            $table->enum('payment_type', array_column(PaymentType::cases(), 'value'))
                    ->comment(PaymentType::comments())
                    ->change();
            $table->enum('payment_status', array_column(PaymentStatus::cases(), 'value'))
                    ->comment(PaymentStatus::comments())
                    ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('order_status');
            $table->dropColumn('payment_type');
            $table->dropColumn('payment_status');
        });
    }
};
