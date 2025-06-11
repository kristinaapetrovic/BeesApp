<?php

use App\Models\Drustvo;
use App\Models\Kosnica;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('drustvos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Kosnica::class)->constrained()->onDelete('cascade');
            $table->integer('matica_starost');
            $table->enum('jacina', Drustvo::$jacina);
            $table->date('datum_formiranja');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drustvos');
    }
};
