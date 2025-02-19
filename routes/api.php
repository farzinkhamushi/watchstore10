<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/v1')->namespace('Api\V1')->group(function (){

    Route::post('send_sms',[\App\Http\Controllers\Api\V1\AuthController::class,'sendSms']);
    Route::post('verify_sms_code',[\App\Http\Controllers\Api\V1\AuthController::class,'verifySms']);

    Route::get('home',[\App\Http\Controllers\Api\V1\HomeApiController::class,'home']);

    Route::get('most_sold_products',[\App\Http\Controllers\Api\V1\ProductsApiController::class,'most_sold_products']);
    Route::get('most_viewed_products',[\App\Http\Controllers\Api\V1\ProductsApiController::class,'most_viewed_products']);
    Route::get('newest_products',[\App\Http\Controllers\Api\V1\ProductsApiController::class,'newest_products']);
    Route::get('cheapest_products',[\App\Http\Controllers\Api\V1\ProductsApiController::class,'cheapest_products']);
    Route::get('most_expensive_products',[\App\Http\Controllers\Api\V1\ProductsApiController::class,'most_expensive_products']);

    Route::get('products_by_category/{id}',[\App\Http\Controllers\Api\V1\ProductsApiController::class,'productsByCategory']);
    Route::get('products_by_brands/{id}',[\App\Http\Controllers\Api\V1\ProductsApiController::class,'productsByBrand']);

    Route::get('product_details/{id}',[\App\Http\Controllers\Api\V1\ProductsApiController::class,'productDetail']);

    Route::post('search_product',[\App\Http\Controllers\Api\V1\ProductsApiController::class,'searchProduct']);

    //for zarringpal sandox we made
    Route::get('callback',[\App\Http\Controllers\Api\V1\PaymentApiController::class,'callback']);
});


Route::prefix('/v1')->namespace('Api\V1')->middleware('auth:sanctum')->group(function (){
    Route::post('register',[\App\Http\Controllers\Api\V1\UserApiController::class,'register']);

    Route::post('save_product_comment',[\App\Http\Controllers\Api\V1\ProductsApiController::class,'saveComment']);

    Route::post('payment',[\App\Http\Controllers\Api\V1\PaymentApiController::class,'payment'])->name('payment');

    Route::post('profile',[\App\Http\Controllers\Api\V1\UserApiController::class,'profile'])->name('profile');

    Route::post('received_orders',[\App\Http\Controllers\Api\V1\UserApiController::class,'receivedOrders'])->name('receivedOrders');
});


///////////////////////////////////////////////GraphQL api
////////////////////////////////////which is single endpoint api


Route::post('/graphql', [\App\Http\Controllers\GraphQLApi\GraphQLController::class, 'graphQLFunc']);
