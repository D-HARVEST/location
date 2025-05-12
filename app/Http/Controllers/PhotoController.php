<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PhotoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $photos = Photo::paginate();

        return view('photo.index', compact('photos'))
            ->with('i', ($request->input('page', 1) - 1) * $photos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $photo = new Photo();

        return view('photo.create', compact('photo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PhotoRequest $request): RedirectResponse
    {
        $all = $request->validated();
        Photo::create($all);

        return Redirect::route('photos.index')
            ->with('success', 'Photo a été créé(e) avec succes !');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $photo = Photo::findOrFail($id);

        return view('photo.show', compact('photo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $photo = Photo::findOrFail($id);

        return view('photo.edit', compact('photo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PhotoRequest $request, Photo $photo): RedirectResponse
    {
        $all=$request->validated();
        $photo->update($all);

        return Redirect::route('photos.index')
            ->with('success', 'Photo a été mis(e) à jour avec succes !');
    }

    public function destroy($id): RedirectResponse
    {
        $data = Photo::findOrFail($id);

        try {
            $data->delete();
        } catch (\Throwable $th) {
            return redirect()->back()
                ->withErrors(["Une erreur s'est produite lors de la suppression du Photo !" . $th->getMessage()]);
        }


        return Redirect::route('photos.index')
            ->with('success', 'Photo a été supprimé(e) avec succes !');
    }
}
