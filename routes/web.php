<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;

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
    return view('master', ['pageScript'=>'<script src="assets/js/homeOneChart.js"></script>']);
});

/***** Forms Routes *****/
Route::get('/newCatForm', [CategoryController::class, 'newCategory']);
Route::get('/editCatForm/{cid}', [CategoryController::class, 'changeCategory']);
Route::get('/newItemForm', [ItemController::class, 'newItem']);
Route::get('/editItemForm/{iid}', [ItemController::class, 'changeItem']);

/***** Management Pages *****/
Route::get('/manageCategory', [CategoryController::class, 'index']);
Route::get('/manageItems', [ItemController::class, 'index']);

/***** Ajax Actions *****/
Route::post('/saveCat', [CategoryController::class, 'saveCategory']);
Route::post('/saveItem', [ItemController::class, 'saveItem']);
Route::post('/listCats', [CategoryController::class, 'categoriesList']);
Route::post('/listItems', [ItemController::class, 'itemsList']);
Route::post('/deleteCat', [CategoryController::class, 'deleteCategory']);
Route::post('/deleteItem', [ItemController::class, 'deleteItem']);