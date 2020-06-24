<?php

use GuzzleHttp\Psr7\Uri;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Dorcas\ModulesOps\Http\Controllers', 'prefix' => 'mop', 'middleware' => ['web','auth']], function() {
    Route::get('/ops-main', 'ModulesOpsController@index')->name('ops-main');


});

?>