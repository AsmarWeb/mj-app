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
        Schema::create('knowledge', function (Blueprint $table) {
            $table->id();
            $table->text('question');
            $table->text('answer');
            $table->text('question_ar')->nullable()->after('question');
            $table->longText('answer_ar')->nullable()->after('answer');
            $table->string('category')->nullable()->after('answer_ar');
            $table->boolean('is_active')->default(true)->after('category');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('knowledge');
    }
};
