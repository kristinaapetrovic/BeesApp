<?php

namespace Database\Seeders;

use App\Models\Komentar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KomentarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aktivnosti=\App\Models\Aktivnost::all();
        $users=\App\Models\User::all();

        foreach($aktivnosti as $aktivnost){
            Komentar::factory(2)->create([
                'user_id' => $users->random()->id,
                'aktivnost_id'=>$aktivnost->id
            ]);
        }


    }
}
