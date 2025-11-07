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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chat_id')->references('id')->on('chats')->onDelete('cascade');
            $table->foreignId('from_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('to_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('message');
            $table->boolean('is_deleted')->default(0);
            $table->timestamp('message_time');
            $table->index(['chat_id', 'message_time']); // or (conversation_id, id)



            // $table->foreignId('sender_id')->constrained('users')->cascadeOnDelete();

            // $table->string('type', 20)->default('text'); // text, image, file, etc.
            // $table->text('message')->nullable();
            // $table->unsignedBigInteger('reply_to_message_id')->nullable()->index();

            // $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
