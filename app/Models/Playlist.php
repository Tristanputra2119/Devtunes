<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use Uuids;
    use HasFactory;

    protected $table = "playlists";

    protected $guarded = ['id'];

    protected $fillable = [
        'user_id',
        'image',
        'title',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function music()
    {
        return $this->hasMany(Music::class);
    }
}
