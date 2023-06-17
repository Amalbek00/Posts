<?php

namespace App\Http\Controllers;


use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index(): View
    {
          $users = User::all();
        return view('users.index', compact('users'));
    }
    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return View
     */
    public function show(User $user): View
    {

        $photos = $user->photos()->orderByDesc('created_at')->paginate(4);

        return view('users.show', compact('user', 'photos'));
    }


    /**
     * @param User $user
     * @return View
     */
    public function edit(User $user): View
    {
        return view('users.edit', compact('user'));
    }


    /**
     * @param UserRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $data = $request->all();

        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('pictures', 'public');
        }

        $user->update($data);

        return redirect()
            ->route('users.show', ['user' => $user])
            ->with('status', $user->name . " successfully updated!");
    }

}
