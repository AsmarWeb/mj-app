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
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique()->nullable()->after('id');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            // Personal Information
            $table->string('full_name');
            $table->string('job_title')->nullable();
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->string('address')->nullable();

            // Profile Photo
            $table->string('photo')->nullable();

            // Main Sections
            $table->text('summary')->nullable();

            $table->json('experiences')->nullable();

            $table->json('educations')->nullable();

            $table->json('skills')->nullable();

            // Extra Sections
            $table->json('projects')->nullable();

            $table->json('certificates')->nullable();

            $table->json('languages')->nullable();

            $table->json('awards')->nullable();

            $table->json('volunteer')->nullable();

            $table->json('references')->nullable();

            // Design Settings

            $table->string('template')
                ->default('modern');

            $table->string('accent_color')
                ->default('#2563eb');

            $table->string('font')
                ->default('Inter');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resumes');
    }
};
