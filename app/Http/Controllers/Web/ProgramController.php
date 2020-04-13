<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProgramRequest;
use App\Models\Program;

class ProgramController extends Controller
{
    public function index()
    {
        $data = Program::paginate(10);

        return view('pages.programs.index', compact('data'));
    }

    public function create()
    {
        return view('pages.programs.create');
    }

    public function store(ProgramRequest $request)
    {
        try {
            Program::createCustom($request->all());

            return redirect()->route('web.programs.index')->with('success', 'Salvo com sucesso');

        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->route('web.programs.index')->with('error', 'Erro ao salvar');
        }
    }

    public function edit($uid)
    {
        try {
            $model = Program::where('uid', $uid)->firstOrFail();
        } catch (\Exception $e) {
            return redirect()->route('web.programs.index');
        }

        return view('pages.programs.edit', compact('model'));
    }

    public function update(ProgramRequest $request, $uid)
    {
        try {
            $model = Program::where('uid', $uid)->firstOrFail();
        } catch (\Exception $e) {
            return redirect()->route('web.programs.index');
        }

        try {
            if (Program::updateCustom($request->all(), $model)) {
                return redirect()->route('web.programs.index')->with('success', 'Salvo com sucesso');
            }
        } catch (\Exception $e) {
            return redirect()->route('web.programs.index')->with('error', 'Erro ao salvar');
        }
    }

    public function destroy($uid)
    {
        try {
            $model = Program::where('uid', $uid)->firstOrFail();
        } catch (\Exception $e) {
            return redirect()->route('web.programs.index');
        }

        if ($model->delete()) {
            return redirect()->route('web.programs.index')->with('success', 'Deletado com sucesso');
        }

        return redirect()->route('web.programs.index')->with('error', 'Erro ao deletar');
    }
}
