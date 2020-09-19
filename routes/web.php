<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['share.frontend']], function() {
	Route::get('/frontend', 'Frontend\SiteController@getIndex')->name('site.index');
	Route::get('/hakkimizda', 'Frontend\SiteController@getAbout')->name('site.about');
	Route::get('/iletisim', 'Frontend\SiteController@getContact')->name('site.contact');
	Route::get('/hizmetler', 'Frontend\SiteController@getServices')->name('site.services');
	Route::get('/urunler', 'Frontend\SiteController@getProducts')->name('site.products');
	Route::post('/contact', 'Frontend\SiteController@postContact')->name('site.post.contact');
	Route::get('/blog', 'Frontend\BlogController@getBlog')->name('site.blog.all');
	Route::get('/blog/{blog_category_slug}', 'Frontend\BlogController@getBlog')->name('site.blogcategory.all');
	Route::get('/blog/d/{blog_slug}', 'Frontend\BlogController@getBlogDetail')->name('site.blog.detail');
	Route::get('/sayfa/{slug}', 'Frontend\SiteController@getPage')->name('site.page');
	Route::get('/hizmet/{slug}', 'Frontend\SiteController@getServiceDetail')->name('site.service.detail');
	Route::get('/urun/{slug}', 'Frontend\SiteController@getProductDetail')->name('site.product.detail');
	Route::get('/referans/{slug}', 'Frontend\SiteController@getReferenceDetail')->name('site.reference.detail');
});