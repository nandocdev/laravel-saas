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
        Schema::create('tenant_landings', function (Blueprint $table) {
            $table->id();
            $table->string('template_key', 30)->default('corporate');
            $table->string('status', 10)->default('draft');
            $table->string('primary_color', 7)->nullable();
            $table->string('font_family', 20)->default('sans');
            $table->json('global_settings')->nullable();
            $table->timestamps();
        });

        Schema::create('landing_blocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_landing_id')
                ->constrained('tenant_landings')
                ->cascadeOnDelete();
            $table->string('block_type', 30);
            $table->smallInteger('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->json('settings')->nullable();
            $table->timestamps();

            // Índices compuestos sugeridos
            $table->index(['tenant_landing_id', 'order']);
            $table->index(['tenant_landing_id', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landing_blocks');
        Schema::dropIfExists('tenant_landings');
    }
};
