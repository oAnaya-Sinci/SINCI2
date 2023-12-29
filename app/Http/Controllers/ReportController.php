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
        $users = User::select('users.id', 'users.name', 'users.email', 'users.days', 'users.admission_date')->whereRelation('positions', 'id', '=', 4)->orderby('name', 'asc')->get();
        $departments = Department::all()->pluck('name', 'id')->except([6]);
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

        $users = User::select('users.id', 'users.name', 'users.email', 'users.days', 'users.admission_date')
        ->whereRelation('positions', 'id', '=', 4)
        ->whereHas('departments', function ($query) use ($request) {
            $query->where('id', $request->input('department'));
        })
        ->whereHas('offices', function ($query) use ($request) {
            $query->where('id', $request->input('office'));
        })
        ->get();

        return view('reports.index', compact('users', 'departments', 'offices', 'titulo', 'date'));
    }
}
