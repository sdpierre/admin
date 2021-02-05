<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = "media_library";

    protected $fillable = [
        'title', 'caption', 'description', 'filetype', 'filename', 'thumb', 'folder_date', 'uploaded_by', 'author', 'is_featured', 'created_at', 'updated_at',
    ];

    public function keyword(){
	    return $this->hasMany('App\MediaKeywords', 'media_id', 'id');
    }
    
    public function mediaArticles(){
	    return $this->hasMany('App\MediaArticle', 'media_id', 'id');
	}
}
