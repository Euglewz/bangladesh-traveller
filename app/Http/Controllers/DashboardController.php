<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        return view('dashboard', [
            'reviews' => $user->reviews()->with('reviewable')->latest()->get(),
        ]);
    }
}
