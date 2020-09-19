<?php

Route::get('/giris-yap', 'Backend\AuthController@getLogin')->name('get.login');
Route::post('/giris-yap', 'Backend\AuthController@postLogin')->name('post.login');
Route::get('/cikis-yap', 'Backend\AuthController@logout')->name('get.logout');

Route::group(['middleware' => ['auth', 'share.backend']], function() {
    Route::get('/', 'Backend\AdminController@getIndex')->name('get.index.admin');
    Route::get('/site-ayarlari', 'Backend\AdminController@getSettings')->name('get.settings');
    Route::post('/site-ayarlari', 'Backend\AdminController@postSettings')->name('post.settings');

	Route::group(['prefix' => 'blog'], function () {
    Route::get('/', 'Backend\BlogController@index')->name('blog.index');
    Route::get('/create', 'Backend\BlogController@create')->name('blog.create');
    Route::post('/create', 'Backend\BlogController@store')->name('blog.store');
    Route::get('/{id}/edit', 'Backend\BlogController@edit')->name('blog.edit');
    Route::post('/{id}/edit', 'Backend\BlogController@update')->name('blog.update');
    Route::get('/{id}/destroy', 'Backend\BlogController@destroy')->name('blog.destroy');
  });
	Route::group(['prefix' => 'blog-category'], function () {
    Route::get('/', 'Backend\BlogCategoryController@index')->name('blog-category.index');
    Route::get('/create', 'Backend\BlogCategoryController@create')->name('blog-category.create');
    Route::post('/create', 'Backend\BlogCategoryController@store')->name('blog-category.store');
    Route::get('/{id}/edit', 'Backend\BlogCategoryController@edit')->name('blog-category.edit');
    Route::post('/{id}/edit', 'Backend\BlogCategoryController@update')->name('blog-category.update');
    Route::get('/{id}/destroy', 'Backend\BlogCategoryController@destroy')->name('blog-category.destroy');
  });
	Route::group(['prefix' => 'product'], function () {
    Route::get('/', 'Backend\ProductController@index')->name('product.index');
    Route::get('/create', 'Backend\ProductController@create')->name('product.create');
    Route::post('/create', 'Backend\ProductController@store')->name('product.store');
    Route::get('/{id}/edit', 'Backend\ProductController@edit')->name('product.edit');
    Route::post('/{id}/edit', 'Backend\ProductController@update')->name('product.update');
    Route::get('/{id}/destroy', 'Backend\ProductController@destroy')->name('product.destroy');
  });
	Route::group(['prefix' => 'product-category'], function () {
    Route::get('/', 'Backend\ProductCategoryController@index')->name('product-category.index');
    Route::get('/create', 'Backend\ProductCategoryController@create')->name('product-category.create');
    Route::post('/create', 'Backend\ProductCategoryController@store')->name('product-category.store');
    Route::get('/{id}/edit', 'Backend\ProductCategoryController@edit')->name('product-category.edit');
    Route::post('/{id}/edit', 'Backend\ProductCategoryController@update')->name('product-category.update');
    Route::get('/{id}/destroy', 'Backend\ProductCategoryController@destroy')->name('product-category.destroy');
  });
	Route::group(['prefix' => 'page'], function () {
    Route::get('/', 'Backend\PageController@index')->name('page.index');
    Route::get('/create', 'Backend\PageController@create')->name('page.create');
    Route::post('/create', 'Backend\PageController@store')->name('page.store');
    Route::get('/{id}/edit', 'Backend\PageController@edit')->name('page.edit');
    Route::post('/{id}/edit', 'Backend\PageController@update')->name('page.update');
    Route::get('/{id}/destroy', 'Backend\PageController@destroy')->name('page.destroy');
  });
  Route::group(['prefix' => 'reference'], function () {
    Route::get('/', 'Backend\ReferenceController@index')->name('reference.index');
    Route::get('/create', 'Backend\ReferenceController@create')->name('reference.create');
    Route::post('/create', 'Backend\ReferenceController@store')->name('reference.store');
    Route::get('/{id}/edit', 'Backend\ReferenceController@edit')->name('reference.edit');
    Route::post('/{id}/edit', 'Backend\ReferenceController@update')->name('reference.update');
    Route::get('/{id}/destroy', 'Backend\ReferenceController@destroy')->name('reference.destroy');
  });
  Route::group(['prefix' => 'service'], function () {
    Route::get('/', 'Backend\ServiceController@index')->name('service.index');
    Route::get('/create', 'Backend\ServiceController@create')->name('service.create');
    Route::post('/create', 'Backend\ServiceController@store')->name('service.store');
    Route::get('/{id}/edit', 'Backend\ServiceController@edit')->name('service.edit');
    Route::post('/{id}/edit', 'Backend\ServiceController@update')->name('service.update');
    Route::get('/{id}/destroy', 'Backend\ServiceController@destroy')->name('service.destroy');
  });
  Route::group(['prefix' => 'slider-image'], function () {
    Route::get('/', 'Backend\SliderImageController@index')->name('slider-image.index');
    Route::get('/create', 'Backend\SliderImageController@create')->name('slider-image.create');
    Route::post('/create', 'Backend\SliderImageController@store')->name('slider-image.store');
    Route::get('/{id}/edit', 'Backend\SliderImageController@edit')->name('slider-image.edit');
    Route::post('/{id}/edit', 'Backend\SliderImageController@update')->name('slider-image.update');
    Route::get('/{id}/destroy', 'Backend\SliderImageController@destroy')->name('slider-image.destroy');
  });
	Route::group(['prefix' => 'user'], function () {
    Route::get('/', 'Backend\UserController@index')->name('user.index');
    Route::get('/create', 'Backend\UserController@create')->name('user.create');
    Route::post('/create', 'Backend\UserController@store')->name('user.store');
    Route::get('/{id}/edit', 'Backend\UserController@edit')->name('user.edit');
    Route::post('/{id}/edit', 'Backend\UserController@update')->name('user.update');
    Route::get('/{id}/destroy', 'Backend\UserController@destroy')->name('user.destroy');
  });

});