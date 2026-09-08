<x-admin-layout title="Add Destination">
    <div class="max-w-2xl space-y-6">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">Add Destination</h1>
            <p class="text-sm text-slate-500">Create a new destination for travellers to browse.</p>
        </div>

        <div class="rounded-2xl bg-white shadow p-6">
            <form method="POST" action="{{ route('admin.destinations.store') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="mt-1 block w-full rounded-2xl border-slate-200 text-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="slug" class="block text-sm font-medium text-slate-700">
                        Slug <span class="text-slate-400 font-normal">(optional — auto-generated from name if left blank)</span>
                    </label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                        class="mt-1 block w-full rounded-2xl border-slate-200 text-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('slug')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="location" class="block text-sm font-medium text-slate-700">Location</label>
                    <input type="text" name="location" id="location" value="{{ old('location') }}" required
                        class="mt-1 block w-full rounded-2xl border-slate-200 text-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('location')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-slate-700">Description</label>
                    <textarea name="description" id="description" rows="5"
                        class="mt-1 block w-full rounded-2xl border-slate-200 text-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-2xl bg-gradient-to-r from-blue-600 to-cyan-500 px-5 py-2.5 text-sm font-semibold text-white shadow hover:opacity-90 transition">
                        Create Destination
                    </button>
                    <a href="{{ route('admin.destinations.index') }}" class="text-sm text-slate-500 hover:text-slate-700">
                        Cancel
                    </a>
                </div>
            </form>
        </div>

    </div>
</x-admin-layout>
