<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [ 
            ['level' => 'Ing. de proyectos', 'days' => 7],
            ['level' => 'Ing. de proyectos, Supervisor', 'days' => 14],
            ['level' => 'Ing. de proyectos, Supervisor, Coordinador', 'days' => 21],
            ['level' => 'Ing. de proyectos, Supervisor, Coordinador, Gerente', 'days' => 60],
            
        ];
        foreach($settings as $setting){
            Setting::create([
                'level' => $setting['level'],
                'days' => $setting['days'],
            ]);
        }
    }
}
