<?php
use Illuminate\Support\Facades\Route;
use app\Http\Controllers\SocialController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FirmController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\firm;
use App\Models\products;
use App\Models\Orders;
use App\Models\User;

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
  
Route::prefix('admin')->middleware('isAdmin')->group(function(){
    Route::get('/dashboard', function () {
          $orders= Orders::where(['Status'=>3])->get();
          $users = User::where(['role'=>0])->get();
         return view('admin.dashboard',compact('orders','users'));
    });
    Route::get('/add_product',[FirmController::class,'add_product_index']);
    Route::post('/add_product_after',[ProductController::class,'add_product']);
    Route::get('/products-show',[ProductController::class,'show_product']);
    Route::post('/edit_product',[ProductController::class,'edit_product']);
    Route::get('/delete/{id}',[ProductController::class,'delete_product']);
    Route::get('/firms-show',[FirmController::class,'firm_table']);
    Route::post('/firms-show/add',[FirmController::class,'firm_add']);
    Route::post('/approve/order',[OrderController::class,'approve']);
    Route::post('/firms-show/edit',[FirmController::class,'firm_edit']);
    Route::get('/orders-show',[OrderController::class,'orders_show']);
    Route::get('/users-show',[UserController::class,'users_show']);
    Route::get('/delete_user/{id}',[UserController::class,'delete_user']);
    Route::get('/hoanthanh/{id}',[OrderController::class,'hoanthanh']);
    Route::get('/chitiet-order/i={id}',[OrderController::class,'chitiet']);
    Route::get('/thongke',[ProductController::class,'thongke']);
  
});
Route::prefix('/')->middleware('Client')->group(function(){
    Route::get('showcart',[CartController::class,'showcart']);
    Route::get('removecart/r={id}',[CartController::class,'removecart']);
    Route::get('views_detail_cart={id}',[CartController::class,'detail_order']);
    Route::get('getorder',[CartController::class,'getorder']);
    Route::get('addcart/c={id}',[CartController::class,'add']);
    Route::get('subcart/c={id}',[CartController::class,'sub']);
    Route::post('/views_detail_cart/order',[OrderController::class,'order_now']);
    Route::post('/pay_vnpay',[PaymentController::class,'Payment']);
    Route::get('/payment/order={id}',[PaymentController::class,'direct_payment']);
    Route::get('/orderhistory',function(){
        $orders = Orders::whereraw('id_user ='.session('user_id').' and Status > -1' ) ->get();
        return view('client.order-history',compact('orders'));
    });
    Route::get('cancel/order={id}',[OrderController::class,'cancel']);
    Route::get('buy_now/product={id}',[OrderController::class,'buy_now']);

}); 
 

Route::get('/', function () {
    $firms=firm::all();
    return view('client.index',compact('firms'));
});
Route::get('/{price1}&{price2}', function ($price1,$price2) {
    $name = '$'.$price1.'-'.'$'.$price2;
    $firms=firm::all();
    $products=products::whereBetween('price',[$price1,$price2])->get();
    return view('client.search-product-price',compact('firms','products','name'));
});
Route::get('/firm-{name}', function ($name) {
    $firms=firm::all();
    $products=firm::where(['name'=>$name])->get();
    return view('client.search-product',compact('firms','products','name'));
});


Route::get('login', function () {
    return view('login');
});

Route::get('login-admin', function () {
    return view('login-admin');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/forgot-password', function () {
    return view('forgot-password');
});


Route::get('/search/q={name}',[ProductController::class,'search']);
Route::get('/detail-{id}',[ProductController::class,'detail']);
Route::post('/login/user',[UserController::class, 'validate_login']);
Route::post('/login-admin/user',[UserController::class, 'validate_login_admin']);
Route::post('/registration/user',[UserController::class, 'validate_registration']);
Route::get('/logout',[UserController::class, 'logout']);
Route::get('/logout-admin',[UserController::class, 'logout_admin']);