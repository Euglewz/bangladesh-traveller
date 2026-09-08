<x-app-layout title="Dashboard">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 mb-8">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-600 to-cyan-600 flex items-center justify-center text-white text-2xl font-black">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div>
                    <h1 class="text-2xl font-black text-slate-900">Welcome back, {{ auth()->user()->name }}</h1>
                    <p class="text-slate-600">@{{ auth()->user()->username }}</p>
                </div>
            </div>

            <div class="mt-6 flex gap-3">
                <a href="{{ route('profile.edit') }}" class="px-5 py-2.5 rounded-xl bg-slate-100 text-slate-700 font-semibold text-sm hover:bg-slate-200 transition">
                    Edit Profile
                </a>
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-blue-600 to-cyan-600 text-white font-semibold text-sm hover:from-blue-700 hover:to-cyan-700 transition">
                        Go to Admin Panel
                    </a>
                @endif
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
            <h2 class="text-lg font-bold text-slate-900 mb-4">Your Reviews</h2>

            @if ($reviews->isEmpty())
                <p class="text-sm text-slate-500">You haven't left any reviews yet. Visit a destination, package, or hotel page to share your experience.</p>
            @else
                <div class="divide-y divide-slate-100">
                    @foreach ($reviews as $review)
                        <div class="py-4 flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm font-semibold text-slate-900">{{ $review->reviewable->name ?? 'Deleted item' }}</p>
                                <p class="text-sm text-slate-600 mt-1">{{ $review->comment }}</p>
                                <p class="text-xs text-slate-400 mt-1">{{ $review->created_at->diffForHumans() }}</p>
                            </div>
                            <span class="shrink-0 text-sm font-bold text-amber-500">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</x-app-layout>
