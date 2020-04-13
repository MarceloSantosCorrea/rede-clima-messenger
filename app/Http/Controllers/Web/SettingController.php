<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $model = Setting::getAll();

        return view('pages.settings.index', compact('model'));
    }

    public function store(Request $request)
    {
        if ($request->setting) {
            foreach ($request->setting as $key => $value) {
                if (Setting::checkIfExists($key)) {
                    try {
                        Setting::put($key, $value);
                    } catch (\Exception $e) {
                        dd($e->getMessage());
                    }
                } else {
                    try {
                        Setting::set($key, $value);
                    } catch (\Exception $e) {
                        dd($e->getMessage());
                    }
                }
            }
        }

        return redirect()->route('web.settings.index')->with('success', 'Salvo com sucesso.');
    }
}
