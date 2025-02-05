<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->integer('total_items');
            $table->text('images');
            $table->string('color', 100)->nullable();
            $table->string('size', 50)->nullable();
            $table->unsignedBigInteger('catagory_id');
            $table->integer('brand_id');
            $table->integer('sold_items')->default(0);
            $table->string('status')->default('pending');
            $table->string('state')->nullable();
            $table->timestamps();
        });
    }
};
