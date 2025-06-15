<?php

namespace Database\Seeders;

use App\Models\Sugestija;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SugestijaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users=\App\Models\User::all();
        $aktivnosti=\App\Models\Aktivnost::all();

         foreach($aktivnosti as $aktivnost){
            Sugestija::factory(2)->create([
                'user_id' => $users->random()->id,
                'aktivnost_id'=>$aktivnost->id
            ]);
        }

    }
}
