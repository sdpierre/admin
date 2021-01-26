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

Route::prefix('media')->group(function() {
    Route::get('/', 'MediaController@index');
    Route::get('create', 'MediaController@create')->name('media-create');
    Route::post('store', 'MediaController@store')->name('store');
    Route::post('update', 'MediaController@update')->name('update');
    Route::post('destroy', 'MediaController@destroy')->name('destroy');

    // create crop image
    Route::get('cropimage', 'MediaController@cropimage')->name('cropimage');

    // Bulk action
    Route::post('bulk_delete', 'MediaController@bulkDelete')->name('bulk_delete');

    // Get all articles
    Route::get('get_all_articles', 'MediaController@getAllArticles')->name('get_all_articles');

    // Add image to article
    Route::post('add_featured_image', 'MediaController@addFeaturedImage')->name('add_featured_image');

    // Remove image from article
    Route::get('detach/{id}', 'MediaController@detach')->name('detach/{id}');
});
