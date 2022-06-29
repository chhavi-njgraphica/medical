<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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
    return view('auth.login');
});

Route::group(['middleware' => 'guest'],function(){
    Route::view('login','backend.auth.login')->name('login');
    Route::post('login',[AuthController::class,'Login'])->name('login.post');
});

Route::group(['prefix'=>'backend'],function(){
    Route::group(['middleware'=>'auth'],function(){
        Route::view('change-password','backend.auth.change-password')->name('change-password');

        Route::post('update-password',[AuthController::class,'changePassword'])->name('update-password');

        Route::get('logout',[AuthController::class,'signOut'])->name('logout');
        Route::view('/dashboard', 'backend.dashboard')->name('dashboard');

        Route::as('language.')->prefix('language/')->group(function(){
            Route::get('/', [LanguageController::class, 'index'])->name('index');

            Route::get('create', [LanguageController::class, 'create'])->name('create');

            Route::post('store', [LanguageController::class, 'store'])->name('store');

            Route::get('edit/{language}',[LanguageController::class, 'edit'])->name('edit');

            Route::post('update/{language}', [LanguageController::class, 'update'])->name('update');

            Route::get('destroy/{language}', [LanguageController::class, 'destroy'])->name('destroy');

            Route::get('status', [LanguageController::class, 'status'])->name('status');

        });
    });    
 });

    Route::get('command/{command}', function ($command){
        if($command == 'reset'){
            \Illuminate\Support\Facades\Artisan::call('view:clear');
            $result = \Illuminate\Support\Facades\Artisan::output();
            dump($result);
    
            \Illuminate\Support\Facades\Artisan::call('route:clear');
            $result = \Illuminate\Support\Facades\Artisan::output();
            dump($result);
    
            \Illuminate\Support\Facades\Artisan::call('cache:clear');
            $result = \Illuminate\Support\Facades\Artisan::output();
            dump($result);
    
            \Illuminate\Support\Facades\Artisan::call('config:clear');
            $result = \Illuminate\Support\Facades\Artisan::output();
            dump($result);
    
            \Illuminate\Support\Facades\Artisan::call('config:cache');
            $result = \Illuminate\Support\Facades\Artisan::output();
            dump($result);
            die;
        }else{
            \Illuminate\Support\Facades\Artisan::call($command);
            $result = \Illuminate\Support\Facades\Artisan::output();
        }
        dd($result);
        
    })->name('command.run');