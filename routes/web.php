<?php

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
//CEK API ONGKIR
Route::get('/get_kabupaten/{id}', 'getKabupaten@getKabupaten');
Route::get('/get_all_kabupaten', 'getKabupaten@getKabupatenAll');
Route::get('/get_provinsi', 'getKabupaten@getDataProvinsi');
Route::get('/cek', function(){
    return "tes";
});

Route::post('/cek_ongkir', 'getKabupaten@cekOngkir');

Route::get('/', 'HomeController@landingPage');
Route::get('/find/meja', function(){
    return view('meja');
});
Route::get('/basic_mail', 'MailController@html_email');

Auth::routes();
Route::get('user/activation/{token}', 'Auth\RegisterController@activateUser')->name('user.activate');

Route::get('/home', 'HomeController@index');
Route::get('/user/logout', 'Auth\LoginController@logout');

Route::get('/produk', 'HomeController@view_produk');
Route::get('/produk/{id}', 'HomeController@detail_produk');
Route::get('/produk/cari/all', 'HomeController@cari_produk');
Route::get('/produk/kategori/{id}', 'HomeController@kategori_produk');

//Login Facebook
Route::get('login/facebook', 'AuthenticateController@redirectToProvider');
Route::get('login/facebook/callback', 'AuthenticateController@handleProviderCallback');

//Login Google
Route::get('login/google', 'AuthGoogle@redirectToProvider');
Route::get('login/google/callback', 'AuthGoogle@handleProviderCallback');


Route::group(['middleware' => ['auth:web']], function(){
    Route::prefix('user')->group(function() {

        Route::get('/', function(){
            return redirect('/user/dashboard');
        });
        Route::get('/dashboard', 'UserController@dashboard');
        Route::get('/pesanan_produk', 'UserController@pesanan_produk');
        Route::get('/pesanan_tender', 'UserController@pesanan_tender');
        Route::get('/wishlist', 'UserController@wishlist');
        Route::post('/post_usaha', 'UserController@postUsaha');

        //PESAN
        Route::get('/chat', 'UserController@formChat');

        Route::get('/buka_usaha', function() {
            if(auth()->user()->usaha == null)
                return view('user.buka-usaha');
            return redirect('/user/usaha');
        });

        //WISHLIST
        Route::post('/produk/add_to_wishlist', 'UserController@add_to_wishlist');
        Route::post('/produk/delete_wishlist/', 'UserController@delete_wishlist');

            
        //ROUTE PENGRAJIN
        Route::get('/usaha/tambah_produk/get_jenis/{id}', 'PengrajinController@getJenis');

        Route::get('/usaha/produk', 'PengrajinController@usahaProduk');
        Route::get('/usaha/produks', 'PengrajinController@usahaProduks');
        Route::get('/usaha/tambah_produk', 'PengrajinController@usahaTambahProduk');
        Route::post('/usaha/postProduk', 'PengrajinController@postProduk');

        //CARI PRODUK
        Route::get('/usaha/produk/find/{id}', 'PengrajinController@cari_produk');

        //UPDATE PRODUK
        Route::get('/usaha/produk/{id}/edit', 'PengrajinController@form_edit_produk');
        Route::post('/usaha/produk/foto/update', 'PengrajinController@updateGambarProduk');

        Route::get('/usaha', 'PengrajinController@index');
        Route::post('/usaha/tambah_produk/tambah_material', 'PengrajinController@tambah_material');

        //NOTIFIKASI
        Route::resource('/usaha/notifikasi', 'NotifikasiController');
        Route::resource('/usaha/notifikasi/{id}/update', 'NotifikasiController@update');

        //PESAN
        Route::get('/usaha/pesan', 'UserController@formChat');

        //CART
        Route::resource('/chart', 'CartController');

    });
});

Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index');
    Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
    Route::get('/kelola/users', 'AdminController@view_user');
    Route::get('/kelola/usaha', 'AdminController@view_usaha');


    Route::get('/kelola/produk/all', 'AdminController@allProduks');
    Route::get('/produk/edit/{id}', 'AdminController@editProduk');
    Route::post('/produk/updating', 'AdminController@updatingProduk');

    //material kayu
    Route::post('/material/setuju', 'AdminController@updateMaterial');
    Route::post('/material/hapus', 'AdminController@deleteMaterial');
    //Route::post('/material/hapus/form_message', 'AdminController@formNotifikasi');
    Route::delete('/material/tolak/{id}', 'AdminController@deleteMaterial');


    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
});
//Route::get('/login', 'AuthenticateController@getLogin');
//Route::get('/register', 'AuthenticateController@getRegister');
//Route::post('/prosesLogin', 'AuthenticateController@postLogin');
//Route::post('/prosesRegister', 'AuthenticateController@postRegister');

