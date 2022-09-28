<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Inertia\Response
     */
    public function __invoke()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        $companies = $user->companies()->with('country:id,name')->withTrashed()->get();

        return Inertia::render('Dashboard', [
            'companies' => $companies,
        ]);
    }
}
