<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DiscordController;
use App\Http\Controllers\VolunteersController;
use App\Http\Controllers\SocialController;

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

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
 
    return "Cache cleared successfully";
 });

/* Route::get('/', function () {
    return view('welcome');
}); */

 Route::get('/', [HomeController::class, 'index']);
 Route::get('/upload-excel', [HomeController::class, 'uploadExcel']);
 Route::post('/import-excel', [HomeController::class, 'importExcel']);
 Route::get('/product/{title}/{id}', [HomeController::class, 'details']);
 Route::post('/share-post-on-discord', [DiscordController::class, 'sharePost']);
 Route::get('/sandbox/igtest', [HomeController::class, 'fbRedirect']);
 Route::post('/post-rating', [HomeController::class, 'postRating']);
 Route::get('/about-us', [HomeController::class, 'aboutUs']);
 Route::get('/contact-us', [HomeController::class, 'contactUs']);
 Route::get('/admin/volunteers', [VolunteersController::class, 'list']);
 Route::get('/admin/volunteer/{id}', [VolunteersController::class, 'edit']);
 Route::post('/admin/volunteer/upload-image', [VolunteersController::class, 'uploadVolunteerImage']);

Route::get('/fb/login', [SocialController::class, 'redirectToProvider']);
Route::get('/fb/callback', [SocialController::class, 'handleProviderCallback']);
Route::get('/fb/getPages', [SocialController::class, 'getPages']);