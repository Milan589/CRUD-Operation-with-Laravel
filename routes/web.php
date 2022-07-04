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

Route::prefix('backend/tag')->name('backend.tag.')->group(function(){
    //to show deleted data 
    //it should be given priority show kept on top
    Route::get('/trash',[\App\Http\Controllers\Backend\TagController::class,'trash'])->name('trash');
    //to restore deleted data
    //it should be given priority show kept on top
    Route::post('/restore/{id}',[\App\Http\Controllers\Backend\TagController::class,'restore'])->name('restore');
    //delete permanently
    Route::delete('/force_delete/{id}',[\App\Http\Controllers\Backend\TagController::class,'permanentDelete'])->name('force_delete');
    
    //to create form data
    Route::get('/create',[\App\Http\Controllers\Backend\TagController::class,'create'])->name('create');
    //to store form data
    Route::post('/',[\App\Http\Controllers\Backend\TagController::class,'store'])->name('store'); 
    // to display form data
    Route::get('/',[\App\Http\Controllers\Backend\TagController::class,'index'])->name('index');
    //to display single detail of data
    Route::get('/{id}',[\App\Http\Controllers\Backend\TagController::class,'show'])->name('show');
    // to delete data from database
    Route::delete('/{id}',[\App\Http\Controllers\Backend\TagController::class,'destroy'])->name('destroy');
    // to edit data from database
    Route::get('/{id}/edit',[\App\Http\Controllers\Backend\TagController::class,'edit'])->name('edit');
    // to update data of database
    Route::put('/{id}',[\App\Http\Controllers\Backend\TagController::class,'update'])->name('update');
    
    });





################# CategoryController ################

Route::prefix('backend/category')->name('backend.category.')->group(function(){
//to show deleted data 
//it should be given priority show kept on top
Route::get('/trash',[\App\Http\Controllers\Backend\CategoryController::class,'trash'])->name('trash');
//to restore deleted data
//it should be given priority show kept on top
Route::post('/restore/{id}',[\App\Http\Controllers\Backend\CategoryController::class,'restore'])->name('restore');
//delete permanently
Route::delete('/force_delete/{id}',[\App\Http\Controllers\Backend\CategoryController::class,'permanentDelete'])->name('force_delete');

//to create form data
Route::get('/create',[\App\Http\Controllers\Backend\CategoryController::class,'create'])->name('create');
//to store form data
Route::post('/',[\App\Http\Controllers\Backend\CategoryController::class,'store'])->name('store'); 
// to display form data
Route::get('/',[\App\Http\Controllers\Backend\CategoryController::class,'index'])->name('index');
//to display single detail of data
Route::get('/{id}',[\App\Http\Controllers\Backend\CategoryController::class,'show'])->name('show');
// to delete data from database
Route::delete('/{id}',[\App\Http\Controllers\Backend\CategoryController::class,'destroy'])->name('destroy');
// to edit data from database
Route::get('/{id}/edit',[\App\Http\Controllers\Backend\CategoryController::class,'edit'])->name('edit');
// to update data of database
Route::put('/{id}',[\App\Http\Controllers\Backend\CategoryController::class,'update'])->name('update');

});


################# SubategoryController ################

Route::prefix('backend/subcategory')->name('backend.subcategory.')->group(function(){
    //to show deleted data 
    //it should be given priority show kept on top
    Route::get('/trash',[\App\Http\Controllers\Backend\SubcategoryController::class,'trash'])->name('trash');
    //to restore deleted data
    //it should be given priority show kept on top
    Route::post('/restore/{id}',[\App\Http\Controllers\Backend\SubcategoryController::class,'restore'])->name('restore');
    //delete permanently
    Route::delete('/force_delete/{id}',[\App\Http\Controllers\Backend\SubcategoryController::class,'permanentDelete'])->name('force_delete');
    
    //to create form data
    Route::get('/create',[\App\Http\Controllers\Backend\SubcategoryController::class,'create'])->name('create');
    //to store form data
    Route::post('',[\App\Http\Controllers\Backend\SubcategoryController::class,'store'])->name('store'); 
    // to display form data
    Route::get('',[\App\Http\Controllers\Backend\SubcategoryController::class,'index'])->name('index');
    //to display single detail of data
    Route::get('/{id}',[\App\Http\Controllers\Backend\SubcategoryController::class,'show'])->name('show');
    // to delete data from database
    Route::delete('/{id}',[\App\Http\Controllers\Backend\SubcategoryController::class,'destroy'])->name('destroy');
    // to edit data from database
    Route::get('/{id}/edit',[\App\Http\Controllers\Backend\SubcategoryController::class,'edit'])->name('edit');
    // to update data of database
    Route::put('/{id}',[\App\Http\Controllers\Backend\SubcategoryController::class,'update'])->name('update');
    
    });
    
    


