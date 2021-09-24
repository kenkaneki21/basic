<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Models\User;
use App\Models\Brand;

use App\Models\Multipic;
use Illuminate\Support\Facades\DB;

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
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
	$brands = Brand::all();
	$images = Multipic::all();
	$abouts = DB::table('home_abouts')->first();



    return view('home',compact('brands','abouts','images'));
});
Route::post('/upload', function (Request $request) {
    Image::make(request('uploaded_file'))->resize(300, 200)->save('saved.jpg');   
});

// Category Controller

Route::get('/category/all',[CategoryController::class,'AllCat'])->name('all.category');
Route::post('/category/add',[CategoryController::class,'AddCat'])->name('store.category');
Route::get('/category/edit/{id}',[CategoryController::class,'Edit']);
Route::post('/category/update/{id}',[CategoryController::class,'Update']);
Route::get('/category/softdelete/{id}',[CategoryController::class,'SoftDelete']);
Route::get('/category/restore/{id}',[CategoryController::class,'Restore']);
Route::get('/category/pdelete/{id}',[CategoryController::class,'Pdelete']);


/// For Brand Controller
Route::get('/brand/all',[BrandController::class,'AllBrand'])->name('all.brand');
Route::post('/brand/add',[BrandController::class,'StoreBrand'])->name('store.brand');
Route::get('/brand/edit/{id}',[BrandController::class,'Edit']);
Route::post('/brand/update/{id}',[BrandController::class,'Update']);
Route::get('/brand/softdelete/{id}',[BrandController::class,'Delete']);

/// Multi Imager Route
Route::get('/multi/all',[BrandController::class,'Multipic'])->name('all.multiimage');
Route::post('/multi/add',[BrandController::class,'StoreImage'])->name('store.image');

// ADmin all route
Route::get('/home/slider',[HomeController::class,'HomeSlider'])->name('home.slider');
Route::get('/add/slider',[HomeController::class,'AddSlider'])->name('add.slider');

Route::post('/store/slider',[HomeController::class,'StoreSlider'])->name('store.slider');
Route::get('/slider/edit/{id}',[HomeController::class,'EditSLider']);
Route::post('/update/slider/{id}',[HomeController::class,'UpdateSLider']);


// Home About All Route
Route::get('/home/about',[AboutController::class,'HomeAbout'])->name('home.about');
Route::get('/add/about',[AboutController::class,'AddAbout'])->name('add.about');
Route::post('/store/about',[AboutController::class,'StoreAbout'])->name('store.about');
Route::get('/edit/about/{id}',[AboutController::class,'EditAbout']);
Route::post('/update/about/{id}',[AboutController::class,'UpdateAbout']);
Route::get('/about/delete/{id}',[AboutController::class,'DeleteAbout']);


//Route Portfolio
Route::get('/portfolio',[AboutController::class,'Portfolio']);
Route::get('/contact',[AboutController::class,'Contact']);





Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    //$users = User::all();
    $users = DB::table('users')->get();
    return view('admin.index');
})->name('dashboard');

Route::get('user/logout',[BrandController::class,'Logout'])->name('user.logout');