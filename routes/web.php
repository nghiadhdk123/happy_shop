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

    //Ph???n x??? l?? comment c???a ng?????i d??ng
    Route::group([
        'prefix' => 'comment',
        'middleware' => 'check_auth_user',
    ],function(){
        
        Route::post('/comment-store','CommentController@store')->name('comment.store');

        //Ph???n tr??? l???i comment
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
         //Thanh to??n ????n h??ng
        Route::post('/pay-cart','CartController@pay')->name('pay.cart');

        //Check m?? gi???m gi??
        Route::post('/check-code','CartController@checkVoucher')->name('code-voucher');

        //Y??u c???u h???y ????n h??ng
        Route::post('/order/cancel-order','OrderController@cancel')->name('order.cancel');
    });
   

    //Qu???n l?? ????n ?????t h??ng
    Route::group([
        'prefix' => 'admin',
        'middleware' => ['auth','check_admin'],
    ],function(){
        Route::get('/order','OrderController@index')->name('order.index');
        Route::get('/order/detail/{id}','OrderController@show')->name('order.detail');
        Route::post('/order/update','OrderController@update')->name('order.update');
        Route::get('/order/edit','OrderController@edit');
        
        //?????ng ?? h???y ????n h??ng
        Route::post('/order/check','OrderController@Check')->name('check');

        //T??? ch???i h???y ????n h??ng
        Route::post('/order/cancel','OrderController@Times')->name('cancel');

    });
});

//Ph???n qu???n l?? b??n h??? th???ng Admin
Route::group([
    'namespace' => 'Admin',
    'prefix' => 'admin',
    'middleware' => ['auth','check_admin'],
], function () {
    //Giao di???n trang tr???
    Route::get('/','DashbroadController@index')->name('dash.admin');
    
    //Qu???n l?? ng?????i d??ng
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

        //C???p nh???t ???nh c???a nh??n vi??n
        Route::post('/profile-avatar-update/{id}','UserController@profileUpdateAvatar')->name('user.update-profile-avatar');

        //Giao di???n Rest m???t kh???u
        Route::get('/reset-password/{id}','UserController@resetpass')->name('user.reset-password');

        //Ph???n x??? l?? reset m???t kh???u
        Route::post('/update-new-password/{id}','UserController@updateNewPass')->name('user.update-new-password');

        //X??a m???m ng?????i d??ng
        Route::delete('/delete/{id}','UserController@delete')->name('user.delete');

        //Hi???n th??? danh s??ch c??c t??i kho???n b??? x??a
        Route::get('/list-delete','UserController@list_delete')->name('user.list-delete');

        //Kh??i ph???c t??i kho???n ???? x??a
        Route::get('/restore/{id}','UserController@restore')->name('user.restore');

        //Giao di???n ph??n quy???n cho nh??n vi??n
        Route::get('/index-permission/{id}','UserController@indexPremission')->name('user.permission');

        //S??? l?? ph??n quy???n cho nh??n vi??n
        Route::post('/add-permission-for-role/{id}','UserController@addPremissionforRole')->name('user.add-permission-for-role');
    });

    //Qu???n l?? danh m???c s???n ph???m
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

    //Qu???n l?? s???n ph???m
    Route::group([
        'prefix' => 'product'
    ],function(){
        Route::get('/','ProductController@index')->name('product.index');
        Route::get('/create','ProductController@create')->name('product.create');
        Route::post('/create','ProductController@store')->name('product.store');
        Route::get('/list/{id}','ProductController@product_of_user')->name('product.list'); // Hi???n th??? danh s??ch s???n ph???m c???a t??i kho???n ??ang ????ng nh???p
        Route::post('/show','ProductController@show')->name('product.show');
        Route::get('/edit/{id}','ProductController@edit')->name('product.edit');
        Route::post('/update/{id}','ProductController@update')->name('product.update');
        Route::post('/destroy/{id}','ProductController@destroy')->name('product.destroy');
    });

    //Bi???u ????? th???ng k?? s???n ph???m
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

    //Qu???n l?? th??? c???a b??i vi???t
    Route::group([
        'prefix' => 'tag'
    ],function(){
        Route::get('/','TagController@index')->name('tag.index');
        Route::get('/create','TagController@create')->name('tag.create');
        Route::post('/create','TagController@store')->name('tag.store');
        Route::post('/toggle','TagController@toggle')->name('tag.toggle'); // ???n/hi???n th??? b??i vi???t
    });

    //Qu???n l?? m?? gi???m gi??
    Route::group([
        'prefix' => 'voucher'
    ],function(){
        Route::get('/','VoucherController@index')->name('voucher.index');
        Route::get('/create','VoucherController@create')->name('voucher.create');
        Route::post('/create','VoucherController@store')->name('voucher.store');

        //Giao di???n ph??t m?? gi???m gi??
        Route::get('/share-voucher/{code}','VoucherController@share')->name('voucher.share');

        //Ph??t m?? gi???m gi?? cho ng?????i d??ng
        Route::post('/success-share-voucher/{code}','VoucherController@shareSuccess')->name('voucher.share-success');
    });
});

//Qu???n l?? ????ng nh???p t??i kho???n
Route::group([
    'namespace' => 'Auth',
], function () {
    Route::get('/formlogin','LoginController@form')->name('login');
    Route::post('/login','LoginController@login')->name('login.sigin');
    Route::get('/logout','LogoutController@logout')->name('logout');
    Route::post('/register','LoginController@register')->name('register');
});

//????ng nh???p b???ng Facebook
Route::get('auth/facebook', [SocialController::class, 'facebookRedirect']);
Route::get('auth/facebook/callback', [SocialController::class, 'loginWithFacebook']);

//????ng nh???p b???ng Google
Route::get('auth/google', [SocialController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [SocialController::class, 'handleGoogleCallback']);

//????ng nh???p b???ng Git
Route::get('auth/github', [SocialController::class, 'gitRedirect']);
Route::get('auth/github/callback', [SocialController::class, 'gitCallback']);


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
