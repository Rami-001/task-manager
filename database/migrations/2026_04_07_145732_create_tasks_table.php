<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
    Schema::create('tasks', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Creator reference [cite: 120]
        $table->foreignId('category_id')->constrained()->onDelete('cascade');
        $table->string('title'); // [cite: 114]
        $table->text('description')->nullable(); // [cite: 115]
        $table->date('due_date')->nullable(); // [cite: 116]
        $table->enum('status', ['pending', 'in progress', 'completed'])->default('pending'); // [cite: 117, 122-125]
        $table->enum('priority', ['low', 'medium', 'high'])->default('medium'); // [cite: 118, 126-130]
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
