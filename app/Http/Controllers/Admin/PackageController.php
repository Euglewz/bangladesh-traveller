<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PackageController extends Controller
{
    /**
     * Display a listing of the packages, with optional search.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $packages = Package::query()
            ->with('destination')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhereHas('destination', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.packages.index', [
            'packages' => $packages,
            'search' => $search,
        ]);
    }

    /**
     * Show the form for creating a new package.
     */
    public function create()
    {
        return view('admin.packages.create', [
            'destinations' => Destination::orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created package in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->validatePackage($request);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('packages', 'public');
        }

        Package::create($validated);

        return redirect()
            ->route('admin.packages.index')
            ->with('status', 'Package created successfully.');
    }

    /**
     * Show the form for editing the specified package.
     */
    public function edit(Package $package)
    {
        return view('admin.packages.edit', [
            'package' => $package,
            'destinations' => Destination::orderBy('name')->get(),
        ]);
    }

    /**
     * Update the specified package in storage.
     */
    public function update(Request $request, Package $package)
    {
        $validated = $this->validatePackage($request);

        if ($request->hasFile('image')) {
            // Remove the old image before saving the new one, so we don't
            // accumulate orphaned files in storage over time.
            if ($package->image) {
                Storage::disk('public')->delete($package->image);
            }

            $validated['image'] = $request->file('image')->store('packages', 'public');
        }

        $package->update($validated);

        return redirect()
            ->route('admin.packages.index')
            ->with('status', 'Package updated successfully.');
    }

    /**
     * Remove the specified package from storage.
     */
    public function destroy(Package $package)
    {
        if ($package->image) {
            Storage::disk('public')->delete($package->image);
        }

        $package->delete();

        return redirect()
            ->route('admin.packages.index')
            ->with('status', 'Package deleted successfully.');
    }

    /**
     * Shared validation rules for store/update.
     */
    protected function validatePackage(Request $request): array
    {
        return $request->validate([
            'destination_id' => ['required', 'exists:destinations,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'duration' => ['required', 'string', 'max:100'],
            'image' => ['nullable', 'image', 'max:4096'],
        ]);
    }
}
