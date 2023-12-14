<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Department;
use App\Models\Date;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class UsersExport implements FromView, ShouldAutoSize
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
        $dates = Date::all();
        $date_end = Carbon::now()->format('Y-m-d');
        
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
        }else{
            $data = User::with(['offices', 'departments', 'positions'])
            ->whereRelation('positions', 'id', '=', 4)
            ->whereHas('offices', function ($query) {
                $query->where('id',  $this->office);
            })
            ->whereHas('departments', function ($query) {
                $query->where('id',  $this->department);
            })->orderBy('name')->get();
        }
            
        return view('export.index',[
                'users' => $data,
                'dates' => $dates,
                'date_end' => $date_end,
                ]);

    }    
}
