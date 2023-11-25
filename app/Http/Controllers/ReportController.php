<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\User;
use App\Models\Date;
use App\Models\Office;

class ReportController extends Controller
{
    public function index()
    {

        $users = User::whereRelation('positions', 'id', '=', 4)
        ->whereRelation('departments', 'id', '=', 1)->orderby('name')
        ->get();
        $departments = Department::all()->pluck('name', 'id');
        $offices = Office::all()->pluck('name', 'id');
        $titulo = 'REPORTES';

        return view('reports.index', compact('users', 'departments', 'offices', 'titulo'));
    }

    public function filter(Request $request)
    {
        $departments = Department::all()->pluck('name', 'id');
        $offices = Office::all()->pluck('name', 'id');
        $titulo = 'REPORTES';
        $date = Date::all()->value('setting_date');

        // $users = User::whereHas('departments', function ($query) use ($request) {
        //     $query->where('id', $request->input('department'));
        // })->get();

        if($request->input('department') != 'todos' && $request->input('office') != "todos"){
            // $users = User::select('users.name, users.email, offices.name, departments.name, users.days, users.admission_date')
            $users = User::whereRelation('departments', 'id', '=', $request->input('department'))
            ->whereRelation('offices', 'id', '=', $request->input('office'))
            ->orderby('name')->get();
        } else if($request->input('department') != 'todos' && $request->input('office') == "todos"){
            // $users = User::select('users.name, users.email, offices.name, departments.name, users.days, users.admission_date')
            $users = User::whereRelation('departments', 'id', '=', $request->input('department'))
            ->orderby('name')->get();
        } else if($request->input('department') == 'todos' && $request->input('office') != "todos"){
            // $users = User::select('users.name, users.email, offices.name, departments.name, users.days, users.admission_date')
            $users = User::whereRelation('offices', 'id', '=', $request->input('office'))
            ->orderby('name')->get();
        } else {
            $users = User::orderby('name')->get();
        }

        // return view('reports.index', compact('users', 'departments', 'offices', 'titulo', 'date'));
        return view('reports.index', compact('users', 'offices', 'titulo', 'date'));
    }
}
