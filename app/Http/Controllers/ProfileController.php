<?php

namespace App\Http\Controllers;

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

    public function index()
    {
        return view('profile', ['user' => Auth::user()]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request)
    {
        $user = User::where('id', operator: Auth::id())->get();
        // dd($user);
        $request->validate([
            'name'    => 'required|string|max:255',
            'photo'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'gender'  => 'nullable|string',
            'address' => 'nullable|string',
            'phone'   => 'nullable|string|max:15',
        ]);

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }

            // Simpan foto baru
            // $path = $request->file('photo')->store('profiles', 'public');
            // $user->photo = $path;

            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = Storage::disk('public')->putFileAs('profiles', $file, $filename);
            $fullPath = '/storage/' . $path;

            $user->photo = $fullPath;
        }

        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->phone = $request->phone;

        $user->save();
        
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
            return redirect()->route('profile')->with('error', 'Password saat ini salah.');
        }

        $user->password = Hash::make($request->new_password);
       

        return redirect()->route('profile')->with('success', 'Password berhasil diperbarui.');
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
