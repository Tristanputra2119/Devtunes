<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Auth::user();
        $playlist = Playlist::where('user_id', $users->id)->withCount('music')->orderBy('created_at', 'desc')->get();

        return view('admin.playlist.index', compact('users', 'playlist'));
    }

    //update playlist status
    public function status(Request $request)
    {
        try {
            DB::beginTransaction();
            $playlistId = $request->id;
            $status = $request->input('status');

            DB::table('playlists')->where('id', $playlistId)->update(['status' => $status]);

            DB::commit();
        } catch (Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'image' => 'nullable|mimes:jpg,png,jpeg,webp|max:5120',
            'title' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $request->file('image');
            //upload image
            $pathImage = $request->file('image');
            $path = $pathImage->store('image', 'public');

            $playlist = Playlist::create([
                'user_id' => Auth::user()->id,
                'image' => $path,
                'title' => $request->title,
            ]);
            DB::commit();
            return redirect()->route('playlist.index')->with('success', 'Successfully creates Playlist!');
        } catch (Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function getPlaylist(string $id)
    {
        try {
            $find = Playlist::find($id);
            $find->previewImage = asset('storage/' . $find->image);

            return response()->json([
                'success' => true,
                'data' => $find,
            ]);
        } catch (Throwable $th) {
            return response()->json([
                'success' => false,
                'error' => $th->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'image' => 'sometimes|mimes:jpg,png,jpeg,webp|max:5120',
            'title' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $playlist = Playlist::findOrFail($id);

            if ($request->hasFile('image')) {
                // If a new image file is provided in the request
                if ($playlist->image !== null) {
                    // Delete the existing image
                    Storage::delete('public/' . $playlist->image);
                }

                // Upload the new image
                $pathImage = $request->file('image');
                $path = $pathImage->store('image', 'public');
                if (!$path) {
                    return redirect()->back()->with('error', 'Failed to upload the image.');
                }
            } else {
                // If no new image is provided, use the existing image path
                $path = $playlist->image;
            }

            $playlist->update([
                'image' => $path,
                'title' => $request->title,
            ]);
            DB::commit();

            return redirect()->route('playlist.index')->with('success', 'Successfully update Playlist!');
        } catch (Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $playlist = Playlist::findOrFail($id);
            $playlist->delete();

            if ($playlist->image != null) {
                Storage::delete('public/' . $playlist->image);
            }
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Successfully!',
            ]);
        } catch (Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
