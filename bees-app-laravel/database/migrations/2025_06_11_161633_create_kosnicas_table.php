<?php

use App\Models\Kosnica;
use App\Models\Pcelinjak;
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
        Schema::create('kosnicas', function (Blueprint $table) {
            $table->id();
            $table->string('oznaka');
            $table->string('tip');
            $table->enum('status', Kosnica::$status);
            $table->foreignIdFor(Pcelinjak::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kosnicas');
    }
};
