<?php

use Illuminate\Support\Facades\Route;

//
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ForgetController;

//

use App\Http\Controllers\ShopController;

//
use App\Http\Controllers\admin\MainController;
use App\Http\Controllers\admin\dausach\DausachController;

//
use App\Http\Controllers\admin\phieumuon\PhieumuonsachController;
use App\Http\Controllers\admin\phieumuon\PhieutrasachController;
use App\Http\Controllers\admin\phieumuon\PhieuphatController;

//
use App\Http\Controllers\admin\TheloaiController;
use App\Http\Controllers\admin\TacgiaController;
use App\Http\Controllers\admin\NhaxuatbanController;
use App\Http\Controllers\admin\DocgiaController;
use App\Http\Controllers\admin\VitriController;

//
use App\Http\Controllers\CreateController;
use App\Http\Controllers\OnlineCheckoutController;
use App\Http\Controllers\admin\hoadon\HoadonController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});

/* Login - Logout - Signup - Forget Password */
// Login
Route::get('/login', [LoginController::class,'index'])->name('login');
Route::post('/login/store',[LoginController::class,'store'])->name('login.store');
// Register
Route::get('/signup', [SignupController::class,'index'])->name('signup');
Route::post('/signup/store',[SignupController::class,'store'])->name('signup.store');
// Forget
Route::get('/forget', [ForgetController::class,'view'])->name('forget');
Route::post('/forget/store',[ForgetController::class,'store'])->name('forget.store');
// Logout
Route::get('/logout',[LogoutController::class,'logout'])->name('logout');
/* /End */

// Shop
Route::get('/shop', [ShopController::class,'index'])->name('shop');
Route::get('/home', [ShopController::class,'index'])->name('home');
Route::get('/home/{id}', [ShopController::class,'index'])->name('home.detail');

//
Route::post('/checkout',[OnlineCheckoutController::class,'onlineCheckout'])->name('checkout');

Route::get('/checkout/thanks',[HoadonController::class,'store'])->name('thank.store');
 			 	 
// --------------------------------------------------------------------------------------------------- //
//
Route::group(['prefix' => 'laravel-filemanager'], function () {
   \UniSharp\LaravelFilemanager\Lfm::routes();
});

