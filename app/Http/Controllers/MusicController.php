<?php

namespace App\Http\Controllers;

use App\Models\Music;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Throwable;

class MusicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        // Example: Retrieve all music with associated playlist
        $musik = Music::query();
        $search = $request->query('search');
        // If search parameter is present, filter the news by title
        if ($search) {
            $musics = $musik->where('title', 'LIKE', '%' . $search . '%')->with('Playlists')->get();
        } else {
            // If no search parameter, retrieve all news
            $musics = $musik->with('Playlists')->get();
        }
        $musics = $musik->with('Playlists')->get();
        $playlist = Playlist::all();

        return view('admin.music.index', compact('musics', 'playlist', 'search'));
    }

    //display playlist list_music button
    public function listMusic(Request $request, $id)
    {
        $playlist = Playlist::findOrFail($id);
        $musics = Music::where('playlist_id', $id)->get();

        return view('admin.music.playlist_music', compact('musics', 'playlist'));
    }

    public function getmusic(string $id)
    {
        try {
            $find = Music::find($id);
            $find->previewImage = asset('storage/' . $find->image);
            $find->previewAudio = asset('storage/' . $find->file);

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
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            // Validate the request data
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'composer' => 'required|string|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
                'file' => 'required|mimes:mp3|max:20480',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first());
            }
            // Upload image
            $imagePath = $request->file('image')->store('images', 'public');
            // Upload music file
            $musicPath = $request->file('file')->store('music', 'public');

            // Create a new music record in the database
            $music = new Music();
            $music->title = $request->input('title');
            $music->composer = $request->input('composer');
            $music->image = $imagePath;
            $music->file = $musicPath;
            $music->playlist_id = $request->input('playlist_id');
            $music->save();

            return redirect()->back()->with('success', 'Music added successfully.');
        } catch (Throwable $th) {
            DB::rollBack();
            Storage::disk('public')->delete([$imagePath, $musicPath]);
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Music $music)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Music $music)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Validate the request data
            $request->validate([
                'title' => 'required|string|max:255',
                'composer' => 'required|string|max:255',
                'image' => 'image|mimes:jpg,png,jpeg,webp,gif|max:5120',
                'file' => 'mimes:mp3|max:20480',
            ]);

            // Find the music record to update
            $music = Music::findOrFail($id);

            // Check if a new image has been provided
            if ($request->hasFile('image')) {
                // Delete the old image
                Storage::disk('public')->delete($music->image);

                // Upload the new image
                $imagePath = $request->file('image')->store('images', 'public');
                $music->image = $imagePath;
            }

            // Check if a new file has been provided
            if ($request->hasFile('file')) {
                // Delete the old file
                Storage::disk('public')->delete($music->file);

                // Upload the new file
                $musicPath = $request->file('file')->store('music', 'public');
                $music->file = $musicPath;
            }

            // Update the music record
            $music->title = $request->input('title');
            $music->composer = $request->input('composer');
            $music->playlist_id = $request->input('playlist_id');
            $music->save();

            return redirect()->back()->with('success', 'Music updated successfully.');
        } catch (Throwable $th) {
            // Handle the error, roll back any changes, and delete any newly uploaded files
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
            $music = Music::findOrFail($id);
            $music->delete();

            if ($music->image != null) {
                Storage::delete('public/' . $music->image);
            }
            if ($music->file != null) {
                Storage::delete('public/' . $music->file);
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
