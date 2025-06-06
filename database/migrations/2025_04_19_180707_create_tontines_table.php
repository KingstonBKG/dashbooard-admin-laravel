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
        Schema::create('tontines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->enum('status', ['active', 'completed'])->default('active');
            $table->integer('contribution_amount');
            $table->enum('contribution_frequency', ['hebdo', 'monthly', 'yearly', 'weekly', 'bi_weekly']); // ex: mensuelle
            $table->integer('max_members');
            $table->string('startDate');
            $table->enum('type', ['fixed', 'rotating', 'voting']);
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tontines');
    }
};
