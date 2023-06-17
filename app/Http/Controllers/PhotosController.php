<?php

namespace App\Http\Controllers;


use App\Http\Form\PhotoForm;
use App\Http\Requests\PhotoRequest;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */


    public function index(): View
    {
        $user = Auth::user();

        $photos = Photo::whereIn('user_id', function($query) use ($user) {
            $query->select('users.id')
                ->from('users');
        })
            ->orderByDesc('created_at')
            ->paginate(8);

        return view('photos.index', compact('photos'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create(Photo $photo): View
    {
        $users = User::all();
        return view('photos.create', compact('photo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PhotoRequest $request
     * @return RedirectResponse
     */
    public function store(PhotoRequest $request): RedirectResponse
    {
        $photo = PhotoForm::execute($request);

        return redirect()
            ->route('users.show', ['user' => $photo->user])
            ->with('status', "Photo successfully created!");
    }

    /**
     * Display the specified resource.
     *
     * @param Photo $photo
     * @return Application|Factory|View|Response
     */
    public function show(Photo $photo): View
    {
        return view('photos.show', compact('photo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Photo $photo
     * @return Application|Factory|View|Response
     */
    public function edit(Photo $photo): View
    {
        return view('photos.edit', compact('photo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PhotoRequest $request
     * @param Photo $photo
     * @return RedirectResponse
     */
    public function update(PhotoRequest $request, Photo $photo): RedirectResponse
    {
        $data = $request->all();

        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('pictures', 'public');
        }

        $photo->update($data);

        return redirect()
            ->route('photos.show', ['photo' => $photo])
            ->with('status', "Photo successfully updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Photo $photo
     * @return RedirectResponse
     */
    public function destroy(Photo $photo): RedirectResponse
    {
        $photo->delete();

        return redirect()->route('users.show', ['user' => $photo->user])
            ->with('status', 'Photo successfully deleted!');
    }

}
