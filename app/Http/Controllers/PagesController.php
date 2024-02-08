<?php

namespace App\Http\Controllers;

use App\Models\Music;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function index()
    {
        $playlist = Playlist::withSum('music', 'views')->orderByDesc('music_sum_views')->limit(4)->where('status', 'online')->get();
        $music = Music::orderBy('views', 'desc')->limit(3)->get();
        return view('pages.home', ['playlist' => $playlist, 'music' => $music]);
    }

    public function playlist(Request $request)
    {

        $playlist = Playlist::query();
        $search = $request->query('search');

        // If search parameter is present, filter the playlists by title
        if ($search) {
            $news = $playlist->where('title', 'LIKE', '%' . $search . '%')->get();
        } else {
            // If no search parameter, retrieve all playlists
            $news = $playlist->get();
        }
        $news = $playlist->withSum('music', 'views')->orderByDesc('music_sum_views')->limit(5)->where('status', 'online')->get();
        $all = Playlist::where('status', 'online')->orderBy('created_at', 'desc')->get();
        return view('pages.playlist', ['news' => $news, 'search' => $search, 'all' => $all]);
    }
    public function detail($id, Request $request)
    {
        $musik = Music::query();
        $search = $request->query('search');
        // If search parameter is present, filter the news by title
        if ($search) {
            $music = $musik->where('title', 'LIKE', '%' . $search . '%')->where('playlist_id', $id)->get();
        } else {
            // If no search parameter, retrieve all news
            $music = $musik->where('playlist_id', $id)->get();
        }
        $music = $musik->where('playlist_id', $id)->get();
        $playlist = Playlist::where('id', $id)->first();

        $queue = $musik->where('playlist_id', $id)->get();

        return view('pages.playlist_detail', ['music' => $music, 'playlist' => $playlist, 'queue' => $queue, 'search' => $search]);
    }

    public function updateViews(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $music = Music::findOrFail($id);

            if ($music) {
                $music->views += 1;
                $music->save();
                DB::commit();
                return response()->json(['success' => true, 'message' => 'Views count updated successfully']);
            }
            return response()->json(['error' => 'Music not found'], 404);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($track)
    {
        //
    }

    public function admin()
    {
        return view('admin.dashboard.index');
    }
}