//
Route::get('/filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
// --------------------------------------------------------------------------------------------------- //

//
Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/',[MainController::class,'view'])->name('admin.main');

        // Quan Ly Phieu Muon
        Route::prefix('phieumuon')->group(function () {
            // List - Danh Sach
            Route::get('/', [PhieumuonsachController::class,'list'])->name('phieumuon.list');

            // Lấy Thông Tin Độc Giả
            Route::post('/getInfoReader', [PhieumuonsachController::class, 'getInfoReader'])
                ->name('phieumuon.getInfoReader');

            // Lấy Thông Tin Đầu Sách
            Route::post('/getInfoBook', [PhieumuonsachController::class, 'getInfoBook'])
                ->name('phieumuon.save');
            Route::post('/savelist', [PhieumuonsachController::class, 'saveList'])
                ->name('phieumuon.saveList');

            // Create - Lap Phieu
            Route::get('/lapphieu', [PhieumuonsachController::class,'create'])
                ->name( 'phieumuon.create');
            Route::post('/lapphieu/store', [PhieumuonsachController::class,'store'])
                ->name( 'phieumuon.store');

            // Read - Xem Phieu
            Route::get('/view/{id}', [PhieumuonsachController::class,'view'])
                ->name('phieumuon.view');

            // Renew - Gia Han
            Route::post('/renewBook', [PhieumuonsachController::class,'renewBook'])
                ->name('phieumuon.renew');

            Route::post('/renewal', [PhieumuonsachController::class, 'getLatestRenewalInfo'])
                ->name('renewal.info');

            Route::post('/borrowDetails', [PhieumuonsachController::class, 'getBookBorrowDetails'])
                ->name('borrow.details');

            // Return - Tra sach
            Route::get('/trasach/{maphieu}', [PhieumuonsachController::class,'return'])
                ->name('phieumuon.return');
        });

        // Quan Lý Phieu Tra
        Route::prefix('phieutra')->group(function () {
            // List - Danh Sach
            Route::get('/', [PhieutrasachController::class,'list'])->name('phieutra.list');

            // Create - Lap phieu tra
            Route::get('/lapphieutra', [PhieutrasachController::class,'create'])->name('phieutra');
            Route::post('/lapphieutra/store', [PhieutrasachController::class,'store'])->name('phieutra.store');
            //
            Route::post('/lapphieu/infoDetail', [PhieutrasachController::class,'getInfo'])->name('phieutra.info');

            // Read - Xem chi tiet returnAll
            Route::get('/{id}', [PhieutrasachController::class,'view'])->name('phieutra.view');
            // Cập Nhật Trạng Thái
            Route::post('/{id}/updateStatus', [PhieutrasachController::class,'updateStatus'])->name('phieutra.updateStatus');
            //
            Route::post('/{id}', [PhieutrasachController::class,'return'])->name('phieutra.return');
            //
            Route::post('/returnAll', [PhieutrasachController::class,'returnAll'])->name('phieutra.returnAll');

        });

        // Quan Ly Phieu Phat
        Route::prefix('phieuphat')->group(function () {
            Route::get('/', [PhieuphatController::class,'list'])->name('phieuphat.list');
            Route::get('/lapphieu', [PhieuphatController::class,'create'])->name('phieuphat');
            Route::post('/lapphieu/store', [PhieuphatController::class,'store'])->name('phieuphat.store');
            //
            Route::get('/{id}', [PhieuphatController::class,'view'])->name('phieuphat.view');
        });

        // Quan Ly Dau Sach
        Route::prefix('dausach')->group(function () {
            Route::get('/', [DausachController::class,'list'])->name('dausach');
            Route::get('/add', [DausachController::class,'add'])->name('dausach.add');
            Route::post('/add/store', [DausachController::class,'store'])->name('dausach.store');
            Route::get('/view/{id}', [DausachController::class,'detail'])->name('dausach.detail');
            Route::get('/edit/{id}', [DausachController::class,'edit'])->name('dausach.edit');
            Route::post('/edit/{id}', [DausachController::class,'postedit'])->name('dausach.postedit');
            //
            Route::get('/active/{id}', [DausachController::class,'active'])->name('dausach.active');
            Route::get('/inactive/{id}', [DausachController::class,'inactive'])->name('dausach.inactive');
            //
            Route::get('/delete/{id}', [DausachController::class,'delete'])->name('dausach.delete');
        });

        // Quan Ly Doc Gia
        Route::prefix('docgia')->group(function () {
            Route::get('/', [DocgiaController::class,'list'])->name('docgia');
            Route::get('/add', [DocgiaController::class,'add'])->name('docgia.add');
            Route::post('/add/store', [DocgiaController::class,'store'])->name('docgia.store');
            Route::get('/view/{id}', [DocgiaController::class,'detail'])->name('docgia.detail');
            Route::get('/edit/{id}', [DocgiaController::class,'edit'])->name('docgia.edit');
            Route::post('/edit/{id}', [DocgiaController::class,'postedit'])->name('docgia.postedit');
            Route::get('/delete/{id}', [DocgiaController::class,'delete'])->name('docgia.delete');
        });

        // Quan Ly The Loai Sach
        Route::prefix('theloai')->group(function () {
            Route::get('/', [TheloaiController::class,'list'])->name('theloai');
            Route::get('/add', [TheloaiController::class,'add'])->name('theloai.add');
            Route::post('/add/store', [TheloaiController::class,'store'])->name('theloai.store');
            Route::get('/view/{id}', [TheloaiController::class,'view'])->name('theloai.detail');
            Route::get('/edit/{id}', [TheloaiController::class,'edit'])->name('theloai.edit');
            Route::post('/edit/{id}', [TheloaiController::class,'postedit'])->name('theloai.postedit');
            Route::get('/delete/{id}', [TheloaiController::class,'delete'])->name('theloai.delete');
        });

        // Quan Ly Tac Gia
        Route::prefix('tacgia')->group(function () {
            Route::get('/', [TacgiaController::class,'list'])->name('tacgia');
            Route::get('/add', [TacgiaController::class,'add'])->name('tacgia.add');
            Route::post('/add/store', [TacgiaController::class,'store'])->name('tacgia.store');
            Route::get('/view/{id}', [TacgiaController::class,'view'])->name('tacgia.detail');
            Route::get('/edit/{id}', [TacgiaController::class,'edit'])->name('tacgia.edit');
            Route::post('/edit/{id}', [TacgiaController::class,'postedit'])->name('tacgia.postedit');
            Route::get('/delete/{id}', [TacgiaController::class,'delete'])->name('tacgia.delete');
        });

        // Quan Ly Nha Xuat Ban
        Route::prefix('nhaxuatban')->group(function () {
            Route::get('/', [NhaxuatbanController::class,'list'])->name('nhaxuatban');
            Route::get('/add', [NhaxuatbanController::class,'add'])->name('nhaxuatban.add');
            Route::post('/add/store', [NhaxuatbanController::class,'store'])->name('nhaxuatban.store');
            Route::get('/view/{id}', [NhaxuatbanController::class,'view'])->name('nhaxuatban.detail');
            Route::get('/edit/{id}', [NhaxuatbanController::class,'edit'])->name('nhaxuatban.edit');
            Route::post('/edit/{id}', [NhaxuatbanController::class,'postedit'])->name('nhaxuatban.postedit');
            Route::get('/delete/{id}', [NhaxuatbanController::class,'delete'])->name('nhaxuatban.delete');
        });

        // Quan Ly Vi Tri
        Route::prefix('vitri')->group(function () {
            Route::get('/', [VitriController::class,'list'])->name('vitri');
            Route::get('/add', [VitriController::class,'add'])->name('vitri.add');
            Route::post('/add/store', [VitriController::class,'store'])->name('vitri.store');
            Route::get('/view/{id}', [VitriController::class,'view'])->name('vitri.detail');
            Route::get('/edit/{id}', [VitriController::class,'edit'])->name('vitri.edit');
            Route::post('/edit/{id}', [VitriController::class,'postedit'])->name('vitri.postedit');
            Route::get('/delete/{id}', [VitriController::class,'delete'])->name('vitri.delete');
        });
    });
});

