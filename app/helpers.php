<?php


function getArticleTitleByMediaId($media_id) 
{
    $data = \DB::table('media_article as m')
    ->select("a.titre")
    ->join('articles as a', 'm.article_id','=','a.id_article')
    ->where('media_id', $media_id)
    ->first();

    return $data->titre;
}
?>