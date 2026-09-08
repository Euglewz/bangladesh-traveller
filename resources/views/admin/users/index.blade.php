<x-admin-layout title="Manage Users">

    @if (session('error'))
        <div class="mb-6 bg-red-50 border-2 border-red-200 text-red-700 rounded-xl p-4 text-sm font-semibold">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">

        <div class="p-6 border-b border-slate-200">
            <form method="GET" class="flex gap-3">
                <input type="text" name="search" value="{{ $search }}" placeholder="Search by name, email, or username..."
                       class="flex-1 px-4 py-2.5 border-2 border-slate-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm">
                <button type="submit" class="px-5 py-2.5 bg-slate-900 text-white rounded-xl font-semibold text-sm hover:bg-slate-800 transition">
                    Search
                </button>
                @if ($search)
                    <a href="{{ route('admin.users.index') }}" class="px-5 py-2.5 bg-slate-100 text-slate-700 rounded-xl font-semibold text-sm hover:bg-slate-200 transition">
                        Clear
                    </a>
                @endif
            </form>
        </div>

        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-500 text-xs uppercase font-bold">
                <tr>
                    <th class="text-left px-6 py-3">Name</th>
                    <th class="text-left px-6 py-3">Email</th>
                    <th class="text-left px-6 py-3">Username</th>
                    <th class="text-left px-6 py-3">Role</th>
                    <th class="text-left px-6 py-3">Joined</th>
                    <th class="text-right px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($users as $user)
                    <tr>
                        <td class="px-6 py-4 font-semibold text-slate-900">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $user->email }}</td>
                        <td class="px-6 py-4 text-slate-600">@{{ $user->username }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $user->role === 'admin' ? 'bg-blue-100 text-blue-700' : 'bg-slate-100 text-slate-600' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-slate-500">{{ $user->created_at->format('M j, Y') }}</td>
                        <td class="px-6 py-4 text-right space-x-2 whitespace-nowrap">
                            <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600 font-semibold hover:underline">Edit</a>
                            @if ($user->id !== auth()->id())
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline" onsubmit="return confirm('Delete this user? This cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 font-semibold hover:underline">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-slate-400">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-6 border-t border-slate-200">
            {{ $users->links() }}
        </div>
    </div>

</x-admin-layout>
