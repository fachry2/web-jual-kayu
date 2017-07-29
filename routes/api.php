<?php
header('Access-Control-Allow-Origin: *');
header( 'Access-Control-Allow-Headers: Authorization, Content-Type' );

use Illuminate\Http\Request;
use App\Transformers\UserTransformer;

Route::get('/user', function (Request $request) {
    $token  = JWTAuth::getToken();
    $user   = JWTAuth::toUser($token);

    return fractal()
        ->item($user)
        ->transformWith(new UserTransformer())
        ->toArray();
})->middleware('jwt.auth');

Route::post('/login', [
    'uses' => 'ApiJWTAuthenticate@login'
]);

Route::post('/register', [
    'uses' => 'ApiJWTAuthenticate@register'
]);

Route::get('/get_provinsi', 'getKabupaten@getDataProvinsi');