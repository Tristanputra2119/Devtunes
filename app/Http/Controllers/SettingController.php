<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SettingController extends Controller
{
    public function index(string $id)
    {
        $users = User::find($id);
        return view('admin.setting.index', compact('users'));
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'email' => ['nullable', 'email', Rule::unique('users')->ignore(Auth::id(), 'id')],
            'old_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|confirmed|min:8',
        ]);
        try {
            DB::beginTransaction();
            $users = User::findOrFail($id);

            if ($users->id !== Auth::id()) {
                return redirect()->back()->with('error', 'You cannot change someone else\'s password!');
            }

            if ($request->has('email') && $request->input('email') !== $users->email) {
                $users->email = $request->email;
            }

            if ($request->has('new_password') && $request->input('new_password')) {
                if (!Hash::check($request->old_password, $users->password)) {
                    return back()->with('error', "Old Password Doesn't match!");
                }

                $users->password = Hash::make($request->new_password);
            }

            $users->save();

            DB::commit();

            return redirect()->route('playlist.index', $id)->with('success', 'Successfully updated Password!');
        } catch (\Exception $e) {
            DB::rollback();

            return back()->with('error', 'An error occurred while updating the profile. Please try again later.');
        }
    }
}
