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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name');
            $table->string('subject');
            $table->text('message');
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
