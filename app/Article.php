<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = "article";

    protected $fillable = [];

    public function category(){
	    return $this->hasMany('App\Category', 'rubriqueid', 'rubriqueid');
	}
}
