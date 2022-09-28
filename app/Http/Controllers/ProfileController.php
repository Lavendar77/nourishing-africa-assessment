<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\Country;
use Inertia\Inertia;

class ProfileController extends Controller
{
    /**
     * Show user profile page.
     *
     * @return \Inertia\Response
     */
    public function show()
    {
        return Inertia::render('Profile', [
            'countries' => Country::select(['id', 'name'])->orderBy('name')->get(),
        ]);
    }

    /**
     * Update user profile.
     *
     * @param \App\Http\Requests\UpdateProfileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateProfileRequest $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        $user->update([
            'country_id' => $request->country_id,
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
        ]);

        session()->flash('message', 'Profile updated successfully');

        return redirect()->route('profile');
    }
}
