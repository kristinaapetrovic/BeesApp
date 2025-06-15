<?php

use App\Models\User;
use App\Models\Drustvo;
use App\Models\Aktivnost;
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
        Schema::create('aktivnosts', function (Blueprint $table) {
            $table->id();
            $table->string('naziv');
            $table->text('opis')->nullable();
            $table->enum('tip', Aktivnost::$tip);
            $table->dateTime('pocetak');
            $table->date('kraj');
            $table->integer('trajanje');
            $table->enum('status', Aktivnost::$status)->default('PLANIRANA');
            $table->foreignIdFor(Drustvo::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aktivnosts');
    }
};