################# BrandController ################

Route::prefix('backend/brand')->name('backend.brand.')->group(function(){
    //to show deleted data 
    //it should be given priority show kept on top
    Route::get('/trash',[\App\Http\Controllers\Backend\BrandController::class,'trash'])->name('trash');
    //to restore deleted data
    //it should be given priority show kept on top
    Route::post('/restore/{id}',[\App\Http\Controllers\Backend\BrandController::class,'restore'])->name('restore');
    //delete permanently
    Route::delete('/force_delete/{id}',[\App\Http\Controllers\Backend\BrandController::class,'permanentDelete'])->name('force_delete');
    
    //to create form data
    Route::get('/create',[\App\Http\Controllers\Backend\BrandController::class,'create'])->name('create');
    //to store form data
    Route::post('',[\App\Http\Controllers\Backend\BrandController::class,'store'])->name('store'); 
    // to display form data
    Route::get('',[\App\Http\Controllers\Backend\BrandController::class,'index'])->name('index');
    //to display single detail of data
    Route::get('/{id}',[\App\Http\Controllers\Backend\BrandController::class,'show'])->name('show');
    // to delete data from database
    Route::delete('/{id}',[\App\Http\Controllers\Backend\BrandController::class,'destroy'])->name('destroy');
    // to edit data from database
    Route::get('/{id}/edit',[\App\Http\Controllers\Backend\BrandController::class,'edit'])->name('edit');
    // to update data of database
    Route::put('/{id}',[\App\Http\Controllers\Backend\BrandController::class,'update'])->name('update');
    
    });

    ################# ProductController ################

Route::prefix('backend/product')->name('backend.product.')->group(function(){
    //to show deleted data 
    //it should be given priority show kept on top
    Route::get('/trash',[\App\Http\Controllers\Backend\ProductController::class,'trash'])->name('trash');
    //to restore deleted data
    //it should be given priority show kept on top
    Route::post('/restore/{id}',[\App\Http\Controllers\Backend\ProductController::class,'restore'])->name('restore');
    //delete permanently
    Route::delete('/force_delete/{id}',[\App\Http\Controllers\Backend\ProductController::class,'permanentDelete'])->name('force_delete');
    
    //to create form data
    Route::get('/create',[\App\Http\Controllers\Backend\ProductController::class,'create'])->name('create');
    //to store form data
    Route::post('',[\App\Http\Controllers\Backend\ProductController::class,'store'])->name('store'); 
    // to display form data
    Route::get('',[\App\Http\Controllers\Backend\ProductController::class,'index'])->name('index');
    //to display single detail of data
    Route::get('/{id}',[\App\Http\Controllers\Backend\ProductController::class,'show'])->name('show');
    // to delete data from database
    Route::delete('/{id}',[\App\Http\Controllers\Backend\ProductController::class,'destroy'])->name('destroy');
    // to edit data from database
    Route::get('/{id}/edit',[\App\Http\Controllers\Backend\ProductController::class,'edit'])->name('edit');
    // to update data of database
    Route::put('/{id}',[\App\Http\Controllers\Backend\ProductController::class,'update'])->name('update');
    
    });
    
    

    
################ AttributeController ############
Route::get('backend/attribute/create',[\App\Http\Controllers\Backend\AttributrController::class,'create'])->name('backend.attribute.create');
Route::post('backend/attribute',[\App\Http\Controllers\Backend\AttibuteController::class,'store'])->name('backend.attribute.store');
Route::get('backend/attribute',[\App\Http\Controllers\Backend\AttributeController::class, 'index'])->name('backend.attribute.index');
