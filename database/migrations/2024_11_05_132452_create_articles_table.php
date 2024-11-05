<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('image'); // Image URL
            $table->string('title'); // Article title
            $table->string('link'); // Article link URL
            $table->date('date')->default(DB::raw('CURRENT_DATE')); // Default to current date
            $table->text('content'); // Article content
            $table->enum('status', ['For Edit', 'Published']); // Article status
            $table->foreignId('writer_id')->constrained('users'); // Writer FK
            $table->foreignId('editor_id')->nullable()->constrained('users'); // Editor FK
            $table->foreignId('company_id')->constrained('companies'); // Company FK
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
