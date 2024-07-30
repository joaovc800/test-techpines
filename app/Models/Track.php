<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Album;

class Track extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
