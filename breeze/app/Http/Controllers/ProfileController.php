<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $user = $request->user();
    $request->validated();

    // Check if the email is being updated
    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    // Check if the user wants to remove the picture
    if ($request->remove_picture == '1') {
        // Define the path of the old picture
        $oldPicturePath = $user->picture;

        // Delete the old picture if it exists
        if ($oldPicturePath && Storage::disk('public')->exists($oldPicturePath)) {
            Storage::disk('public')->delete($oldPicturePath);
        }

        // Reset the picture path in the user model to the default avatar
        $user->picture = '';
    }

    // Check if a new picture is being uploaded
    if ($request->hasFile('picture')) {
        // Define the path of the old picture
        $oldPicturePath = $user->picture;

        // Delete the old picture if it exists
        if ($oldPicturePath && Storage::disk('public')->exists($oldPicturePath)) {
            Storage::disk('public')->delete($oldPicturePath);
        }

        // Store the new picture
        $path = $request->file('picture')->store('pictures', 'public');
        $user->picture = $path;
    }

    // Save the user data
    $user->save();

    return Redirect::route('profile.edit')->with('status', 'profile-updated');
}


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
