<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{

    public function show()
{
    $user = Auth::user();
    return view('profile.index', compact('user'));
}


    public function index()
    {
        return view('profile', ['user' => Auth::user()]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(ProfileUpdateRequest $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    
    public function update(ProfileUpdateRequest $request)
    {
    $user = User::find(Auth::id());

    if (!$user) {
        return redirect()->route('profile.index')->with('error', 'User tidak ditemukan.');
    }

    if ($request->hasFile('photo')) {
        if ($user->photo && file_exists(public_path(path: 'storage/' . $user->photo))) {
            unlink(public_path('storage/' . $user->photo));
        }

        $path = $request->file('photo')->store('profile_photos', 'public');
        
        $user->photo = $path;
    }

    $user->update($request->except('photo'));

    return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui.');
    }


    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->route('profile.edit')->with('error', 'Password saat ini salah.');
        }

        $user->password = Hash::make($request->new_password);
       

        return redirect()->route('profile.edit')->with('success', 'Password berhasil diperbarui.');
    }

    

    /**
     * Update the user's password.
     */


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
