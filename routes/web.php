<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();
################# HomeController #################
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

################# TagController ################
//to show deleted data 
//it should be given priority show kept on top
Route::get('backend/tag/trash',[\App\Http\Controllers\Backend\TagController::class,'trash'])->name('backend.tag.trash');
//to restore deleted data
//it should be given priority show kept on top
Route::post('backend/tag/restore/{id}',[\App\Http\Controllers\Backend\TagController::class,'restore'])->name('backend.tag.restore');
//delete permanently
Route::delete('backend/tag/force_delete/{id}',[\App\Http\Controllers\Backend\TagController::class,'permanentDelete'])->name('backend.tag.force_delete');


//to create form data
Route::get('backend/tag/create',[\App\Http\Controllers\Backend\TagController::class,'create'])->name('backend.tag.create');
//to store form data
Route::post('backend/tag',[\App\Http\Controllers\Backend\TagController::class,'store'])->name('backend.tag.store');
// to display form data
Route::get('backend/tag',[\App\Http\Controllers\Backend\TagController::class,'index'])->name('backend.tag.index');
//to display single detail of data
Route::get('backend/tag/{id}',[\App\Http\Controllers\Backend\TagController::class,'show'])->name('backend.tag.show');
// to delete data from database
Route::delete('backend/tag/{id}',[\App\Http\Controllers\Backend\TagController::class,'destroy'])->name('backend.tag.destroy');
// to edit data from database
Route::get('backend/tag/{id}/edit',[\App\Http\Controllers\Backend\TagController::class,'edit'])->name('backend.tag.edit');
// to update data of database
Route::put('backend/tag/{id}',[\App\Http\Controllers\Backend\TagController::class,'update'])->name('backend.tag.update');

################ BrandController ############
Route::get('backend/brand/create',[\App\Http\Controllers\Backend\BrandController::class,'create'])->name('backend.brand.create');
Route::post('backend/brand',[\App\Http\Controllers\Backend\BrandController::class,'store'])->name('backend.brand.store');
Route::get('backend/brand',[\App\Http\Controllers\Backend\BrandController::class, 'index'])->name('backend.brand.index');
Route::get('backend/brand/{id}',[\App\Http\Controllers\Backend\BrandController::class,'show'])->name('backend.brand.show');

################ AttributeController ############
Route::get('backend/attribute/create',[\App\Http\Controllers\Backend\AttributrController::class,'create'])->name('backend.attribute.create');
Route::post('backend/attribute',[\App\Http\Controllers\Backend\AttibuteController::class,'store'])->name('backend.attribute.store');
Route::get('backend/attribute',[\App\Http\Controllers\Backend\AttributeController::class, 'index'])->name('backend.attribute.index');
