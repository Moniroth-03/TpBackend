<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TasksController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\AuthController;


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



/**
 * 
 * @OA\Get(
 *     path="/api/categories",
 *     @OA\Response(response="200", description="Categories")
 * )
 */


// Define routes for reading data (GET requests)
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/users', [UserController::class, 'index']);
Route::get('/products', [ProductController::class, 'index']);

// Define routes for registration, login, and OTP verification
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/verify-otp', [AuthController::class, 'verifyOTP']);

// Define routes for authorized users
Route::middleware(['auth:api', 'admin'])->group(function () {
    // Define routes for mutating data (POST, PUT, DELETE requests)
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::put('/categories/{category}', [CategoryController::class, 'update']);
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);

    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);

    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{product}', [ProductController::class, 'update']);
    Route::delete('/products/{product}', [ProductController::class, 'destroy']);
});


// Route::apiResource('categories',CategoryController::class)->except([
//     'create', 'show', 'edit',
// ]);

// Route::apiResource('users',UserController::class)->except([
//     'create', 'show', 'edit'
// ]);

// Route::apiResource('products',ProductController::class)->except([
//     'create', 'show', 'edit',
// ]);


// Route::middleware('auth:api')->group(function(){
//     Route::apiResource('products',ProductController::class)->except([
//         'create', 'show', 'edit',
//     ]);
// });

// Route::middleware(['auth:api', 'admin'])->group(function(){
//     Route::apiResource('products',ProductController::class)->except([
//         'create', 'show', 'edit', 
//     ]);
//     Route::apiResource('categories',CategoryController::class)->except([
//         'create', 'show', 'edit', 
//     ]);
//     Route::apiResource('users',UserController::class)->except([
//         'create', 'show', 'edit', 
//     ]);
// });


// Route::apiResource('categories',CategoryController::class)->except([
//      'show', 
// ]);

// Route::apiResource('users',UserController::class)->except([
//     'show', 
// ]);

// Route::apiResource('products',ProductController::class)->except([
//     'show', 
// ]);






Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/verify-otp', [AuthController::class, 'verifyOTP']);

