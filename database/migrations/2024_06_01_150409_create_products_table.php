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
            $table->longText('description');
            $table->longText('short_desc');
            $table->longText('tech_spec');
            $table->longText('used_for');
            $table->longText('warranty');
            $table->string('keywords');
            $table->string('lead_time')->nullable();
            $table->string('tax')->nullable();
            $table->string('tax_type')->nullable();
            $table->integer('is_promo')->default(0);
            $table->integer('is_featured')->default(0);
            $table->integer('is_discounted')->default(0);
            $table->integer('is_trending')->default(0);
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
