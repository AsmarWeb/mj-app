<?php

use App\Models\User;
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
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_ar');
            $table->string('slug')->unique();
            $table->string('description')->nullable();
            $table->string('logo')->nullable();
            $table->string('banner')->nullable();
            $table->enum('type', ['freelance', 'local'])->nullable();
            $table->bigInteger('country_id')->unsigned()->nullable();
            $table->bigInteger('state_id')->unsigned()->nullable();
            $table->bigInteger('city_id')->unsigned()->nullable();
            $table->string('location')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('currency')->default('AED');
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->boolean('allow_whatsapp')->default(true);
            $table->boolean('allow_phone')->default(true);
            $table->bigInteger('section_id')->unsigned()->nullable();
            $table->decimal('rating', 10, 2)->nullable();
            $table->unsignedInteger('ratings_count')->default(0);
            $table->unsignedBigInteger('views')->default(0);
            $table->datetime('published_at')->nullable();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->unique();
            $table->foreignId('plan_id')->nullable();
            $table->string('stripe_account_id')->nullable();
            $table->boolean('stripe_connected')->default(false);
            $table->foreignIdFor(User::class, 'updated_by')->nullable();
            $table->softDeletes();
            $table->foreignIdFor(User::class, 'deleted_by')->nullable();
            $table->unsignedTinyInteger('step')->default(1);
            $table->boolean('is_completed')->default(false);
            $table->boolean('is_active')->default(false);
            $table->boolean('verified')->default(false)->after('is_active');
            $table->timestamp('verified_at')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};
