<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $this->call(UserSeeder::class);
        $this->call(PcelinjakSeeder::class);
        $this->call(KosnicaSeeder::class);
        $this->call(DrustvoSeeder::class);
        $this->call(AktivnsotSeeder::class);
        $this->call(KomentarSeeder::class);
        $this->call(SugestijaSeeder::class);

    }
}
