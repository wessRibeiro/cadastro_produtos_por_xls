<?php

Route::group(['prefix' => 'v1'], function() {
    //products
    Route::resource('products', 'Api\V1\ProductController');
    //files not processed
    Route::get('files/history', 'Api\V1\ProductController@getFilesHistory');
});
