<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialController;
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

Route::get('/mail',function(){
    return view('client.my-voucher.index');
});


Route::group([
    'namespace' => 'Client',
    'prefix' => '/',
],function() {
    Route::get('/','HomeController@index')->name('home');
    Route::get('/form-login','HomeController@formLoginClient')->name('login-client');
    Route::get('/form-register','HomeController@formRegisterClient')->name('register-client');


    Route::group([
        'prefix' => 'product',
    ],function(){

        Route::get('/detail/{slug}','ProductController@show')->name('product.detail');
        Route::get('/product-by-category/{slug}','ProductController@ProductByCategory')->name('product-by-category');
    });

    Route::group([
        'prefix' => 'user',
        'middleware' => 'check_auth_user',
    ],function(){

        Route::get('/profile-client/{id}','UserController@profileClient')->name('profile-client');
        Route::post('/update-profile-client/{id}','UserController@update')->name('update-profile-client');

        Route::get('/my-order/{id}','UserController@myOrder')->name('my-order');
    });

    Route::group([
        'prefix' => 'post',
        'middleware' => 'check_auth_user',
    ],function(){
        
        Route::get('/','PostController@index')->name('post-client.index');

        Route::get('/create','PostController@create')->name('post.create');
        
        Route::post('/create','PostController@store')->name('post-client.store');

        Route::post('/like','PostController@likes')->name('post.like');

        Route::get('/detail/{slug}','PostController@show')->name('post.show');

        Route::get('/post-by-tag/{id}','PostController@postTag')->name('post.post-by-tag');
    });

    //Phần xủ lí comment của người dùng
    Route::group([
        'prefix' => 'comment',
        'middleware' => 'check_auth_user',
    ],function(){
        
        Route::post('/comment-store','CommentController@store')->name('comment.store');

        //Phần trả lời comment
        Route::post('/reply-comment','CommentController@reply')->name('comment.reply');
    });

    Route::group([
        'prefix' => 'my-voucher',
        'middleware' => 'check_auth_user',
    ],function(){
        Route::get('/{id}','VoucherController@index')->name('my-voucher');
    });

});


Route::group([
    'namespace' => 'Cart',
    'prefix' => 'cart',
],function(){

    Route::get('/','CartController@index')->name('cart');
    Route::post('/add-cart','CartController@add')->name('add.cart');
    Route::post('/delete-cart','CartController@delete')->name('delete.cart');
    Route::get('/updateNumber','CartController@update')->name('update.cart');

    Route::group([
         'middleware' => ['check_auth_user'],
    ],function(){
         //Thanh toán đơn hàng
        Route::post('/pay-cart','CartController@pay')->name('pay.cart');

        //Check mã giảm giá
        Route::post('/check-code','CartController@checkVoucher')->name('code-voucher');

        //Yêu cầu hủy đơn hàng
        Route::post('/order/cancel-order','OrderController@cancel')->name('order.cancel');
    });
   

    //Quản lí đơn đặt hàng
    Route::group([
        'prefix' => 'admin',
        'middleware' => ['auth','check_admin'],
    ],function(){
        Route::get('/order','OrderController@index')->name('order.index');
        Route::get('/order/detail/{id}','OrderController@show')->name('order.detail');
        Route::post('/order/update','OrderController@update')->name('order.update');
        Route::get('/order/edit','OrderController@edit');
        
        //Đồng ý hủy đơn hàng
        Route::post('/order/check','OrderController@Check')->name('check');

        //Từ chối hủy đơn hàng
        Route::post('/order/cancel','OrderController@Times')->name('cancel');

    });
});

