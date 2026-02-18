<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('variant_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('variant_id')->constrained()->onDelete('cascade');
            $table->string('name'); // Rojo, Azul, 64GB, XL, etc.
            $table->string('value')->nullable(); // #FF0000 para colores, o valor técnico
            $table->decimal('price_adjustment', 10, 2)->default(0); // Precio adicional de la variante
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('variant_options');
    }
};
