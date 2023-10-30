<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Department;

class SettingController extends Controller
{
    public function index(){

        $settings = Setting::all();
        $titulo = 'Configuracion de niveles';
        

        return view('settings.index', compact('settings', 'titulo'));
    }

    public function edit(Setting $setting)
    {
        $titulo = 'Configuracion de niveles';

        return view('settings.edit', compact('setting', 'titulo'));
    }

    public function update(Request $request, Setting $setting)
    {
        $setting->update([
            'level' => $request->input('level'),
            'days' => $request->input('days'),
        ]);

        return redirect()->route('settings');
    }
}
