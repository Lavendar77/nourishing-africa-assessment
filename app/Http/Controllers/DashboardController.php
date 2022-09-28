<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Inertia\Response
     */
    public function __invoke(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        $companies = $user->companies()
            ->with('country:id,name')
            ->withTrashed()
            ->when($request->search, fn ($query) => $query->where('name', 'LIKE', "%{$request->search}%"))
            ->get();

        return Inertia::render('Dashboard', [
            'companies' => $companies,
        ]);
    }
}
