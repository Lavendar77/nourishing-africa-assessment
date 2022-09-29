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

        session()->flash('message', $request->query('search'));

        $companies = $user->companies()
            ->with('country:id,name')
            ->withTrashed()
            ->when(
                $request->query('search'),
                fn ($query) => $query->where('name', 'LIKE', "%{$request->query('search')}%")
            )
            ->get();

        return Inertia::render('Dashboard', [
            'companies' => $companies,
        ]);
    }
}
