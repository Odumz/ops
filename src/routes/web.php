<?php

use GuzzleHttp\Psr7\Uri;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Dorcas\ModulesSample\Http\Controllers', 'prefix' => 'msp', 'middleware' => ['web','auth']], function() {
    Route::get('/sample-main', 'ModulesSampleController@index')->name('sample-main');


});

?>