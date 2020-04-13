<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = User::paginate(10);

        return view('pages.users.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        try {
            User::createCustom($request->all());

            return redirect()->route('web.users.index')->with('success', 'Salvo com sucesso');

        } catch (\Exception $e) {
            return redirect()->route('web.users.index')->with('error', 'Erro ao salvar');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $uid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($uid)
    {
        try {
            $user = User::where('uid', $uid)->firstOrFail();
        } catch (\Exception $e) {
            return redirect()->route('web.users.index');
        }

        return view('pages.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserRequest  $request
     * @param $uid
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, $uid)
    {
        try {
            /** @var User $user */
            $user = User::where('uid', $uid)->firstOrFail();
        } catch (\Exception $e) {
            return redirect()->route('web.users.index');
        }

        try {
            if (User::updateCustom($request->all(), $user)) {
                return redirect()->route('web.users.index')->with('success', 'Salvo com sucesso');
            }
        } catch (\Exception $e) {
            return redirect()->route('web.users.index')->with('error', 'Erro ao salvar');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($uid)
    {
        try {
            $user = User::where('uid', $uid)->firstOrFail();
        } catch (\Exception $e) {
            return redirect()->route('web.users.index');
        }

        if ($user->delete()) {
            return redirect()->route('web.users.index')->with('success', 'Deletado com sucesso');
        }

        return redirect()->route('web.users.index')->with('error', 'Erro ao deletar');
    }

    public function profile()
    {
        $user = auth()->user();

        return view('pages.users.profile', compact('user'));
    }

    public function updateProfile(ProfileRequest $request)
    {
        $user = User::find(auth()->user()->id);

        $data = $request->all();
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $user->fill($request->all());

        if ($user->save()) {

            return redirect()->route('web.users.profile')->with('success', 'Salvo com sucesso');
        }

        return redirect()->route('web.users.profile')->with('error', 'Erro ao salvar');
    }
}
