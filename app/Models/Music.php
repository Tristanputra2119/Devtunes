<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use Uuids;
    use HasFactory;

    protected $table = "music";

    protected $guarded = ['id'];

    protected $fillable = [
        'playlist_id',
        'title',
        'image',
        'composer',
        'file',
        'views',
    ];

    public function playlists()
    {
        return $this->belongsTo(Playlist::class);
    }
}
