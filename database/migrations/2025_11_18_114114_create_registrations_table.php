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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('batch')->nullable();
            $table->string('address')->nullable();
            $table->string('occupation')->nullable();
            $table->string('phone');
            $table->string('bKash');
            $table->string('email')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->enum('member_type', ['single', 'couple', 'parent_with_children', 'couple_with_children', 'children_only']);
            $table->integer('children')->default(0);
            $table->integer('amount')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
