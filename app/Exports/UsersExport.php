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

    public function department($department)
    {
        $this->department = $department;

        return $this;
    }

        public function query()
        {
            return User::query()->whereHas('departments', function ($query) {
                $query->where('id',  $this->department);
            });
            
        }
}
