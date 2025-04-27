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
        Schema::create('user_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); // Sender's name (nullable)
            $table->string('phone')->nullable(); // Sender's name (nullable)
            $table->string('email')->nullable(); // Sender's email (nullable)
            $table->string('subject')->nullable(); // Subject (optional)
            $table->longText('message'); // Main message content
            $table->enum('type', ['contact', 'feedback', 'suggestion', 'goodbye']); // Message type
            $table->string('extension_id')->nullable(); // Optional chrome extension ID
            $table->string('extension_version')->nullable(); // Optional chrome extension version
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_messages');
    }
};