//Phần quản lí bên hệ thống Admin
Route::group([
    'namespace' => 'Admin',
    'prefix' => 'admin',
    'middleware' => ['auth','check_admin'],
], function () {
    //Giao diện trang trủ
    Route::get('/','DashbroadController@index')->name('dash.admin');
    
    //Quản lí người dùng
    Route::group([
        'prefix' => 'user',
    ],function(){
        Route::get('/','UserController@index')->name('user.index');
        Route::get('/create','UserController@create')->name('user.create');
        Route::post('/create','UserController@store')->name('user.store');
        Route::get('/edit/{id}','UserController@edit')->name('user.edit');
        Route::post('/update/{id}','UserController@update')->name('user.update');
        Route::post('/destroy/{id}','UserController@destroy')->name('user.destroy');
        Route::get('/locktoogle/{id}','UserController@locktoggle')->name('user.locktoggle');
        Route::get('/profile/{id}','UserController@show')->name('user.show');
        Route::get('/profile-edit/{id}','UserController@profile')->name('user.edit-profile');
        Route::post('/profile-update/{id}','UserController@profileUpdate')->name('user.update-profile');

        //Cập nhật ảnh của nhân viên
        Route::post('/profile-avatar-update/{id}','UserController@profileUpdateAvatar')->name('user.update-profile-avatar');

        //Giao diện Rest mật khẩu
        Route::get('/reset-password/{id}','UserController@resetpass')->name('user.reset-password');

        //Phần xử lí reset mật khẩu
        Route::post('/update-new-password/{id}','UserController@updateNewPass')->name('user.update-new-password');

        //Xóa mềm người dùng
        Route::delete('/delete/{id}','UserController@delete')->name('user.delete');

        //Hiển thị danh sách các tài khoản bị xõa
        Route::get('/list-delete','UserController@list_delete')->name('user.list-delete');

        //Khôi phục tài khoản đã xóa
        Route::get('/restore/{id}','UserController@restore')->name('user.restore');

        //Giao diện phân quyền cho nhân viên
        Route::get('/index-permission/{id}','UserController@indexPremission')->name('user.permission');

        //Sử lí phân quyền cho nhân viên
        Route::post('/add-permission-for-role/{id}','UserController@addPremissionforRole')->name('user.add-permission-for-role');
    });

    //Quản lí danh mục sản phẩm
    Route::group([
        'prefix' => 'category'
    ],function(){
        Route::get('/','CategoryController@index')->name('category.index');
        Route::get('/create','CategoryController@create')->name('category.create');
        Route::post('/create','CategoryController@store')->name('category.store');
        Route::get('/edit/{id}','CategoryController@edit')->name('category.edit');
        Route::post('/update/{id}','CategoryController@update')->name('category.update');
        Route::post('/show','CategoryController@show')->name('category.show');
        Route::post('/destroy/{id}','CategoryController@destroy')->name('category.destroy');
    });

    //Quản lí sản phẩm
    Route::group([
        'prefix' => 'product'
    ],function(){
        Route::get('/','ProductController@index')->name('product.index');
        Route::get('/create','ProductController@create')->name('product.create');
        Route::post('/create','ProductController@store')->name('product.store');
        Route::get('/list/{id}','ProductController@product_of_user')->name('product.list'); // Hiển thị danh sách sản phẩm của tài khoản đang đăng nhập
        Route::post('/show','ProductController@show')->name('product.show');
        Route::get('/edit/{id}','ProductController@edit')->name('product.edit');
        Route::post('/update/{id}','ProductController@update')->name('product.update');
        Route::post('/destroy/{id}','ProductController@destroy')->name('product.destroy');
    });

    //Biều đồ thống kê sản phẩm
    Route::group([
        'prefix' => 'statistical'
    ],function(){
        Route::get('/','StatisController@index')->name('statis.index');
        Route::post('/filter-by-date','StatisController@filter_by_date')->name('statis.filter-by-date');
        Route::post('/one-month','StatisController@OneMonth')->name('statis.onemonth');
        Route::post('/filter-day-month-year','StatisController@filterday')->name('statis.statisticalfilterday');
        
        Route::post('/filter-by-year','StatisController@filteryear')->name('statis.statisticalfilteryear');

        Route::post('/two-weeks','StatisController@TwoWeeks')->name('statis.twoweeks');
        
    });

    //Quản lí thẻ của bài viết
    Route::group([
        'prefix' => 'tag'
    ],function(){
        Route::get('/','TagController@index')->name('tag.index');
        Route::get('/create','TagController@create')->name('tag.create');
        Route::post('/create','TagController@store')->name('tag.store');
        Route::post('/toggle','TagController@toggle')->name('tag.toggle'); // Ẩn/hiện thẻ bài viết
    });

    //Quản lí mã giảm giá
    Route::group([
        'prefix' => 'voucher'
    ],function(){
        Route::get('/','VoucherController@index')->name('voucher.index');
        Route::get('/create','VoucherController@create')->name('voucher.create');
        Route::post('/create','VoucherController@store')->name('voucher.store');

        //Giao diện phát mã giảm giá
        Route::get('/share-voucher/{code}','VoucherController@share')->name('voucher.share');

        //Phát mã giảm giá cho người dùng
        Route::post('/success-share-voucher/{code}','VoucherController@shareSuccess')->name('voucher.share-success');
    });
});

//Quản lí đăng nhập tài khoản
Route::group([
    'namespace' => 'Auth',
], function () {
    Route::get('/formlogin','LoginController@form')->name('login');
    Route::post('/login','LoginController@login')->name('login.sigin');
    Route::get('/logout','LogoutController@logout')->name('logout');
    Route::post('/register','LoginController@register')->name('register');
});

//Đăng nhập bằng Facebook
Route::get('auth/facebook', [SocialController::class, 'facebookRedirect']);
Route::get('auth/facebook/callback', [SocialController::class, 'loginWithFacebook']);

//Đăng nhập bằng Google
Route::get('auth/google', [SocialController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [SocialController::class, 'handleGoogleCallback']);

//Đăng nhập bằng Git
Route::get('auth/github', [SocialController::class, 'gitRedirect']);
Route::get('auth/github/callback', [SocialController::class, 'gitCallback']);


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
