<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class UsersExport implements FromQuery
{
    use Exportable;

    private $department;
    private $office;

    public function department($department)
    {
        $this->department = $department;

        return $this;
    }

    public function office($office)
    {
        $this->office = $office;

        return $this;
    }

    public function query()
    {
        // return User::query()->select('users.id', 'users.name', 'users.email', 'positions.name', 'departments.name', 'offices.name', 'users.days', 'users.admission_date')
        return User::query()->select('users.id', 'users.name', 'users.email', 'users.days', 'users.admission_date')
        ->whereRelation('positions', 'id', '=', 4)
        ->whereHas('departments', function ($query) {
            $query->where('id',  $this->department);
        })
        ->whereHas('offices', function ($query) {
            $query->where('id',  $this->office);
        });
    }
}
