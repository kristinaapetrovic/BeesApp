<?php

namespace Database\Seeders;

use App\Models\Pcelinjak;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PcelinjakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = \App\Models\User::all();
        
        foreach($users as $user){
            Pcelinjak::factory(1)->create([
                'user_id'=>$user->id
            ]);
        }

    }
}
