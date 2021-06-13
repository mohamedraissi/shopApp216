
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\OptionValuesController;
use App\Http\Controllers\Admin\BannersController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Front\ProductsController as ProductFront;
use App\Http\Controllers\Front\UsersController;
use App\Http\Controllers\Front\OrdersController;
use App\Http\Controllers\Admin\OrdersController as OrdersAdmin;
use App\Http\Controllers\Admin\CouponController;

use App\Models\OptionValues;
use App\Models\Option;
use App\Models\Product;
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
use App\Models\Category;

/*Route::get('/', function () {
    return view('welcome');
});*/



Route::prefix('/admin')->namespace('Admin')->group(function(){


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
//banners 
  Route::match(['get','post'],'add-edit-banner/{id?}',[BannersController::class,'addeditBanner'] );
  Route::get('banners',[BannersController::class,'banners']);
  Route::post('update-banner-status', [BannersController::class,'updateBannerstatus'] );
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
  Route::post('update-attribute-status', [ProductsController::class,'updateAttributeStatus'] );

     //image
  Route::match(['get','post'],'add-images/{id}', [ProductsController::class,'addImages']);
  Route::post('update-image-status', [ProductsController::class,'updateImageStatus'] );
  Route::get('delete-image/{id}', [ProductsController::class,'deleteImage'] );
  //add option in product
  Route::match(['get','post'],'add-options/{id}',[ProductsController::class, 'addOptions']);
  Route::get('delete-option-in-product/{id}/{value_id}/' , [ProductsController::class, 'deleteOptionInporduct']);
  //Option
  Route::get ('options',[OptionController::class,'options']);
  Route::post('update-option-status', [OptionController::class,'updateOptionStatus'] );
  Route::match(['get','post'], 'add-edit-option/{id?}',[OptionController::class,'addEditOption']);
  Route::get('delete-option/{id}' , [OptionController::class, 'deleteOption']);
  Route::get('delete-value/{id}' , [OptionController::class, 'deleteValue']);
  Route::match(['get','post'],'add-value/{id}' , [OptionController::class,'addValues']);
  Route::post('edit-value/{id}',[OptionController::class, 'editValues']);
  Route::post('update-value-status', [OptionController::class,'updateValueStatus'] );
  //coupons
  Route::get('coupons', [CouponController::class,'coupons'] );
  Route::post('update-coupon-status', [CouponController::class,'updatecouponStatus'] );
  Route::match(['get','post'],'add-edit-coupon/{id?}',[CouponController::class,'addeditCoupon'] );
  Route::get('delete-coupon/{id}' , [CouponController::class, 'deleteCoupon']);

    //orders 
  Route::get('/orders',[OrdersAdmin::class, 'Orders']);
  Route::get('/orders/{id}',[OrdersAdmin::class, 'OrderDetails']);
  Route::post('/update-order-status',[OrdersAdmin::class, 'UpdateOrderStatus']);
  Route::get('view-order-invoice/{id}',[OrdersAdmin::class, 'viewOrderInvoice']); 

  });
  
});

Route::get('/', [ClientController::class,'index']);
Route::get('shop', [ClientController::class,'shop']);
Route::get('blog', [ClientController::class,'blog']);
Route::get('contact', [ClientController::class,'contact']);
Route::get('blog-details', [ClientController::class,'blogd']);

Route::get('shopping-cart', [ClientController::class,'shopcart']);
Route::namespace('front')->group(function(){
  //Route::get('/',IndexController::class,'index');
  //Route::get('/{url}',[ProductFront::class,'listing']);
   //listing categories route
  $catUrls = Category::select('url')->where('status',1)->get()->pluck("url")->toArray();
  foreach ($catUrls as $key => $url) {
    Route::get('/'.$url,[ProductFront::class,'listing']);
  }
 //shopping cart route
 Route::get('/cart',[ProductFront::class,'cart']);
 //product detail route
 Route::get('/product/{id}',[ProductFront::class,'detail']);
 //get product attribute price
 Route::post('/get-product-price',[ProductFront::class,'getProductPrice']);
 //add to carts route
 Route::post('/add-to-cart',[ProductFront::class,'addtocart']);

 // Update cart Item quantity
 Route::post('/update-cart-item-qty',[ProductFront::class,'updatetoCartItemQty']);

 // Delete cart Item 
 Route::post('/delete-cart-item',[ProductFront::class,'DeleteCartItem']);

 // Login and register
 Route::get('/Login',[UsersController::class,'Login']);
 Route::get('/Register', [UsersController::class,'Register']);

 Route::post('/Log-in',[UsersController::class ,'LoginUser']);
 Route::post('/Registered',[UsersController::class ,'RegisterUser']);


 // CHECK EMAIL

 Route::match(['get','post'],'/check-email',[UsersController::class, 'checkEmail']);

 // LOGOUT USER
 Route::get('/logout',[UsersController::class ,'logoutUser']);

// CONFIRMATION 

Route::match(['get','post'],'/confirm/{code}',[UsersController::class, 'confirmAccount']);

Route::match(['get','post'],'/forgot_password',[UsersController::class, 'forgotPassword']);
Route::group(['middleware'=>['auth']],function(){

// Users account profile
Route::match(['get','post'],'/account',[UsersController::class, 'account']);

Route::post('/check-user-pwd',[UsersController::class ,'chkUserPassword']);

Route::post('/update-user-pwd',[UsersController::class ,'updateUserPassword']);

Route::post('/apply-coupon',[ProductFront::class ,'applyCoupon']);
  });
  Route::match(['get','post'],'/checkout',[ProductFront::class, 'checkout']);

  // ADD EDIT ADRESS
  Route::match(['get','post'],'/add-edit-delivery-address/{id?}',[ProductFront::class, 'addeditdeliveryaddress']);
  Route::get('/delete-edit-delivery-address/{id}',[ProductFront::class, 'deleteeditdeliveryaddress']);

  Route::get('/thanks',[ProductFront::class, 'thanks']);


  Route::get('/orders',[OrdersController::class, 'Order']);
  Route::get('/orders/{id}',[OrdersController::class, 'OrderDetails']);


});
