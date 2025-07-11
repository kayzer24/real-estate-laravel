<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OptionFormRequest;
use App\Models\Option;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $options = Option::paginate(25);

        return view('admin.option.index', ['options' => $options]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $option = new Option();

        return view('admin.option.form', ['option' => $option]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OptionFormRequest $request): RedirectResponse
    {
        $option = Option::create($request->validated());

        return to_route('admin.option.index')->with('success', "L'option a bien été créée");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Option $option): View
    {
        return view('admin.option.form', ['option' => $option]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OptionFormRequest $request, Option $option): RedirectResponse
    {
        $option->update($request->validated());

        return to_route('admin.option.index')->with('success', "L'option a bien été modifié");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Option $option): RedirectResponse
    {
        $option->delete();

        return to_route('admin.option.index')->with('success', "L'option a bien été supprimée");

    }
}
