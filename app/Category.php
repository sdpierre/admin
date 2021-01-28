<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "article_category";

    protected $fillable = [
        'id', 'rubriquename', 'isuploaded', 'onsite', 'onapp', 'slug',
    ];

    public function category_online(){
        return Category::select('id','name','is_active','slug')
			->where('is_active','TRUE')
			->get();
    }
    
    public function articles(){
	    return $this->hasMany('App\Article', 'id', 'category_id');
	}
}
