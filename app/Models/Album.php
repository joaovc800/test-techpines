<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Track;

class Album extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tracks()
    {
        return $this->hasMany(Track::class);
    }
}
