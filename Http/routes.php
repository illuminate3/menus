<?php

/*
|--------------------------------------------------------------------------
| Menus
|--------------------------------------------------------------------------
*/


// Resources
// Controllers
// API DATA


/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin'], function() {

// Resources

	Route::resource('menus', 'MenusController');
	Route::resource('menulinks', 'MenuLinksController');


// Controllers
// API DATA

});
// --------------------------------------------------------------------------

Route::group(['prefix' => 'menu'], function() {
	Route::get('/', function() {
		dd('This is the Menus module index page.');
	});
});
