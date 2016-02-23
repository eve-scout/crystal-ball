<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('home');
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    // Route::any('register','HomeController@index');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['prefix' => 'admin', 'middleware' => ['web']], function () {
	Route::any('releases/data', ['as' => 'admin.releases.data', 'uses' => 'ReleaseController@anyData']);
	Route::get('releases/{id}/destroy',['uses'=>'ReleaseController@destroy']);
	Route::resource('releases', 'ReleaseController');

	Route::any('builds/data', ['as' => 'admin.builds.data', 'uses' => 'BuildController@anyData']);
	Route::get('builds/{id}/destroy',['uses'=>'BuildController@destroy']);
	Route::resource('builds', 'BuildController');

	Route::any('items/data', ['as' => 'admin.items.data', 'uses' => 'ItemController@anyData']);
	Route::any('items/md-preview', ['uses' => 'ItemController@mdPreview']);
	Route::get('items/{id}/destroy',['uses'=>'ItemController@destroy']);
	Route::resource('items', 'ItemController');

	Route::resource('items/{item}/attachments', 'ItemAttachmentController');

	// Route::get('items', ['as' => 'admin.items', 'uses' => 'ItemController@getItems']);
	// Route::post('items', ['as' => 'admin.items.create', 'uses' => 'ItemController@postItem']);
	// Route::get('items/{item}/edit', ['as' => 'admin.items.edit', 'uses' => 'ItemController@getItemEdit']);

	// Route::get('items/create', ['uses' => 'ItemController@getItemCreate']);

	// Route::get('admin/items/create', function () {
 //    	return view('admin.items.create');
	// });

	// Route::get('admin/items/new', function () {
 //    	return view('admin.itemsform');
	// });

	// Route::get('admin/builds/new', function () {
 //    	return view('admin.builds');
	// });

	// Route::get('admin/releases/new', function () {
 //    	return view('admin.releases');
	// });
});