<x-admin-layout title="Edit User">

    <div class="max-w-xl bg-white rounded-2xl shadow-sm border border-slate-200 p-8">

        <div class="mb-6">
            <p class="text-sm text-slate-500">Editing</p>
            <h2 class="text-xl font-bold text-slate-900">{{ $user->name }}</h2>
            <p class="text-sm text-slate-500">{{ $user->email }}</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 bg-red-50 border-2 border-red-200 text-red-700 rounded-xl p-4 text-sm font-semibold space-y-1">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="role" class="block text-sm font-bold text-slate-800 mb-2">Role</label>
                <select id="role" name="role" class="w-full px-4 py-2.5 border-2 border-slate-200 rounded-xl focus:outline-none focus:border-blue-500 text-sm">
                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-cyan-600 text-white font-bold rounded-xl text-sm hover:from-blue-700 hover:to-cyan-700 transition">
                    Save Changes
                </button>
                <a href="{{ route('admin.users.index') }}" class="px-6 py-2.5 bg-slate-100 text-slate-700 font-bold rounded-xl text-sm hover:bg-slate-200 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>

</x-admin-layout>
