<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Department;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;

class UsersExport implements FromView
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

    public function view(): view
    {
        return view('export.index',[
            'users' => User::with(['offices', 'departments', 'positions'])
                    ->whereRelation('positions', 'id', '=', 4)
                    ->whereHas('departments', function ($query) {
                        $query->where('id',  $this->department);
                    })
                    ->whereHas('offices', function ($query) {
                        $query->where('id',  $this->office);
                    })->orderBy('name')->get()
            ]);
    }    
}
