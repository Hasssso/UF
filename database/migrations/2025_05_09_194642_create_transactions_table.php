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
        Schema::create('transactions', function (Blueprint $table) {
    $table->id();
    $table->date('date');                     // Date of transaction 
    $table->string('type', 20);               // Income or Expense
    $table->string('name');                   // Description (Freelance Payment, Supermarket, etc.)
    $table->decimal('value', 10, 2);          // Transaction amount (450.00, -120.00)
    $table->string('currency', 3)->default('TND'); // Currency 
    $table->string('status', 20);             // Completed, Pending, Failed
    $table->text('notes')->nullable();        // Optional additional notes
    $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Link to user
    $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null'); // Optional category
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
