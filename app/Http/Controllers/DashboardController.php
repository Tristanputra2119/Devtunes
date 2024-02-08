<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Auth::user();
        $playlist = Playlist::where('user_id', $users->id)->get();

        return view('admin.dashboard.index', compact('users', 'playlist'));
    }
}
