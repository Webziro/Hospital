<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index']);

Route::get('/home', [HomeController::class, 'redirect']);



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



// Add Doctor
Route::get('/add_doctor_view', [AdminController::class, 'addview']);

// Upload Doctor
Route::post('/upload_doctor', [AdminController::class, 'upload']);

//Contact a Doctor
Route::post('/appointment', [HomeController::class, 'appointment']);

//See my appointments
Route::get('/myappointment', [HomeController::class, 'myappointment']); 

//Delete Appointments
Route::get('/deleteappoint/{id}', [HomeController::class, 'deleteappoint']);

//Admin View Appointments 
Route::get('/admin_view_appointment', [AdminController::class, 'admin_view_appointment']);

//Admin Approve Appointments
Route::get('/approved/{id}', [AdminController::class, 'approved']); 

//Admin canceled Appointments
Route::get('/canceled/{id}', [AdminController::class, 'canceled']); 

//Show Doctor
Route::get('/showdoctor', [AdminController::class, 'showdoctor']); 

//Delete Doctor 
Route::get('/deletedoctor/{id}', [AdminController::class, 'deletedoctor']); 

//Edit Doctor
// Route::get('/editdoctor/{id}', [AdminController::class, 'editdoctor']); 

//Update Doctor
Route::get('/updatedoctor', [AdminController::class, 'updatedoctor']); 