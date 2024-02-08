<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile.index');
    }
    public function store(Request $request)
    {
        $request->validate([
            'profil_image' => 'nullable|mimes:jpg,png,jpeg,webp|max:5120',
            'name' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $user = User::find(Auth::user()->id);

            if ($request->hasFile('profil_image')) {
                // If a new image file is provided in the request
                if ($user->profil_image !== null) {
                    // Delete the existing image
                    Storage::delete('public/' . $user->profil_image);
                }

                // Upload the new image
                $pathImage = $request->file('profil_image');
                $path = $pathImage->store('image', 'public');
                if (!$path) {
                    return redirect()->back()->with('error', 'Failed to upload the image.');
                }
            } else {
                // If no new image is provided, use the existing image path
                $path = $user->image;
            }

            $user->name = $request->name;
            $user->profil_image = $path;
            $user->save();
            DB::commit();
            return redirect()->route('profile.index')->with('success', 'Successfully update Profile!');
        } catch (Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

}
