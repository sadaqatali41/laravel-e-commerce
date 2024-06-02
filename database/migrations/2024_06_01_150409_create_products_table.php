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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('prod_name');
            $table->string('slug')->unique();
            $table->integer('brand_id');
            $table->integer('model_id');
            $table->string('description');
            $table->string('short_desc');
            $table->string('keywords');
            $table->string('image')->nullable();
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
        Schema::dropIfExists('products');
    }
};
