<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Date;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {

        $settings_date = Date::all();
        $settings_notifi = Date::all();
        $settings = Setting::all();
        $titulo = 'Configuracion de niveles';


        return view('settings.index', compact('settings', 'titulo','settings_date','settings_notifi'));
    }

    public function edit(Setting $setting)
    {
        $titulo = 'Configuracion de niveles';

        return view('settings.edit', compact('setting', 'titulo'));
    }

    public function update(Request $request, Setting $setting)
    {
        $setting->update([
            // 'level' => $request->input('level'),
            'days' => $request->input('days'),
        ]);

        return redirect()->route('settings');
    }

    public function dateCreate(Request $request)
    {
        $titulo = 'Configuracion de fecha';

        return view('settings.dates.create', compact('titulo'));
    }

    public function dateStore(Request $request)
    {
        $setting_date = Date::create([
            'setting_date' => $request->input('setting_date'),
        ]);

        $setting_date->save();

        return redirect()->route('settings');
    }

    public function dateEdit(Date $date)
    {
        return view('settings.dates.edit', compact('date'));
    }

    public function dateUpdate(Request $request, Date $date)
    {
        $date->update([
            'setting_date' => $request->input('setting_date'),
        ]);

        return redirect()->route('settings');
    }

    public function statusEdit(Date $status)
    {
        return view('settings.notifications.edit', compact('status'));
    }

    public function statusUpdate(Request $request, Date $status)
    {
        $status->update([
            'status_notifi' => $request->input('status') ?? false,
        ]);

        return redirect()->route('settings');
    }
}
