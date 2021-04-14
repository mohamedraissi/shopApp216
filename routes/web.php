
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\BannersController;
use App\Http\Controllers\Client\ClientController;


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
Route::get('hhh', function(){
  return view ('layouts.admin_layout.hhh');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::prefix('/admin')->namespace('Admin')->group(function(){

  //#Rim

  //all the admin routes will be define here 
  Route::match(['get','post'],'/', [AdminController::class,'login']);
  Route::group(['middleware'=>['admin']],function(){
  Route::get('dashboard', [AdminController::class,'dashboard']);
  Route::get('settings', [AdminController::class,'settings']);
  Route::get('logout', [AdminController::class,'logout']); 
  Route::post('check-current-pwd', [AdminController::class,'checkCurrentPassword']);
  Route::post('update-current-pwd', [AdminController::class,'updateCurrentPassword']); 
  Route::match(['get','post'], 'update-admin-details', [AdminController::class,'updateAdminDetails']);
  Route::match(['post','get'], 'add-subadmin', [AdminController::class,'addSubAdmin']);
  Route::post('add-subadmin', [AdminController::class,'addSubAdmin']); 

  //#Nour

  //section
 Route::get('sections',[SectionController::class,'sections']);
 Route::post('update-section-status', [SectionController::class,'updateSectionStatus'] );
 Route::match(['get','post'], 'add-edit-section/{id?}',[SectionController::class,'addEditSection']);
 Route::get('delete-section/{id}' , [SectionController::class, 'deleteSection']);
 
 //categories 
  Route::get ('categories',[CategoryController::class,'categories']);
  Route::post('update-category-status', [CategoryController::class,'updateCategoryStatus'] );
  Route::match(['get','post'], 'add-edit-category/{id?}',[CategoryController::class,'addEditCategory']);
  Route::post('append-categories-level',[CategoryController::class,'appendCategoryLevel']);
  Route::get('delete-category-image/{id}' , [CategoryController::class, 'deleteCategoryImage']);
  Route::get('delete-category/{id}' , [CategoryController::class, 'deleteCategory']);
   //Brands
 Route::get ('brands',[BrandController::class,'brands']);
 Route::post('update-brand-status', [BrandController::class,'updateBrandStatus'] );
 Route::match(['get','post'], 'add-edit-brand/{id?}',[BrandController::class,'addEditBrand']);
 Route::get('delete-brand/{id}' , [BrandController::class, 'deleteBrand']);
//Banners 
  Route::match(['get','post'],'add-edit-banner/{id?}',[BannersController::class,'addeditBanner'] );
  Route::get('banners',[BannersController::class,'banners']);
  Route::post('update-banner-status', [BannersController::class,'updateBannerStatus'] );
  Route::get('delete-banner/{id}', [BannersController::class,'deleteBanner'] );
 //product
  Route::get('products', [ProductsController::class,'products']);
  Route::post('update-product-status', [ProductsController::class,'updateProductStatus'] );
  Route::get('delete-product/{id}', [ProductsController::class,'deleteProduct'] );
  Route::match(['get','post'], 'add-edit-product/{id?}',[ProductsController::class,'addEditProduct']);
  Route::get('delete-product-image/{id}' , [ProductsController::class, 'deleteProductImage']);
  Route::get('delete-product-video/{id}' , [ProductsController::class, 'deleteProductVideo']);
   //Attributes
   Route::match(['get','post'],'add-attributes/{id}',[ProductsController::class, 'addAttributes']);
   Route::post('edit-attributes/{id}',[ProductsController::class, 'editAttributes']);
     //image
  Route::match(['get','post'],'add-images/{id}', [ProductsController::class,'addImages']);
  Route::post('update-image-status', [ProductsController::class,'updateImageStatus'] );
  Route::get('delete-image/{id}', [ProductsController::class,'deleteImage'] );
  });
});

Route::get('index', [ClientController::class,'index']);
Route::get('shop', [ClientController::class,'shop']);
Route::get('blog', [ClientController::class,'blog']);
Route::get('contact', [ClientController::class,'contact']);
Route::get('blog-details', [ClientController::class,'blogd']);
Route::get('checkout', [ClientController::class,'check']);
Route::get('shopping-cart', [ClientController::class,'shopcart']);
