<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\User;
use App\Models\Date;

class ReportController extends Controller
{
    public function index(){

        $users = User::all();
        $departments = Department::all()->pluck('name', 'id');
        $titulo = 'REPORTES';
        

        return view('reports.index', compact('users', 'departments', 'titulo'));
    }


    public function filter(Request $request){

        $departments = Department::all()->pluck('name', 'id');
        $titulo = 'REPORTES';
        $date = Date::all()->value('setting_date');
 
        $users = User::whereHas('departments', function ($query) use ($request) {
            $query->where('id', $request->input('department'));
        })->get();
 
        return view('reports.index', compact('users', 'departments', 'titulo', 'date'));
    }
}
