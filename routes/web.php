<?php

use Illuminate\Support\Facades\Route;
use App\Helpers\DateHelper;
use Illuminate\Support\Facades\Storage;

//import all controllers
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\CrewController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\GraphicController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\PreviewController;
//login
Route::middleware(['guest'])->group(function (){
    Route::get('/login', [LoginController::class,'create'])->name('login');
    Route::post('/login', [LoginController::class,'store'])->name('login');
});

//logout
Route::post('/logout',[LoginController::class,'destroy']);

//register
Route::get('/register', [RegisterController::class,'create'])->middleware('auth');
Route::post('/register', [RegisterController::class,'store'])->middleware('auth');

//Events
Route::get('/events',[EventController::class,'index'])->middleware('auth');
Route::get('/events/create',[EventController::class,'create'])->middleware('auth');
Route::post('/events/create',[EventController::class,'store'])->middleware('auth');
Route::get('/events/{event}/edit',[EventController::class,'edit'])->middleware('auth');
Route::put('/events/{event}',[EventController::class,'update'])->middleware('auth');
Route::delete('/events/{event}',[EventController::class,'destroy'])->middleware('auth');


//Themes
Route::get('/themes',[ThemeController::class,'index'])->middleware('auth');
Route::get('/themes/create',[ThemeController::class,'create'])->middleware('auth');
Route::post('/themes/create',[ThemeController::class,'store'])->middleware('auth');
Route::get('/themes/{theme}/edit',[ThemeController::class,'edit'])->middleware('auth');
Route::put('/themes/{theme}',[ThemeController::class,'update'])->middleware('auth');
Route::delete('/themes/{theme}',[ThemeController::class,'destroy'])->middleware('auth');


//displays/screens
//all displays are belongs to event
Route::get('/displays/{event}',[DisplayController::class,'index'])->middleware('auth');
Route::get('/displays/create/{event}',[DisplayController::class,'create'])->middleware('auth');
Route::post('/displays/create/{event}',[DisplayController::class,'store'])->middleware('auth');
Route::get('/displays/{display}/edit',[DisplayController::class,'edit'])->middleware('auth');
Route::get('/displays/{display}/duplicate',[DisplayController::class,'duplicate'])->middleware('auth');
Route::put('/displays/{display}',[DisplayController::class,'update'])->middleware('auth');
Route::delete('/displays/{display}',[DisplayController::class,'destroy'])->middleware('auth');


//Timetables
//all timetables are belongs to displays/screens
Route::get('/timetables/{display}',[TimetableController::class,'index'])->middleware('auth');
Route::get('/timetables/create/{display}',[TimetableController::class,'create'])->middleware('auth');
Route::post('/timetables/create/{display}',[TimetableController::class,'store'])->middleware('auth');
Route::get('/timetables/{timetable}/edit',[TimetableController::class,'edit'])->middleware('auth');
Route::get('/timetables/{timetable}/duplicate',[TimetableController::class,'duplicate'])->middleware('auth');
Route::put('/timetables/{timetable}',[TimetableController::class,'update'])->middleware('auth');
Route::delete('/timetables/{timetable}',[TimetableController::class,'destroy'])->middleware('auth');


//Timetables/schedules
Route::get('/timetables/{display}',[TimetableController::class,'index'])->middleware('auth');

//List of venues
Route::get('/venues',[VenueController::class,'index'])->middleware('auth');
Route::get('/venues/create',[VenueController::class,'create'])->middleware('auth');
Route::post('/venues/create',[VenueController::class,'store'])->middleware('auth');
Route::get('/venues/{venue}/edit',[VenueController::class,'edit'])->middleware('auth');
Route::put('/venues/{venue}',[VenueController::class,'update'])->middleware('auth');
Route::delete('/venues/{venue}',[VenueController::class,'destroy'])->middleware('auth');

//List of crews
Route::get('/crews',[CrewController::class,'index'])->middleware('auth');
Route::get('/crews/create',[CrewController::class,'create'])->middleware('auth');
Route::post('/crews/create',[CrewController::class,'store'])->middleware('auth');
Route::get('/crews/{crew}/edit',[CrewController::class,'edit'])->middleware('auth');
Route::put('/crews/{crew}',[CrewController::class,'update'])->middleware('auth');
Route::delete('/crews/{crew}',[CrewController::class,'destroy'])->middleware('auth');

//number of rooms/locations
Route::get('/locations',[LocationController::class,'index'])->middleware('auth');
Route::get('/locations/create',[LocationController::class,'create'])->middleware('auth');
Route::post('/locations/create',[LocationController::class,'store'])->middleware('auth');
Route::get('/locations/{location}/edit',[LocationController::class,'edit'])->middleware('auth');
Route::put('/locations/{location}',[LocationController::class,'update'])->middleware('auth');
Route::delete('/locations/{location}',[LocationController::class,'destroy'])->middleware('auth');

//roles
Route::get('/roles',[RoleController::class,'index'])->middleware('auth');
Route::get('/roles/create',[RoleController::class,'create'])->middleware('auth');
Route::post('/roles/create',[RoleController::class,'store'])->middleware('auth');
Route::get('/roles/{role}/edit',[RoleController::class,'edit'])->middleware('auth');
Route::put('/roles/{role}',[RoleController::class,'update'])->middleware('auth');
Route::delete('/roles/{role}',[RoleController::class,'destroy'])->middleware('auth');

//contents
Route::get('/contents/{timetable}',[ContentController::class,'index'])->middleware('auth');
Route::get('/contents/create/{timetable}/{type}',[ContentController::class,'create'])->middleware('auth');
//Route::post('/contents/create/{timetable}/{type}',[ContentController::class,'store'])->middleware('auth');
Route::get('/contents/{content}/edit',[ContentController::class,'edit'])->middleware('auth');
Route::get('/contents/{content}/duplicate',[ContentController::class,'duplicate'])->middleware('auth');
//Route::put('/contents/{content}',[ContentController::class,'update'])->middleware('auth');
Route::delete('/contents/{content}',[ContentController::class,'destroy'])->middleware('auth');

//topic
Route::post('/topics/create/{timetable}/{type}',[TopicController::class,'store'])->middleware('auth');
Route::put('/topics/{content}',[TopicController::class,'update'])->middleware('auth');

//message
Route::post('/messages/create/{timetable}/{type}',[MessageController::class,'store'])->middleware('auth');
Route::put('/messages/{content}',[MessageController::class,'update'])->middleware('auth');

//graphic
Route::post('/graphics/create/{timetable}/{type}',[GraphicController::class,'store'])->middleware('auth');
Route::put('/graphics/{content}',[GraphicController::class,'update'])->middleware('auth');

//users
Route::get('/users',[UserController::class,'index'])->middleware('auth');

//
Route::get('/{display}',[PublicController::class,'show']);
Route::get('/preview/{timetable}',[PreviewController::class,'show'])->middleware('auth');