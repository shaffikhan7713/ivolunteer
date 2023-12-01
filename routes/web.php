<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DiscordController;
use App\Http\Controllers\VolunteersController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\FilterItemsController;
use App\Http\Controllers\HomeSlidersController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\PeoplesReviewController;
use App\Http\Controllers\FoundersController;
use App\Http\Controllers\ContactUsController;

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
 Route::get('/admin/filter-items', [FilterItemsController::class, 'list']);
 Route::get('/admin/filter-item/{id}', [FilterItemsController::class, 'edit']);
 Route::post('/admin/filter-item/update', [FilterItemsController::class, 'updateFilterItem']);
 Route::get('/admin/home-sliders', [HomeSlidersController::class, 'list']);
 Route::get('/admin/home-sliders/add', [HomeSlidersController::class, 'add']);
 Route::get('/admin/home-sliders/{id}', [HomeSlidersController::class, 'edit']);
 Route::post('/admin/home-sliders/add-update', [HomeSlidersController::class, 'addUpdateHomeSlider']);
 Route::get('/admin/subscriptions', [SubscriptionController::class, 'list']);

 Route::get('/admin/mission', [HomeSlidersController::class, 'mlist']);
 Route::get('/admin/mission/add', [HomeSlidersController::class, 'madd']);
 Route::get('/admin/mission/{id}', [HomeSlidersController::class, 'medit']);
 Route::post('/admin/mission/add-update', [HomeSlidersController::class, 'maddUpdateHomeSlider']);

 Route::get('/admin/founder', [FoundersController::class, 'list']);
 Route::get('/admin/founder/add', [FoundersController::class, 'add']);
 Route::get('/admin/founder/{id}', [FoundersController::class, 'edit']);
 Route::post('/admin/founder/add-update', [FoundersController::class, 'addUpdateFounder']);

 Route::get('/admin/contact-us', [ContactUsController::class, 'list']);

 Route::get('/admin/peoples-review', [PeoplesReviewController::class, 'list']);
 Route::get('/admin/peoples-review/add', [PeoplesReviewController::class, 'add']);
 Route::get('/admin/peoples-review/{id}', [PeoplesReviewController::class, 'edit']);
 Route::post('/admin/peoples-review/add-update', [PeoplesReviewController::class, 'addUpdate']);

Route::get('/fb/login', [SocialController::class, 'redirectToProvider']);
Route::get('/fb/callback', [SocialController::class, 'handleProviderCallback']);
Route::get('/fb/getPages', [SocialController::class, 'getPages']);

Route::post('/pagination/fetch_data', [HomeController::class, 'fetchData']);
Route::post('/home/subscribe', [HomeController::class, 'subscribeUser']);

Route::get('/home/sendEmail', [HomeController::class, 'sendEmailToSubscribers']);
Route::get('/home/updateViews', [HomeController::class, 'updateViews']);

Route::post('/add-contact', [HomeController::class, 'addContact']);