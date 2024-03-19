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
        $users = User::select('users.id', 'users.name', 'users.email', 'users.days', 'users.admission_date')->whereRelation('positions', 'id', '=', 4)->orderByRaw('(users.days * 1) DESC')->get();
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

    public function sendReportSurveyPDF(){

        $htmlReport = "";

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($htmlReport);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
    }
}
