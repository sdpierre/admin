<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = "articles";

    protected $fillable = [
        'une', 'rubriqueid', 'chronique', 'surtitre', 'titre', 'soustitre', 'chapeau', 'article', 'motscles', 'extra1', 'extra2', 'photos', 'photofiles', 'photo1', 'legende1', 'photographe1', 'photo2', 'legende2', 'photographe2', 'photo3', 'legende3', 'photographe3', 'photo4', 'legende4', 'photographe4', 'photo5', 'legende5', 'photographe5', 'photofolder', 'photographer', 'auteur', 'auteurid', 'entrerpar', 'created_at', 'datepublication', 'priorite', 'ispublished', 'enligne', 'whodelete', 'last_update', 'update_at', 'online_at', 'prio_post', 'status', 'post', 'click', 'frontpub', 'premium',
    ];

    public function category(){
	    return $this->hasMany('App\Category', 'rubriqueid', 'rubriqueid');
	}
}
