<?php

namespace Database\Seeders;

use App\Models\Kosnica;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KosnicaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pcelinjaci=\App\Models\Pcelinjak::all();

        foreach($pcelinjaci as $pcelinjak){
            Kosnica::factory(4)->create([
                'pcelinjak_id'=>$pcelinjak->id
            ]);
        }

    }
}
