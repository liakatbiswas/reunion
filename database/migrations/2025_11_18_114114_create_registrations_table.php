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
            $table->string('regi_id')->unique();
            // Foreign keys
            $table->foreignId('batch_id')->nullable()->constrained('batches')->nullOnDelete();
            $table->foreignId('division_id')->nullable()->constrained('divisions')->nullOnDelete();
            $table->foreignId('district_id')->nullable()->constrained('districts')->nullOnDelete();
            $table->foreignId('upazila_id')->nullable()->constrained('upazilas')->nullOnDelete();
            // Address
            $table->string('village')->nullable();
            $table->string('post_office')->nullable();
            // Status
            $table->enum('status', ['pending', 'active'])->default('pending');
            // Personal details
            $table->string('occupation')->nullable();
            $table->string('phone', 20)->nullable()->unique();
            $table->string('photo')->nullable();
            $table->string('bKash', 20)->nullable();
            $table->string('email')->nullable();
            $table->enum('gender', ['male', 'female', 'other']);
            // Family / Members
            $table->enum('member_type', ['single', 'couple', 'parent_with_children', 'couple_with_children', 'children_only']);
            $table->integer('children')->default(0);
            $table->integer('amount')->default(0);
            // Notes
            $table->text('note')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
