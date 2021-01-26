<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "article_category";

    protected $fillable = [
        'id', 'rubriquename', 'isuploaded', 'onsite', 'onapp', 'slug',
    ];

    public function articles(){
	    return $this->hasMany('App\Article', 'id', 'category_id');
	}
}