//Login Facebook
// Route::get('login/facebook', 'AuthenticateController@redirectToProvider');
// Route::get('login/facebook/callback', 'AuthenticateController@handleProviderCallback');

// //Login Google
// Route::get('login/google', 'AuthGoogle@redirectToProvider');
// Route::get('login/google/callback', 'AuthGoogle@handleProviderCallback');

// //Router Admin
// Route::group( ['middleware' => ['auth', 'rule:Admin'] ], function()
// {
//     Route::get('/admin', 'Admin\AdminController@index');
//     Route::get('/users', 'UserController@users');
//     Route::get('/users/profile', 'UserController@profile');
// });

// //Router Penjual
// Route::group( ['middleware' => ['auth', 'rule:Penjual'] ], function()
// {
//     Route::get('/penjual', 'Penjual\PenjualController@index');
//     Route::get('/profile', 'Penjual\PenjualController@profile');

//     //MENU
//     Route::get('/produk', 'Penjual\PenjualController@produk');
//     Route::get('/produk/{id}', 'Penjual\PenjualController@lihat_produk');
//     Route::get('/tambah_produk', 'Penjual\PenjualController@tambahProduk');
//     Route::get('/pemesanan', 'Penjual\PenjualController@pemesanan');
//     Route::get('/konfrm_pengiriman', 'Penjual\PenjualController@konfirmPengiriman');
//     Route::get('/pesan', 'Penjual\PenjualController@pesan');
//     Route::get('/tender', 'Penjual\PenjualController@tender');

//     //SIMPAN DATABASE
//     Route::post('/postProduk', 'Penjual\PenjualController@postProduk');
// });


// //Router Pembeli
// Route::group( ['middleware' => ['auth', 'rule:Pembeli'] ], function()
// {
//     Route::get('/pembeli', 'Pembeli\PembeliController@index');
//     Route::get('/peroduk', 'Pembeli\PembeliController@produk');
// });

// Route::get('/aksesKhusus', function(){
//     return view('not_sign');
// });


// Route::get('/home', 'HomeController@index');

//Route::auth();
// Route::group(['middleware' => ['auth']], function() {
// 	Route::get('/home', 'HomeController@index');
// 	Route::resource('users','UserController');
// 	Route::get('roles',['as'=>'roles.index','uses'=>'RoleController@index','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);
// 	Route::get('roles/create',['as'=>'roles.create','uses'=>'RoleController@create','middleware' => ['permission:role-create']]);
// 	Route::post('roles/create',['as'=>'roles.store','uses'=>'RoleController@store','middleware' => ['permission:role-create']]);
// 	Route::get('roles/{id}',['as'=>'roles.show','uses'=>'RoleController@show']);
// 	Route::get('roles/{id}/edit',['as'=>'roles.edit','uses'=>'RoleController@edit','middleware' => ['permission:role-edit']]);
// 	Route::patch('roles/{id}',['as'=>'roles.update','uses'=>'RoleController@update','middleware' => ['permission:role-edit']]);
// 	Route::delete('roles/{id}',['as'=>'roles.destroy','uses'=>'RoleController@destroy','middleware' => ['permission:role-delete']]);
// 	Route::get('itemCRUD2',['as'=>'itemCRUD2.index','uses'=>'ItemCRUD2Controller@index','middleware' => ['permission:item-list|item-create|item-edit|item-delete']]);
// 	Route::get('itemCRUD2/create',['as'=>'itemCRUD2.create','uses'=>'ItemCRUD2Controller@create','middleware' => ['permission:item-create']]);
// 	Route::post('itemCRUD2/create',['as'=>'itemCRUD2.store','uses'=>'ItemCRUD2Controller@store','middleware' => ['permission:item-create']]);
// 	Route::get('itemCRUD2/{id}',['as'=>'itemCRUD2.show','uses'=>'ItemCRUD2Controller@show']);
// 	Route::get('itemCRUD2/{id}/edit',['as'=>'itemCRUD2.edit','uses'=>'ItemCRUD2Controller@edit','middleware' => ['permission:item-edit']]);
// 	Route::patch('itemCRUD2/{id}',['as'=>'itemCRUD2.update','uses'=>'ItemCRUD2Controller@update','middleware' => ['permission:item-edit']]);
// 	Route::delete('itemCRUD2/{id}',['as'=>'itemCRUD2.destroy','uses'=>'ItemCRUD2Controller@destroy','middleware' => ['permission:item-delete']]);
// });
 	
//Route::get('/logout', 'Auth\LoginController@logout');