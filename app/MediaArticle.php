<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MediaArticle extends Model
{
    protected $table = "media_article";

    public $timestamps = false;

    protected $fillable = [
        'article_id', 'media_id', 'is_featured',
    ];

    public function media(){
	    return $this->hasMany('App\Media', 'id', 'media_id');
	}
}
