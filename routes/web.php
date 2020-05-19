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
Route::middleware('locale.check')->group(function() {
	Route::get('/', 'HomeController@index')->name('site.index');

	Route::get('/find', 'MapController@find')->name('site.mapFind');

	Route::get('/spot/{id}', 'SpotController@show')->name('site.spot');

	Route::get('/profile/{id}', 'ProfileController@showPage')->name('site.profile');

	Route::post('/locale', 'HomeController@changeLocale')->name('site.changeLocale');

	Route::middleware('auth')->group(function() {
		Route::middleware('user.check')->group(function() {
			Route::get('/spot-edit/{id}', 'SpotController@edit')->name('site.spotEdit');
			Route::post('/spot-edit/{id}/remove', 'SpotController@remove')->name('spot.remove');
			Route::post('/spot-edit/{id}/remove-image', 'SpotController@removeImage')->name('spot.removeImage');
			Route::post('/spot-edit/{id}/add-images', 'SpotController@addImages')->name('spot.addImages');
			Route::post('/spot-edit/{id}/edit-location', 'SpotController@editLocation')->name('spot.editLocation');
			Route::post('/spot-edit/{id}/edit-description', 'SpotController@editDescription')->name('spot.editDescription');
			Route::post('/spot-edit/{id}/remove-move', 'SpotController@removeMove')->name('spot.removeMove');
			Route::post('/spot-edit/{id}/add-move', 'SpotController@addMove')->name('spot.addMove');
			Route::post('/spot-edit/{id}/detach-video', 'SpotController@removeSpotFromVideo')->name('spot.removeSpotFromVideo');
		});

		Route::post('/spot/{id}/add-comment', 'SpotController@addComment')->name('spot.addComment');
		Route::post('/spot/{id}/remove-comment', 'SpotController@removeComment')->name('spot.removeComment');
		
		Route::get('/spot-add', 'SpotController@add')->name('site.spotAdd');
		Route::post('/spot-add', 'SpotController@addPost')->name('site.spotAddPost');

		
		Route::get('/profile', 'ProfileController@showEditPage')->name('site.profileEdit');
		Route::post('/profile', 'ProfileController@editPost')->name('site.profileEditPost');

		Route::post('/profile/user', 'ProfileController@getUser')->name('ajax.getUser');
		Route::post('/profile/user-tricks', 'ProfileController@getUserTricks')->name('ajax.getUserTricks');
		Route::post('/profile/user-videos', 'ProfileController@getUserVideos')->name('ajax.getUserVideos');
		Route::post('/useravatar', 'ProfileController@getAvatar')->name('ajax.getAvatar');
		Route::post('/social/save', 'ProfileController@setSocial')->name('ajax.setSocial');

		//Profile editing
		Route::post('/useravatar/upload', 'ProfileController@addAvatar')->name('profile.uploadImg');
		
		Route::post('/useravatar/delete', 'ProfileController@removeAvatar')->name('profile.removeImg');
		Route::post('/moves/add', 'ProfileController@addMove')->name('profile.addMove');
		Route::post('/moves/remove', 'ProfileController@removeMove')->name('profile.removeMove');
		Route::post('/videos/add-move', 'ProfileController@addMoveVideo')->name('profile.addMoveVideo');
		Route::post('/videos/remove-move', 'ProfileController@removeMoveVideo')->name('profile.removeMoveVideo');
		Route::post('/videos/add-spot', 'ProfileController@addSpotToVideo')->name('profile.addSpotToVideo');
		Route::post('/videos/remove-spot', 'ProfileController@removeSpotFromVideo')->name('profile.removeSpotFromVideo');
	});



	Route::get('/register', 'LoginController@register')->name('site.register');
	Route::post('/register', 'LoginController@registerPost')->name('site.registerPost');
	Route::get('/login', 'LoginController@login')->name('site.login');
	Route::post('/login', 'LoginController@loginPost')->name('site.loginPost');


	// Examples
	// Route::get('/', 'ArticleController@showAll')->name('site.index')->middleware('auth');
	// Route::get('/article/{id}', 'ArticleController@showOne')->name('site.article')->where('id', '[0-9]+');
	Auth::routes();
});

Route::get('/sitemap', 'SiteMapController@index');

