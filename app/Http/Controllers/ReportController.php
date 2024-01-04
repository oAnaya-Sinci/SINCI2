<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Position;
use App\Models\Office;
use App\Models\User;
use App\Models\Date;

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

    public function obtainDatFiltered($request){
    
        $users = DB::table('users')
        ->select('users.name', 'users.email', 'offices.name', 'departments.name', 'users.days', 'users.admission_date')
        ->join('department_user', 'department_user.user_id', 'users.id')
        ->leftjoin('departments', 'department_user.department_id', 'departments.id')
        ->join('position_user', 'position_user.user_id', 'users.id')
        ->leftjoin('positions', 'position_user.position_id', 'positions.id')
        ->join('office_user', 'office_user.user_id', 'users.id')
        ->leftjoin('offices', 'office_user.office_id', 'offices.id')
        ->get();

        return $users;
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
