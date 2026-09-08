<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class DestinationController extends Controller
{
    /**
     * Display a listing of the destinations, with optional search.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $destinations = Destination::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            })
            ->withCount(['packages', 'hotels'])
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.destinations.index', [
            'destinations' => $destinations,
            'search' => $search,
        ]);
    }

    /**
     * Show the form for creating a new destination.
     */
    public function create()
    {
        return view('admin.destinations.create');
    }

    /**
     * Store a newly created destination in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->validateDestination($request);

        $validated['slug'] = $this->uniqueSlug($validated['name'], $request->input('slug'));

        Destination::create($validated);

        return redirect()
            ->route('admin.destinations.index')
            ->with('status', 'Destination created successfully.');
    }

    /**
     * Show the form for editing the specified destination.
     */
    public function edit(Destination $destination)
    {
        return view('admin.destinations.edit', [
            'destination' => $destination,
        ]);
    }

    /**
     * Update the specified destination in storage.
     */
    public function update(Request $request, Destination $destination)
    {
        $validated = $this->validateDestination($request, $destination->id);

        $validated['slug'] = $this->uniqueSlug(
            $validated['name'],
            $request->input('slug'),
            $destination->id
        );

        $destination->update($validated);

        return redirect()
            ->route('admin.destinations.index')
            ->with('status', 'Destination updated successfully.');
    }

    /**
     * Remove the specified destination from storage.
     */
    public function destroy(Destination $destination)
    {
        // Guard against deleting a destination that still has packages or hotels
        // attached — those belongsTo relationships would otherwise be orphaned.
        $packageCount = $destination->packages()->count();
        $hotelCount = $destination->hotels()->count();

        if ($packageCount > 0 || $hotelCount > 0) {
            return redirect()
                ->route('admin.destinations.index')
                ->with('error', "Can't delete \"{$destination->name}\" — it still has {$packageCount} package(s) and {$hotelCount} hotel(s) attached. Remove those first.");
        }

        $destination->delete();

        return redirect()
            ->route('admin.destinations.index')
            ->with('status', 'Destination deleted successfully.');
    }

    /**
     * Shared validation rules for store/update.
     */
    protected function validateDestination(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                'alpha_dash',
                Rule::unique('destinations', 'slug')->ignore($ignoreId),
            ],
            'location' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);
    }

    /**
     * Build a unique slug: use the submitted slug if given, otherwise derive
     * from the name, appending -2, -3, etc. if it collides with another row.
     */
    protected function uniqueSlug(string $name, ?string $slugInput, ?int $ignoreId = null): string
    {
        $base = Str::slug($slugInput ?: $name);
        $slug = $base;
        $i = 2;

        while (
            Destination::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }
}
