<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            ['name' => 'B2M'],
            ['name' => 'SIV'],
            ['name' => 'SC'],
            ['name' => 'SCL'],
            ['name' => 'IE'],

        ];
        foreach($departments as $department){
            Department::create([
                'name' => $department['name']
            ]);
        }
    }
}
