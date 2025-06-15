<?php

namespace Database\Seeders;

use App\Models\Drustvo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DrustvoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kosnice=\App\Models\Kosnica::all();

        foreach($kosnice as $kosnica){
            Drustvo::factory(2)->create([
                'kosnica_id'=>$kosnica->id
            ]);
        }
    }
}
