<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyContactRequest;
use App\Http\Requests\SearchPropertiesRequest;
use App\Mail\PropertyContactMail;
use App\Models\Property;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class PropertyController extends Controller
{
    public function index(SearchPropertiesRequest $request):View
    {
        $query = Property::query()->with('options')->orderBy('created_at', 'desc');

        if ($surface = $request->validated('surface')) {
            $query = $query->where('surface', '>=', $surface);
        }

        if ($rooms = $request->validated('rooms')) {
            $query = $query->where('rooms', '>=', $rooms);
        }

        if ($price = $request->validated('price')) {
            $query = $query->where('price', '<=', $price);
        }

        if ($title = $request->validated('title')) {
            $query = $query->where('title', 'like', "%{$title}%");
        }

        return view('property.index', [
            'properties' => $query->paginate(24),
            'input' => $request->validated(),
        ]);
    }

    public function show(string $slug, Property $property): View|RedirectResponse
    {
        $expectedSlug = $property->getSlug();
        if ($slug !== $expectedSlug) {
            return to_route('property.show', ["slug" => $expectedSlug, "property" => $property]);
        }

        return view('property.show', [
            'property' => $property
        ]);
    }

    public function contact(Property $property, PropertyContactRequest $request): RedirectResponse
    {
        Mail::send(new PropertyContactMail(
            $property,
            $request->validated()
        ));

        return redirect()->back()->with('success', 'Votre demande de contact à bien été envoyée');
    }
}
