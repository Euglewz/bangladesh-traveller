<x-admin-layout title="Edit Package">
    <div class="max-w-2xl space-y-6">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">Edit Package</h1>
            <p class="text-sm text-slate-500">Update details for {{ $package->name }}.</p>
        </div>

        <div class="rounded-2xl bg-white shadow p-6">
            <form method="POST" action="{{ route('admin.packages.update', $package) }}" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="destination_id" class="block text-sm font-medium text-slate-700">Destination</label>
                    <select name="destination_id" id="destination_id" required
                        class="mt-1 block w-full rounded-2xl border-slate-200 text-sm focus:border-blue-500 focus:ring-blue-500">
                        @foreach ($destinations as $destination)
                            <option value="{{ $destination->id }}" @selected(old('destination_id', $package->destination_id) == $destination->id)>
                                {{ $destination->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('destination_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $package->name) }}" required
                        class="mt-1 block w-full rounded-2xl border-slate-200 text-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="price" class="block text-sm font-medium text-slate-700">Price (USD)</label>
                        <input type="number" step="0.01" min="0" name="price" id="price" value="{{ old('price', $package->price) }}" required
                            class="mt-1 block w-full rounded-2xl border-slate-200 text-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="duration" class="block text-sm font-medium text-slate-700">Duration</label>
                        <input type="text" name="duration" id="duration" value="{{ old('duration', $package->duration) }}" required
                            class="mt-1 block w-full rounded-2xl border-slate-200 text-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('duration')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-slate-700">Description</label>
                    <textarea name="description" id="description" rows="5"
                        class="mt-1 block w-full rounded-2xl border-slate-200 text-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description', $package->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700">Current Image</label>
                    @if ($package->image)
                        <img src="{{ Storage::url($package->image) }}" alt="{{ $package->name }}"
                             class="mt-2 h-24 w-32 object-cover rounded-2xl">
                    @else
                        <p class="mt-2 text-sm text-slate-400">No image uploaded yet.</p>
                    @endif
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-slate-700">
                        Replace Image <span class="text-slate-400 font-normal">(optional)</span>
                    </label>
                    <input type="file" name="image" id="image" accept="image/*"
                        class="mt-1 block w-full text-sm text-slate-600 file:mr-4 file:rounded-2xl file:border-0 file:bg-slate-100 file:px-4 file:py-2 file:text-sm file:font-medium file:text-slate-600 hover:file:bg-slate-200">
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-2xl bg-gradient-to-r from-blue-600 to-cyan-500 px-5 py-2.5 text-sm font-semibold text-white shadow hover:opacity-90 transition">
                        Save Changes
                    </button>
                    <a href="{{ route('admin.packages.index') }}" class="text-sm text-slate-500 hover:text-slate-700">
                        Cancel
                    </a>
                </div>
            </form>
        </div>

    </div>
</x-admin-layout>
