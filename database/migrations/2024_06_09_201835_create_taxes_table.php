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
        Schema::create('taxes', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('tax_per');
            $table->string('tax_desc');
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
        Schema::dropIfExists('taxes');
    }
};
