<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalendarRequest;
use App\Models\Calendar;

class CalendarController extends Controller
{
    public function index()
    {
        $data = Calendar::getCalendars();

        return view('pages.calendars.index', compact('data'));
    }

    public function create()
    {
        return view('pages.calendars.create');
    }

    public function store(CalendarRequest $request)
    {
        try {
            Calendar::createCustom($request->all());

            return redirect()->route('web.calendars.index')->with('success', 'Salvo com sucesso');

        } catch (\Exception $e) {
            return redirect()->route('web.calendars.index')->with('error', 'Erro ao salvar');
        }
    }

    public function show()
    {
        $data = Calendar::getCalendars();

        return view('pages.calendars.show', compact('data'));
    }

    public function edit($uid)
    {
        try {
            $model = Calendar::where('uid', $uid)->firstOrFail();
        } catch (\Exception $e) {
            return redirect()->route('web.calendars.index');
        }

        return view('pages.calendars.edit', compact('model'));
    }

    public function update(CalendarRequest $request, $uid)
    {
        try {
            /** @var \App\Models\\Calendar $model */
            $model = Calendar::where('uid', $uid)->firstOrFail();
        } catch (\Exception $e) {
            return redirect()->route('web.calendars.index');
        }

        try {
            if (Calendar::updateCustom($request->all(), $model)) {
                return redirect()->route('web.calendars.index')->with('success', 'Salvo com sucesso');
            }
        } catch (\Exception $e) {
            return redirect()->route('web.calendars.index')->with('error', 'Erro ao salvar');
        }
    }

    /**
     * @param $uid
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($uid)
    {
        try {
            /** @var \App\Models\\Calendar $model */
            $model = Calendar::where('uid', $uid)->firstOrFail();
        } catch (\Exception $e) {
            return redirect()->route('web.calendars.index');
        }

        if ($model->delete()) {
            return redirect()->route('web.calendars.index')->with('success', 'Deletado com sucesso');
        }

        return redirect()->route('web.calendars.index')->with('error', 'Erro ao deletar');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function json()
    {
        $calendars = Calendar::getCalendars();

        return response()->json($calendars);
    }
}
