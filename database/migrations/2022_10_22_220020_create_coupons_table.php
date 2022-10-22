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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('code');
            $table->string('value');
            $table->enum('type', ['P', 'V'])->comment('P=Percent, V=Value');
            $table->integer('min_order');
            $table->integer('is_one_time');
            $table->string('status')->default('A')->comment('A=Active, I=Inactive');
            $table->foreignId('created_by')->constrained('admins', 'id')->cascadeOnDelete();
            $table->foreignId('updated_by')->constrained('admins', 'id')->cascadeOnDelete();
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
        Schema::dropIfExists('coupons');
    }
};
