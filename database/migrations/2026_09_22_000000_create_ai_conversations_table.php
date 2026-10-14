<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_conversations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('session_id')->nullable();
            $table->text('user_message');
            $table->text('ai_response');
            $table->string('intent')->nullable(); // destination, budget, packing, etc.
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_conversations');
    }
};