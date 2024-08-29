<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Office;
use App\Models\Position;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('name')->get();
        $titulo = 'ADMINISTRACIÓN DE USUARIOS';

        dd( Auth::id() );
        // die( var_dump( auth()->user() ) );

        return view('users.index', compact('users', 'titulo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $offices = Office::all()->pluck('name', 'id');
        $positions = Position::all()->pluck('name', 'id');
        $departments = Department::all()->pluck('name', 'id');
        $titulo = 'NUEVO USUARIO';

        return view('users.create', compact('offices', 'positions', 'departments', 'titulo'));
    }

    public function store(Request $request)
    {

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'chat_id' => $request->input('chat_id'),
            'admission_date' => $request->input('admission_date'),
            'email_notifi' => $request->input('email_notifi') ?? 'off',
            'telegram_notifi' => $request->input('telegram_notifi') ?? 'off',
            'is_admin' => $request->input('is_admin') ?? false,
            'reports' => $request->input('reports') ?? false,
        ]);

        $user->save();
        $user->offices()->sync($request->input('office'));
        $user->positions()->sync($request->input('position'));
        $user->departments()->sync($request->input('department'));

        return redirect()->route('users');
    }

    public function edit(User $user)
    {
        $offices = Office::pluck('name', 'id');
        $positions = Position::pluck('name', 'id');
        $departments = Department::pluck('name', 'id');
        $officeId = $user->offices->pluck('id');
        $positionId = $user->positions->pluck('id');
        $departmentId = $user->departments->pluck('id');
        $titulo = 'EDITAR USUARIO';

        return view('users.edit', compact('user', 'offices', 'positions', 'departments', 'officeId', 'positionId', 'departmentId', 'titulo'));
    }

    public function update(Request $request, User $user)
    {
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'chatId' => $request->input('chatId'),
            'admission_date' => $request->input('admission_date'),
            'email_notifi' => $request->input('email_notifi'),
            'telegram_notifi' => $request->input('telegram_notifi'),
            'is_admin' => $request->input('is_admin') ?? false,
            'reports' => $request->input('reports') ?? false,
        ]);

        $user->offices()->sync($request->input('office'));
        $user->positions()->sync($request->input('position'));
        $user->departments()->sync($request->input('department'));

        return redirect()->route('users');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users');
    }
}
