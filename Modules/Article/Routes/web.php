<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('article')->group(function() {
    // Route::get('create', 'ArticleController@create')->name('article-create');
    Route::get('/', 'ArticleController@index')->name('article');
    Route::get('/addnew/post/', 'ArticleController@create');
    Route::post('/addnew/post/', 'ArticleController@store');
    Route::get('edit/post/{article}', 'ArticleController@edit');
    Route::post('edit/post/{article}', 'ArticleController@update');
    // Add photo
    Route::get('add-photo/{id}', 'ArticleController@addPhoto')->name('add-photo/{id}');

    // Remove media photo
    Route::post('media-article/destroy', 'ArticleController@deleteMediaArticle')->name('media-article/destroy');

    // Get all media
    Route::get('get-media-photo', 'ArticleController@getMediaPhoto')->name('get-media-photo');

    // Add media photo
    Route::post('media-article/store', 'ArticleController@addMediaArticle')->name('media-article/store');
    
    // Update media article photo
    Route::post('media-article/update', 'ArticleController@updateMediaArticlePhoto')->name('media-article/update');

    // Add and Remove featured image
    Route::post('add-to-featured-photo', 'ArticleController@addRemoveFeaturedImage')->name('add-to-featured-photo');
    
});
