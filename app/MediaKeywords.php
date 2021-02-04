<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MediaKeywords extends Model
{
    protected $table = "media_keywords";

    public $timestamps = false;

    protected $fillable = [
        'media_id', 'keyword',
    ];
}
