<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\User;
use App\Models\Date;


class ReportController extends Controller
{
    public function index()
    {
        
        $users = User::whereRelation('positions', 'id', '=', 4)->get();
        $departments = Department::all()->pluck('name', 'id');
        $titulo = 'REPORTES';
        

        return view('reports.index', compact('users', 'departments', 'titulo'));
    }


    public function filter(Request $request)
    {

        $departments = Department::all()->pluck('name', 'id');
        $titulo = 'REPORTES';
        $date = Date::all()->value('setting_date');

        $users = User::whereHas('departments', function ($query) use ($request) {
            $query->where('id', $request->input('department'));
        })->whereHas('position_user', function($query) {
            $query->where('position_id','=', 4);
        })->get();
      
 
        return view('reports.index', compact('users', 'departments', 'titulo', 'date'));
    }
}
