<x-admin-layout title="Manage Packages">
    <div class="space-y-6">

        @if (session('status'))
            <div class="rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 text-sm">
                {{ session('status') }}
            </div>
        @endif

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Packages</h1>
                <p class="text-sm text-slate-500">Manage tour packages offered for each destination.</p>
            </div>

            <a href="{{ route('admin.packages.create') }}"
               class="inline-flex items-center justify-center rounded-2xl bg-gradient-to-r from-blue-600 to-cyan-500 px-5 py-2.5 text-sm font-semibold text-white shadow hover:opacity-90 transition">
                + Add Package
            </a>
        </div>

        <form method="GET" action="{{ route('admin.packages.index') }}" class="flex gap-2">
            <input
                type="text"
                name="search"
                value="{{ $search }}"
                placeholder="Search by package or destination name..."
                class="w-full sm:w-80 rounded-2xl border-slate-200 text-sm focus:border-blue-500 focus:ring-blue-500"
            >
            <button type="submit"
                class="rounded-2xl bg-slate-100 px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-200 transition">
                Search
            </button>
            @if ($search)
                <a href="{{ route('admin.packages.index') }}"
                   class="rounded-2xl px-4 py-2 text-sm font-medium text-slate-400 hover:text-slate-600 transition">
                    Clear
                </a>
            @endif
        </form>

        <div class="rounded-2xl bg-white shadow overflow-hidden">
            <table class="min-w-full divide-y divide-slate-100 text-sm">
                <thead class="bg-slate-50">
                    <tr class="text-left text-slate-500">
                        <th class="px-6 py-3 font-medium">Image</th>
                        <th class="px-6 py-3 font-medium">Name</th>
                        <th class="px-6 py-3 font-medium">Destination</th>
                        <th class="px-6 py-3 font-medium">Price</th>
                        <th class="px-6 py-3 font-medium">Duration</th>
                        <th class="px-6 py-3 font-medium text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($packages as $package)
                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="px-6 py-3">
                                @if ($package->image)
                                    <img src="{{ Storage::url($package->image) }}" alt="{{ $package->name }}"
                                         class="h-12 w-16 object-cover rounded-xl">
                                @else
                                    <div class="h-12 w-16 rounded-xl bg-slate-100 flex items-center justify-center text-slate-300 text-xs">
                                        N/A
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-medium text-slate-800">{{ $package->name }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $package->destination->name }}</td>
                            <td class="px-6 py-4 text-slate-500">${{ number_format($package->price, 2) }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $package->duration }}</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-3">
                                    <a href="{{ route('admin.packages.edit', $package) }}"
                                       class="text-blue-600 hover:text-blue-800 font-medium">Edit</a>

                                    <form action="{{ route('admin.packages.destroy', $package) }}"
                                          method="POST"
                                          onsubmit="return confirm('Delete {{ $package->name }}? This cannot be undone.');">
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
                                No packages found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div>
            {{ $packages->links() }}
        </div>

    </div>
</x-admin-layout>
