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
        if($this->office == 'todos' && $this->department == 'todos'){
            $data = User::with(['offices', 'departments', 'positions'])
            ->whereRelation('positions', 'id', '=', 4)->orderBy('name')->get();
        }
        elseif($this->department == 'todos' && !empty($this->office)){
        $data = User::with(['offices', 'departments', 'positions'])
                ->whereRelation('positions', 'id', '=', 4)
                ->whereHas('offices', function ($query) {
                    $query->where('id',  $this->office);
                })->orderBy('name')->get();
        }elseif($this->office == 'todos' && !empty($this->department)){
            $data = User::with(['offices', 'departments', 'positions'])
            ->whereRelation('positions', 'id', '=', 4)
            ->whereHas('departments', function ($query) {
                $query->where('id',  $this->department);
            })->orderBy('name')->get();
        }
                
                
        dd($data);
        return view('export.index',[
                'users' => $data
                ]);

    }    
}
