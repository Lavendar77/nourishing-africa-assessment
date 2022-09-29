<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            ->when(
                $request->query('search'),
                fn ($query) => $query->where(
                    DB::raw('LOWER(name)'),
                    'LIKE',
                    '%' . strtolower($request->query('search')) . '%'
                )
            );

        return Inertia::render('Dashboard', [
            'companies' => $companies->get(),
        ]);
    }
}
