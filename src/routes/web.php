<?php

use GuzzleHttp\Psr7\Uri;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Dorcas\ModulesOps\Http\Controllers', 'prefix' => 'mop', 'middleware' => ['web','auth']], function() {
    Route::get('/ops-main', 'ModulesOpsController@index')->name('ops-main');

    Route::get('/ops-zoom', 'ModulesOpsController@zoom_index')->name('ops-zoom');
    Route::post('/ops-zoom', 'ModulesOpsController@zoom_post');
    Route::get('/ops-zoom-create', 'ModulesOpsController@zoom_create')->name('ops-zoom-create');
    
    //meetings

    Route::group(['middleware' => ['user_check'],'prefix' => 'webinar'],function(){
        Route::post('{id}/register','WebinarController@register');
        Route::group(['middleware' => 'tenant_middleware:tenant_can_mgt_webinars'],function(){
            Route::get('','WebinarController@index');
            Route::post('','WebinarController@create');
            Route::put('{id}','WebinarController@update');
            Route::get('{id}','WebinarController@single');
            Route::delete('{id}','WebinarController@delete');
        });
    });

});

?>