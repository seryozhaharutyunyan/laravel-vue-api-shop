<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/showTop', 'App\Http\Controllers\IndexController@showTop');
Route::group(['namespace' => 'App\Http\Controllers\Admin', 'middleware' => ['jwt.auth'], 'prefix' => 'admin'],
    function () {
        Route::group(['prefix' => 'categories'], function () {
            Route::get('/', 'CategoryController@index');
            Route::post('/', 'CategoryController@store');
            Route::post('/{category}', 'CategoryController@update');
            Route::delete('/{category}', 'CategoryController@destroy');
        });

        Route::group(['prefix' => 'tags'], function () {
            Route::get('/', 'TagController@index');
            Route::post('/', 'TagController@store');
            Route::post('/{tag}', 'TagController@update');
            Route::delete('/{tag}', 'TagController@destroy');
        });

        Route::group(['prefix' => 'edges'], function () {
            Route::get('/', 'EdgeController@index');
            Route::post('/', 'EdgeController@store');
            Route::post('/{edge}', 'EdgeController@update');
            Route::delete('/{edge}', 'EdgeController@destroy');
        });

        Route::group(['prefix' => 'regions'], function () {
            Route::get('/', 'RegionController@index');
            Route::post('/', 'RegionController@store');
            Route::post('/{region}', 'RegionController@update');
            Route::delete('/{region}', 'RegionController@destroy');
        });

        Route::group(['prefix' => 'cities'], function () {
            Route::get('/', 'CityController@index');
            Route::post('/', 'CityController@store');
            Route::post('/{city}', 'CityController@update');
            Route::delete('/{city}', 'CityController@destroy');

            Route::get('/search_regions/{edge}', 'CityController@searchRegions');
        });

        Route::group(['prefix' => 'users'], function () {
            Route::get('/', 'UserController@index');
            Route::post('/', 'UserController@store');
            Route::get('/show/{user}', 'UserController@show');
            Route::delete('/{user}', 'UserController@destroy');
            Route::get('/block/{user}', 'UserController@block');

            Route::get('/edge_regions/{edge}', 'UserController@edgeRegions');
            Route::get('/edge_cities/{edge}', 'UserController@edgeCities');
            Route::get('/region_cities/{region}', 'UserController@regionCities');
        });

        Route::group(['prefix' => 'products'], function () {
            Route::get('/', 'ProductController@index');
            Route::post('/', 'ProductController@store');
            Route::delete('/{product}', 'ProductController@destroy');

            Route::get('/show/{product}', 'ProductController@show');
            Route::post('/show/update/{product}', 'ProductController@update');
            Route::post('/updateQuantity/{product}', 'ProductController@updateQuantity');
        });

        Route::group(['prefix' => 'comments'], function () {
            Route::delete('/{comment}', 'CommentController@destroy');
            Route::get('/{product}', 'CommentController@index');
        });

        Route::group(['prefix' => 'orders'], function () {
            Route::get('/', 'OrderController@index');
            Route::post('/{orderDetail}', 'OrderController@sent');
            Route::delete('/{orderDetail}', 'OrderController@destroy');

        });
    });

Route::group(['namespace' => 'App\Http\Controllers\Basic'], function () {
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', 'CategoryController@index');
        Route::get('/{category}', 'CategoryController@showProducts');
    });
    Route::group(['prefix' => 'feedback'], function () {
        Route::post('/', 'FeedbackController@sendMail');
    });

    Route::group(['prefix' => 'products'], function () {
        Route::get('/{product}', 'ProductController@show');
        Route::get('/quantity/{product}', 'ProductController@getQuantity');
        Route::get('/reviews_count/{product}', 'ProductController@updateReviewsCount');
    });

    Route::group(['prefix' => 'orders'], function () {
        Route::post('/u_auth', 'OrderController@addUAuth');

        Route::group(['middleware' => 'jwt.auth'], function () {
            Route::post('/auth', 'OrderController@addAuth');
            Route::get('/count', 'OrderController@getCount');
            Route::get('/products', 'OrderController@getProducts');
            Route::delete('/{orderDetail}', 'OrderController@destroy');
            Route::post('/update', 'OrderController@updateAuth');
            Route::get('/set_order/{orderDetail}', 'OrderController@setOrderAuth');
        });


        Route::get('/edges', 'OrderController@edges');
        Route::get('/edge_regions/{edge}', 'OrderController@edgeRegions');
        Route::get('/edge_cities/{edge}', 'OrderController@edgeCities');
        Route::get('/region_cities/{region}', 'OrderController@regionCities');
    });

    Route::group(['prefix' => 'comments'], function () {
        Route::post('/', 'CommentController@store');
        Route::get('/{product}', 'CommentController@index');
    });

    Route::group(['prefix' => 'likes',], function () {
        Route::group(['middleware' => ['jwt.auth']], function () {
            Route::post('/{product}', 'LikeController@store');
        });

        Route::get('/show/{product}', 'LikeController@show');
    });

    Route::group(['prefix'=>'search'], function (){
        Route::post('/', 'SearchController@search');
    });
});

Route::group(['namespace' => 'App\Http\Controllers\Auth', 'middleware' => 'api', 'prefix' => 'registration'],
    function () {
        Route::post('/', 'RegistrationController@registration');
        Route::post('/reset_password', 'RegistrationController@resetPassword');

        Route::group(['middleware' => 'jwt.auth'], function () {
            Route::post('/password', 'RegistrationController@updatePassword');
            Route::post('/account', 'RegistrationController@updateAccount');
        });

        Route::get('/edges', 'RegistrationController@edges');
        Route::get('/edge_regions/{edge}', 'RegistrationController@edgeRegions');
        Route::get('/edge_cities/{edge}', 'RegistrationController@edgeCities');
        Route::get('/region_cities/{region}', 'RegistrationController@regionCities');
    });

Route::group(['namespace' => 'App\Http\Controllers\Auth', 'middleware' => 'api', 'prefix' => 'auth'],
    function ($router) {
        Route::post('/login', 'AuthController@login');
        Route::post('/logout', 'AuthController@logout');
        Route::post('/refresh', 'AuthController@refresh');
        Route::group(['middleware' => 'jwt.auth'], function () {
            Route::post('/me', 'AuthController@me');
        });
    });

