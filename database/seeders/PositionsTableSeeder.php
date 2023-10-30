<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Position;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = [
            ['name' => 'Gerente'],
            ['name' => 'Coordinador'],
            ['name' => 'Supervisor'],
            ['name' => 'Ing. de proyectos'],
        ];
        foreach($positions as $position){
            Position::create([
                'name' => $position['name']
            ]);
        }
    }
}
