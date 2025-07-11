<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PropertyFormRequest;
use App\Models\Option;
use App\Models\Picture;
use App\Models\Property;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.property.index', [
            'properties' => Property::orderBy('created_at', 'DESC')->withTrashed()->paginate(25)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $property = new Property();

        $property->fill([
            'surface' => 40,
            'rooms' => 3,
            'bedrooms' => 1,
            'floor' => 0,
            'city' => 'Montpelier',
            'postal_code' => 34000,
            'sold' => false
        ]);

        return view('admin.property.form', [
            'property' => $property,
            'options' => Option::pluck('name', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PropertyFormRequest $request)
    {
        $property = Property::create($request->validated());
        $property->options()->sync($request->validated('options'));
        $property->attachFile($request->validated('pictures'));

        return redirect()
            ->route('admin.property.index')->with('success', 'Le bien a bien été créé');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property): View
    {
        return view('admin.property.form', [
            'property' => $property,
            'options' => Option::pluck('name', 'id'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PropertyFormRequest $request, Property $property): RedirectResponse
    {
        $property->update($request->validated());
        $property->options()->sync($request->validated('options'));
        $property->attachFile($request->validated('pictures'));

        return redirect()
            ->route('admin.property.index')
            ->with('success', "Le bien à bien été modifié");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property): RedirectResponse
    {
        $ds = DIRECTORY_SEPARATOR;
        Picture::destroy($property->pictures()->pluck('id'));
        $property->delete();
        Storage::disk('public')->deleteDirectory('properties'.$ds.$property->id);
        return to_route('admin.property.index')->with('success', 'Le bien à bien été supprimé');
    }
}
