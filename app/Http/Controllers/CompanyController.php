<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Models\Country;
use App\Providers\RouteServiceProvider;
use Inertia\Inertia;

class CompanyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param \App\Models\Company $company
     */
    public function __construct(public Company $company)
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Company/Create', [
            'countries' => Country::select(['id', 'name'])->orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompanyRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCompanyRequest $request)
    {
        throw_if(
            $request->user()->companies()->count() >= 3,
            \Exception::class,
            'You cannot have more than 3 companies'
        );

        $this->company->query()->create([
            'user_id' => $request->user()->id,
            'country_id' => $request->country_id,
            'name' => $request->name,
            'email' => $request->email,
        ]);

        session()->flash('message', 'Company created successfully');

        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Inertia\Response
     */
    public function edit(Company $company)
    {
        $this->authorize('update', $company);

        return Inertia::render('Company/Edit', [
            'countries' => Country::select(['id', 'name'])->orderBy('name')->get(),
            'company' => $company,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompanyRequest  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $this->authorize('update', $company);

        $company->update([
            'country_id' => $request->country_id,
            'name' => $request->name,
            'email' => $request->email,
        ]);

        session()->flash('message', 'Company updated successfully');

        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Company $company)
    {
        $this->authorize('delete', $company);

        $company->delete();

        session()->flash('message', 'Company deleted successfully');

        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Restore the specified resource to storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(Company $company)
    {
        $this->authorize('restore', $company);

        $company->restore();

        session()->flash('message', 'Company restored successfully');

        return redirect(RouteServiceProvider::HOME);
    }
}
