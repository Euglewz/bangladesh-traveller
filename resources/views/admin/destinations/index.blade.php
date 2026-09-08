<x-admin-layout title="Manage Destinations">
    <div class="space-y-6">

        {{-- Flash messages --}}
        @if (session('status'))
            <div class="rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 text-sm">
                {{ session('status') }}
            </div>
        @endif

        @if (session('error'))
            <div class="rounded-2xl bg-red-50 border border-red-200 text-red-700 px-4 py-3 text-sm">
                {{ session('error') }}
            </div>
        @endif

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Destinations</h1>
                <p class="text-sm text-slate-500">Manage the destinations travellers can browse and book packages for.</p>
            </div>

            <a href="{{ route('admin.destinations.create') }}"
               class="inline-flex items-center justify-center rounded-2xl bg-gradient-to-r from-blue-600 to-cyan-500 px-5 py-2.5 text-sm font-semibold text-white shadow hover:opacity-90 transition">
                + Add Destination
            </a>
        </div>

        {{-- Search --}}
        <form method="GET" action="{{ route('admin.destinations.index') }}" class="flex gap-2">
            <input
                type="text"
                name="search"
                value="{{ $search }}"
                placeholder="Search by name or location..."
                class="w-full sm:w-80 rounded-2xl border-slate-200 text-sm focus:border-blue-500 focus:ring-blue-500"
            >
            <button type="submit"
                class="rounded-2xl bg-slate-100 px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-200 transition">
                Search
            </button>
            @if ($search)
                <a href="{{ route('admin.destinations.index') }}"
                   class="rounded-2xl px-4 py-2 text-sm font-medium text-slate-400 hover:text-slate-600 transition">
                    Clear
                </a>
            @endif
        </form>

        {{-- Table --}}
        <div class="rounded-2xl bg-white shadow overflow-hidden">
            <table class="min-w-full divide-y divide-slate-100 text-sm">
                <thead class="bg-slate-50">
                    <tr class="text-left text-slate-500">
                        <th class="px-6 py-3 font-medium">Name</th>
                        <th class="px-6 py-3 font-medium">Slug</th>
                        <th class="px-6 py-3 font-medium">Location</th>
                        <th class="px-6 py-3 font-medium">Packages</th>
                        <th class="px-6 py-3 font-medium">Hotels</th>
                        <th class="px-6 py-3 font-medium text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($destinations as $destination)
                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="px-6 py-4 font-medium text-slate-800">{{ $destination->name }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $destination->slug }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $destination->location }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $destination->packages_count }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $destination->hotels_count }}</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-3">
                                    <a href="{{ route('admin.destinations.edit', $destination) }}"
                                       class="text-blue-600 hover:text-blue-800 font-medium">Edit</a>

                                    <form action="{{ route('admin.destinations.destroy', $destination) }}"
                                          method="POST"
                                          onsubmit="return confirm('Delete {{ $destination->name }}? This cannot be undone.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 font-medium">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-slate-400">
                                No destinations found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div>
            {{ $destinations->links() }}
        </div>

    </div>
</x-admin-layout>
