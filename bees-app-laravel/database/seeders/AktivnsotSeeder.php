<?php

namespace Database\Seeders;

use App\Models\Aktivnost;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AktivnsotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users=\App\Models\User::all();
        $drustva=\App\Models\Drustvo::all();

        foreach($drustva as $drustvo){
            Aktivnost::factory(1)->create([
                'drustvo_id'=>$drustvo->id,
                'user_id' => $users->random()->id
            ]);
        }

    }
}
