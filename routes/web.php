<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\BrandController;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Color;
Use App\Models\Size;
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
route::get('admin',[AdminController::class,'index']);

route::post('admin/auth',[AdminController::class,'auth'])->name('admin.auth');

route::group(['middleware'=>'admin_auth'],function(){  
    route::get('admin/dashboard',[AdminController::class,'dashboard']);

    route::get('admin/category',[CategoryController::class,'category']);
    route::get('admin/category/manage_category',[CategoryController::class,'manage_category']);
    route::get('admin/category/manage_category/{id}',[CategoryController::class,'manage_category']);
    route::post('admin/category/manage_category_process',[CategoryController::class,'manage_category_process'])->name('category.manage_category_process');
    route::get('admin/category/delete/{id}',[CategoryController::class,'delete']);
    route::get('admin/category/status/{status}/{id}',[CategoryController::class,'status']);
  
    route::get('admin/coupon',[CouponController::class,'coupon']);
    route::get('admin/coupon/manage_coupon',[CouponController::class,'manage_coupon']);
    route::get('admin/coupon/manage_coupon/{id}',[CouponController::class,'manage_coupon']);
    route::post('admin/coupon/manage_coupon_process',[CouponController::class,'manage_coupon_process'])->name('coupon.manage_coupon_process');
    route::get('admin/coupon/delete/{id}',[CouponController::class,'delete']);
    route::get('admin/coupon/status/{status}/{id}',[CouponController::class,'status']);


    route::get('admin/size',[SizeController::class,'size']);
    route::get('admin/size/manage_size',[SizeController::class,'manage_size']);
    route::get('admin/size/manage_size/{id}',[SizeController::class,'manage_size']);
    route::post('admin/size/manage_size_process',[SizeController::class,'manage_size_process'])->name('size.manage_size_process');
    route::get('admin/size/delete/{id}',[SizeController::class,'delete']);
    route::get('admin/size/status/{status}/{id}',[SizeController::class,'status']);

    route::get('admin/color',[ColorController::class,'color']);
    route::get('admin/color/manage_color',[ColorController::class,'manage_color']);
    route::get('admin/color/manage_color/{id}',[ColorController::class,'manage_color']);
    route::post('admin/color/manage_color_process',[ColorController::class,'manage_color_process'])->name('color.manage_color_process');
    route::get('admin/color/delete/{id}',[ColorController::class,'delete']);
    route::get('admin/color/status/{status}/{id}',[ColorController::class,'status']);

    route::get('admin/product',[ProductController::class,'product']);
    route::get('admin/product/manage_product',[ProductController::class,'manage_product']);
    route::get('admin/product/manage_product/{id}',[ProductController::class,'manage_product']);
    route::post('admin/product/manage_product_process',[ProductController::class,'manage_product_process'])->name('product.manage_product_process');
    route::get('admin/product/delete/{id}',[ProductController::class,'delete']);
    route::get('admin/product/status/{status}/{id}',[ProductController::class,'status']);

    route::get('admin/brand',[BrandController::class,'brand']);
    route::get('admin/brand/manage_brand',[BrandController::class,'manage_brand']);
    route::get('admin/brand/manage_brand/{id}',[BrandController::class,'manage_Brand']);
    route::post('admin/brand/manage_brand_process',[BrandController::class,'manage_brand_process'])->name('brand.manage_brand_process');
    route::get('admin/brand/delete/{id}',[BrandController::class,'delete']);
    route::get('admin/brand/status/{status}/{id}',[BrandController::class,'status']);

    route::get('admin/product/product_attr_delete/{paid}/{pid}',[ProductController::class,'product_attr_delete']);
    route::get('admin/product/product_images_delete/{piid}/{pid}',[ProductController::class,'product_images_delete']);


    
    Route::get('admin/logout', function(){
        session()->forget('Admin_Login');
        session()->forget('Admin_Id'); 
        session()->flash('error','You Logout Successfully');
        return redirect('admin');
    
    });
    

});
    
