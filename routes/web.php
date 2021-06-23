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



Route::group(['middleware' => 'Lang'] ,function (){

//    languages routes
    Route::get('lang/{lang}' ,function ($lang){
       if(in_array($lang ,['ar' ,'en'])){
           if (session()->has('lang')){
               session()->remove('lang');
           }
           session()->put('lang' ,$lang);
       }
       return redirect() -> back();
    })->name('lang');

// set mood
    Route::get('/theme', function () {
        $mood = '';
        if(session()->has('mood')){
            $mood = session()->get('mood');
            session()->remove('mood');
            if($mood === 'dark'){
                session()->put('mood' ,'light');
            }elseif($mood === 'light'){
                session()->put('mood' ,'dark');
            }
        }else{
            session()->put('mood' ,'dark');
        }
        return redirect()->back();
    });



    //Route::get('/', 'Controllers\HomeController@index')->name('home');
    Route::get('/', 'Controllers\HomeController@index')->name('home');




// user routes
    Auth::routes(['register'=>false]);


    Route::get('/newuser',function (){
        return view('auth.register2');
    }) ->name('register');
    Route::post('/add_user','Controllers\NewUserController@create')->name('registerNew');
    Route::get('/logout' ,'Controllers\auth\LoginController@logout');


// dashboard routes
    Route::group(['prefix' => 'dashboard' ,'middleware'=>['auth' ,'dashboardAuth']] ,function (){
        Route::get('/' ,function (){
            return view('dashboard.dashboard');
        })->name('d.home');//end of dashboard home route


//    start of dashboard products routes
        Route::get('/products','Controllers\dProductCont@index');
        Route::get('/new-product','Controllers\dProductCont@create')->name('d.newProduct');
        Route::post('/product-store','Controllers\dProductCont@store')->name('d.product.store');
        Route::get('/product-edit/{id}','Controllers\dProductCont@edit')->name('d.product.edit')->middleware('userProducts');
        Route::post('/product-update','Controllers\dProductCont@update')->name('d.product.update');
        Route::get('/imgdestroy/{id}','Controllers\dProductCont@img_destroy')->name('d.img.destroy')->middleware('userProducts');
        Route::get('/destroy/{id}','Controllers\dProductCont@destroy')->name('d.destroy')->middleware('userProducts');
        Route::get('/product-section-delete/{sec_id}/{pro_id}' ,'Controllers\dProductCont@deleteProductSection')->name('d.delete.product.section');
        Route::post('/discount' ,'Controllers\dProductCont@discount')->name('discount');
        Route::post('/search' ,'Controllers\dProductCont@search')->name('d.search');


        // start sections roure
        Route::group(['middleware' => 'super'] ,function(){
            Route::get('/sections' ,'Controllers\sectionsController@index')->name('d.sections');
            Route::get('/new-section' ,'Controllers\sectionsController@create')->name('d.new.section');
            Route::post('/section-store' ,'Controllers\sectionsController@store')->name('d.store.section');
            Route::get('/section-edit/{id}' ,'Controllers\sectionsController@edit')->name('d.edit.section');
            Route::get('/products-section/{id}' ,'Controllers\sectionsController@products')->name('d.products.section');
            Route::post('/section-update' ,'Controllers\sectionsController@update')->name('d.update.section');
            Route::get('/section-delete/{id}' ,'Controllers\sectionsController@destroy')->name('d.delete.section');
        });  // end of dashboard sections routes


        // start users routes
        Route::group(['middleware' => 'super'] ,function (){
            Route::get('/users', 'Controllers\dUserCont@index')->name('d.users');
//        Route::get('/user/edit/{id}' ,'Controllers\dUserCont@edit')->name('d.user.edit');
//        Route::post('/user/update/{id}' ,'Controllers\dUserCont@update')->name('d.user.update'); // solve problem of using the session is to add id to form route
            Route::get('/user/delete/{id}' ,'Controllers\dUserCont@destroy')->name('d.user.delete');
            Route::post('/user/edit-job' ,'Controllers\dUserCont@editJob')->name('d.user.job.edit');
        }); // end of dashboard users routes

//    home slider
        Route::group(['prefix' => 'slider'] ,function(){
            Route::get('/' ,'Controllers\sliderCont@index')->name('slider');
            Route::get('/create' ,'Controllers\sliderCont@create')->name('slider.create');
            Route::post('/store' ,'Controllers\sliderCont@store')->name('slider.store');
            Route::get('/edit/{id}' ,'Controllers\sliderCont@edit')->name('slider.edit');
            Route::post('/update/{id}' ,'Controllers\sliderCont@update')->name('slider.update');
            Route::get('/delete/{id}' ,'Controllers\sliderCont@destroy')->name('slider.delete');
        });

    });//end of dashboard group

// like routes
    Route::post('/setLike' ,'Controllers\dProductCont@setLike')->name('set.like');
    Route::post('/deleteLike' ,'Controllers\dProductCont@deleteLike')->name('delete.like');
    Route::get('/likes/{user_id}' ,'Controllers\pagesCont@likes')->name('likes');
    Route::post('/deleteLikedProduct','Controllers\pagesCont@deleteLikedProduct')->name('deleteLikedProduct');


////// shopping cart routes
    Route::group(['prefix' => 'shoppingCart' ,'middleware' => 'auth'] ,function (){
        Route::get('/{user_id}' ,'Controllers\shoppingCartCont@index')->name('cart');
        Route::post('/add' ,'Controllers\shoppingCartCont@add')->name('add.to.cart');
        Route::post('/delete' ,'Controllers\shoppingCartCont@delete')->name('delete.from.cart');
        Route::post('/plus' ,'Controllers\shoppingCartCont@plus')->name('plus.cart');
        Route::post('/minus' ,'Controllers\shoppingCartCont@minus')->name('minus.cart');
    });


//    home sections
    Route::get('/section-products/{id}' ,'Controllers\HomeController@products_section')->name('products.section');

//    search
    Route::post('/search' ,'Controllers\HomeController@search')->name('home.search');

//    all products
    Route::get('/products' ,'Controllers\HomeController@allProducts')->name('all.products');

//    view-product
    Route::get('/view/{id}' ,'Controllers\HomeController@viewProduct')->name('view.product');

    //    comments
    Route::post('/addComment' ,'Controllers\commentsController@store')->name('add.comment');
    Route::post('/removeComment' ,'Controllers\commentsController@destroy')->name('remove.comment');
    Route::post('/updateComment'   ,'Controllers\commentsController@update')->name('update.comment');

//    account settings
    Route::group(['middleware' => 'auth' ,'prefix' => 'account'] ,function (){
        Route::get('/' ,'Controllers\accountSettingsCont@index')->name('accountSettings');
        Route::get('/img' ,'Controllers\accountSettingsCont@img')->name('user.img');
        Route::post('/img-update' ,'Controllers\accountSettingsCont@imgUpdate')->name('user.img.update');
        Route::get('/password' ,'Controllers\accountSettingsCont@password')->name('account.password');
        Route::post('/password-update' ,'Controllers\accountSettingsCont@passwordUpdate')->name('user.password.update');
    });



//    orders routes
    Route::get('/order/make' ,\Livewire\MakeOrder::class);
    Route::get('/order/end' ,\Livewire\OrderEnd::class);

    Route::get('/asd' ,function (){
        return view('asd');
    });



});/////////// end of group of set language
