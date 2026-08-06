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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
            ->nullable()
            ->after('id')
            ->constrained()
            ->nullOnDelete();


        $table->uuid('invite_token')
        ->nullable()
        ->unique();


        $table->timestamp('invited_at')
            ->nullable();
            // Basic Information
    $table->string('name');
    $table->string('company')->nullable();

    $table->string('email')->nullable();
    $table->string('phone')->nullable();

     $table->string('whatsapp')
                ->nullable()
                ->after('phone');

    // UAE Information
    $table->text('address')->nullable();

    $table->string('country')
        ->default('UAE');

     $table->string('emirate')
                ->nullable()
                ->after('address');


    $table->string('vat_number')
        ->nullable();


    // Website / Integration

    $table->string('website')
        ->nullable();


    $table->text('api_key')
        ->nullable();


    // POD Supplier

    $table->enum('type', [

        'printful',
        'printify',
        'local',
        'other'

    ])->default('local');


    // Marketplace commission

    $table->decimal('commission',10,2)
        ->default(0);



    $table->enum('status',[

        'active',
        'inactive'

    ])->default('active');

    $table->string('supplier_type')
                ->default('pod')
                ->after('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
