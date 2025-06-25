<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'name' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|in:male,female,other',
            'day' => 'nullable|integer|min:1|max:31',
            'month' => 'nullable|integer|min:1|max:12',
            'year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'image' => 'nullable|image|mimes:jpeg,png|max:2048',
        ]);

        // Handle date of birth
        if ($request->day && $request->month && $request->year) {
            $validated['dob'] = sprintf('%04d-%02d-%02d', $request->year, $request->month, $request->day);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = uniqid('profile_') . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/profile_images'), $filename);
            $validated['profile_image'] = 'assets/profile_images/' . $filename;
        }

        $user->update($validated);

        return back()->with('success', 'Profile updated!');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'current_password' => 'required',
            'new_password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/', // at least one lowercase
                'regex:/[A-Z]/', // at least one uppercase
                'regex:/[0-9]/', // at least one digit
                'regex:/[@$!%*#?&]/', // at least one special char
                'confirmed',
            ],
        ]);
        // Check current password
        if (!\Hash::check($request->current_password, $user->password)) {
            return back()->with('password_error', 'Current password is incorrect.')->withInput();
        }
        // Update password
        $user->password = bcrypt($request->new_password);
        $user->save();
        return back()->with('password_success', 'Password updated successfully!');
    }
} 