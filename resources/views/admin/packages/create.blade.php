<x-admin-layout title="Add Package">
    <div class="max-w-2xl space-y-6">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">Add Package</h1>
            <p class="text-sm text-slate-500">Create a new tour package under a destination.</p>
        </div>

        <div class="rounded-2xl bg-white shadow p-6">
            <form method="POST" action="{{ route('admin.packages.store') }}" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <div>
                    <label for="destination_id" class="block text-sm font-medium text-slate-700">Destination</label>
                    <select name="destination_id" id="destination_id" required
                        class="mt-1 block w-full rounded-2xl border-slate-200 text-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="" disabled {{ old('destination_id') ? '' : 'selected' }}>Select a destination</option>
                        @foreach ($destinations as $destination)
                            <option value="{{ $destination->id }}" @selected(old('destination_id') == $destination->id)>
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
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="mt-1 block w-full rounded-2xl border-slate-200 text-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="price" class="block text-sm font-medium text-slate-700">Price (USD)</label>
                        <input type="number" step="0.01" min="0" name="price" id="price" value="{{ old('price') }}" required
                            class="mt-1 block w-full rounded-2xl border-slate-200 text-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="duration" class="block text-sm font-medium text-slate-700">Duration</label>
                        <input type="text" name="duration" id="duration" value="{{ old('duration') }}" required
                            placeholder="e.g. 3 days, 2 nights"
                            class="mt-1 block w-full rounded-2xl border-slate-200 text-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('duration')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-slate-700">Description</label>
                    <textarea name="description" id="description" rows="5"
                        class="mt-1 block w-full rounded-2xl border-slate-200 text-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-slate-700">Image</label>
                    <input type="file" name="image" id="image" accept="image/*"
                        class="mt-1 block w-full text-sm text-slate-600 file:mr-4 file:rounded-2xl file:border-0 file:bg-slate-100 file:px-4 file:py-2 file:text-sm file:font-medium file:text-slate-600 hover:file:bg-slate-200">
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-2xl bg-gradient-to-r from-blue-600 to-cyan-500 px-5 py-2.5 text-sm font-semibold text-white shadow hover:opacity-90 transition">
                        Create Package
                    </button>
                    <a href="{{ route('admin.packages.index') }}" class="text-sm text-slate-500 hover:text-slate-700">
                        Cancel
                    </a>
                </div>
            </form>
        </div>

    </div>
</x-admin-layout>
