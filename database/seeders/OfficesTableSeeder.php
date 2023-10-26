<?php


namespace Database\Seeders;

use App\Models\Office;
use Illuminate\Database\Seeder;

class OfficesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offices = [
            ['name' => 'Guadalajara'],
            ['name' => 'Queretaro'],
            ['name' => 'Monterrey'],
            ['name' => 'Mexico'],
        ];
        foreach($offices as $office){
            Office::create([
                'name' => $office['name']
            ]);
        }
    }
}
