<?php

use App\Http\Controllers\Admin\AccountsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DonorListController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\GalleryCategoryController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ManagerController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TrustyController;
use App\Http\Controllers\Admin\UpkramController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ContactController as ControllersContactController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PagesController;
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

Route::get('/', [IndexController::class, 'index'])->name('index');


// Public Routes
Route::group(['middleware' => ['throttle:25,1']], function () {
    Route::get('welcome', [PagesController::class, 'welcome'])->name('welcome');
    Route::get('splash', [PagesController::class, 'splash'])->name('splash');
    Route::get('home', [PagesController::class, 'home'])->name('home');
    Route::get('about', [PagesController::class, 'about'])->name('about');
    Route::get('sampraday', [PagesController::class, 'sampraday'])->name('sampraday');
    Route::get('parampara', [PagesController::class, 'parampara'])->name('parampara');
    Route::get('nityasmaran', [PagesController::class, 'nityasmaran'])->name('nityasmaran');
    Route::get('gallery', [PagesController::class, 'gallery'])->name('gallery');
    Route::get('contact', [PagesController::class, 'contact'])->name('contact');
    Route::get('donation', [PagesController::class, 'donation'])->name('donation');
    Route::get('upkram-detail/{id}', [PagesController::class, 'upkramDetail'])->name('upkram-detail');
    Route::post('contact', [ControllersContactController::class, 'contactStore'])->name('contactStore');
    Route::post('donation', [DonorListController::class, 'storeFrontForm'])->name('storeFrontForm'); // add transaction details
});

//Admin Routes
Route::middleware(['auth', 'role.checker:admin', 'throttle:100,1'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::name('admin.')->group(function () {

            // Dashboard
            Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

            // Slider
            Route::name('slider.')->group(function () {
                Route::get('slider', [SliderController::class, 'index'])->name('index'); // show all slider
                Route::get('slider/create', [SliderController::class, 'create'])->name('create'); // show the add new slider
                Route::post('slider', [SliderController::class, 'store'])->name('store'); // store new slider
                Route::get('slider/edit/{id}', [SliderController::class, 'edit'])->name('edit'); // edit existing slider
                Route::patch('slider/update/{id}', [SliderController::class, 'update'])->name('update'); // update existing slider
                Route::delete('slider/delete/{id}', [SliderController::class, 'destroy'])->name('delete'); // delete existing slider
                Route::get('slider/deleted/show', [SliderController::class, 'showDeleted'])->name('deleted.show'); // delete existing slider
                Route::put('slider/deleted/restore/{id}', [SliderController::class, 'restoreDeleted'])->name('deleted.restore'); // delete existing slider
            });

            // Roles
            Route::name('roles.')->group(function () {
                Route::get('roles', [RolesController::class, 'index'])->name('index'); // show all roles
                Route::get('roles/create', [RolesController::class, 'create'])->name('create'); // show the add new roles
                Route::post('roles', [RolesController::class, 'store'])->name('store'); // store new roles
                Route::get('roles/edit/{id}', [RolesController::class, 'edit'])->name('edit'); // edit existing roles
                Route::patch('roles/update/{id}', [RolesController::class, 'update'])->name('update'); // update existing roles
                Route::delete('roles/delete/{id}', [RolesController::class, 'destroy'])->name('delete'); // delete existing roles
                Route::get('roles/deleted/show', [RolesController::class, 'showDeleted'])->name('deleted.show'); // delete existing roles
                Route::put('roles/deleted/restore/{id}', [RolesController::class, 'restoreDeleted'])->name('deleted.restore'); // delete existing roles
            });

            // Gallery Category
            Route::name('GalleryCategory.')->group(function () {
                Route::get('GalleryCategory', [GalleryCategoryController::class, 'index'])->name('index'); // show all category
                Route::get('GalleryCategory/create', [GalleryCategoryController::class, 'create'])->name('create'); // show the add new category
                Route::post('GalleryCategory', [GalleryCategoryController::class, 'store'])->name('store'); // store new category
                Route::get('GalleryCategory/edit/{id}', [GalleryCategoryController::class, 'edit'])->name('edit'); // edit existing category
                Route::patch('GalleryCategory/update/{id}', [GalleryCategoryController::class, 'update'])->name('update'); // update existing category
                Route::delete('GalleryCategory/delete/{id}', [GalleryCategoryController::class, 'destroy'])->name('delete'); // delete existing category
                Route::get('GalleryCategory/deleted/show', [GalleryCategoryController::class, 'showDeleted'])->name('deleted.show'); // delete existing category
                Route::put('GalleryCategory/deleted/restore/{id}', [GalleryCategoryController::class, 'restoreDeleted'])->name('deleted.restore'); // delete existing category
            });

            // Account
            Route::name('accounts.')->group(function () {
                Route::get('accounts', [AccountsController::class, 'index'])->name('index'); // show all Accounts
                Route::get('accounts/create', [AccountsController::class, 'create'])->name('create'); // show the add new Accounts
                Route::post('accounts', [AccountsController::class, 'store'])->name('store')->middleware('decrypt.payload'); // store new Accounts
                Route::get('accounts/edit/{id}', [AccountsController::class, 'edit'])->name('edit'); // edit existing Accounts
                Route::patch('accounts/update/{id}', [AccountsController::class, 'update'])->name('update')->middleware('decrypt.payload'); // update existing Accounts
                Route::delete('accounts/delete/{id}', [AccountsController::class, 'destroy'])->name('delete'); // delete existing Accounts
                Route::get('accounts/deleted/show', [AccountsController::class, 'showDeleted'])->name('deleted.show'); // delete existing Accounts
                Route::put('accounts/deleted/restore/{id}', [AccountsController::class, 'restoreDeleted'])->name('deleted.restore'); // delete existing Accounts
            });

            // upkram
            Route::name('upkram.')->group(function () {
                Route::get('upkram', [UpkramController::class, 'index'])->name('index'); // show all upkram
                Route::get('upkram/create', [UpkramController::class, 'create'])->name('create'); // show the add new upkram
                Route::post('upkram', [UpkramController::class, 'store'])->name('store'); // store new upkram
                Route::get('upkram/edit/{id}', [UpkramController::class, 'edit'])->name('edit'); // edit existing upkram
                Route::patch('upkram/update/{id}', [UpkramController::class, 'update'])->name('update'); // update existing upkram
                Route::delete('upkram/delete/{id}', [UpkramController::class, 'destroy'])->name('delete'); // delete existing upkram
                Route::get('upkram/deleted/show', [UpkramController::class, 'showDeleted'])->name('deleted.show'); // delete existing upkram
                Route::put('upkram/deleted/restore/{id}', [UpkramController::class, 'restoreDeleted'])->name('deleted.restore'); // delete existing upkram
            });

            // Gallery
            Route::name('gallery.')->group(function () {
                Route::get('gallery', [GalleryController::class, 'index'])->name('index'); // show all gallery
                Route::get('gallery/create', [GalleryController::class, 'create'])->name('create'); // show the add new gallery
                Route::post('gallery/upload', [GalleryController::class, 'imageUpload'])->name('upload'); // store new gallery
                Route::post('gallery', [GalleryController::class, 'store'])->name('store'); // store new gallery
                Route::delete('gallery/delete/{id}', [GalleryController::class, 'destroy'])->name('delete'); // delete existing gallery
                Route::get('gallery/deleted/show', [GalleryController::class, 'showDeleted'])->name('deleted.show'); // delete existing gallery
                Route::put('gallery/deleted/restore/{id}', [GalleryController::class, 'restoreDeleted'])->name('deleted.restore'); // delete existing gallery
            });

            // Trusty
            Route::name('trusty.')->group(function () {
                Route::get('trusty', [TrustyController::class, 'index'])->name('index'); // show all Trusty
                Route::get('trusty/create', [TrustyController::class, 'create'])->name('create'); // show the add new Trusty
                Route::post('trusty', [TrustyController::class, 'store'])->name('store'); // store new Trusty
                Route::get('trusty/edit/{id}', [TrustyController::class, 'edit'])->name('edit'); // edit existing Trusty
                Route::patch('trusty/update/{id}', [TrustyController::class, 'update'])->name('update'); // update existing Trusty
                Route::delete('trusty/delete/{id}', [TrustyController::class, 'destroy'])->name('delete'); // delete existing Trusty
                Route::get('trusty/deleted/show', [TrustyController::class, 'showDeleted'])->name('deleted.show'); // delete existing Trusty
                Route::put('trusty/deleted/restore/{id}', [TrustyController::class, 'restoreDeleted'])->name('deleted.restore'); // delete existing Trusty
            });

            // Manager
            Route::name('manager.')->group(function () {
                Route::get('manager', [ManagerController::class, 'index'])->name('index'); // show all Manager
                Route::get('manager/create', [ManagerController::class, 'create'])->name('create'); // show the add new Manager
                Route::post('manager', [ManagerController::class, 'store'])->name('store'); // store new Manager
                Route::get('manager/edit/{id}', [ManagerController::class, 'edit'])->name('edit'); // edit existing Manager
                Route::patch('manager/update/{id}', [ManagerController::class, 'update'])->name('update'); // update existing Manager
                Route::delete('manager/delete/{id}', [ManagerController::class, 'destroy'])->name('delete'); // delete existing Manager
                Route::get('manager/deleted/show', [ManagerController::class, 'showDeleted'])->name('deleted.show'); // delete existing Manager
                Route::put('manager/deleted/restore/{id}', [ManagerController::class, 'restoreDeleted'])->name('deleted.restore'); // delete existing Manager
            });

            // Feedback
            Route::name('feedback.')->group(function () {
                Route::get('feedback', [FeedbackController::class, 'index'])->name('index'); // show all feedback
            });

            // DonorList
            Route::name('donorList.')->group(function () {
                Route::get('donorList', [DonorListController::class, 'index'])->name('index'); // show all DonorList
                Route::post('donorList/import', [DonorListController::class, 'import'])->name('import'); // import donors from excel/csv
                Route::get('donorList/import/template', [DonorListController::class, 'importTemplate'])->name('import.template'); // sample sheet
                Route::get('donorList/create', [DonorListController::class, 'create'])->name('create'); // show the add new DonorList
                Route::post('donorList', [DonorListController::class, 'store'])->name('store'); // store new DonorList
                Route::get('donorList/edit/{id}', [DonorListController::class, 'edit'])->name('edit'); // edit existing DonorList
                Route::patch('donorList/update/{id}', [DonorListController::class, 'update'])->name('update'); // update existing DonorList
                Route::delete('donorList/delete/{id}', [DonorListController::class, 'destroy'])->name('delete'); // delete existing DonorList
                Route::get('donorList/deleted/show', [DonorListController::class, 'showDeleted'])->name('deleted.show'); // delete existing DonorList
                Route::put('donorList/deleted/restore/{id}', [DonorListController::class, 'restoreDeleted'])->name('deleted.restore'); // delete existing DonorList
            });
        });
    });
});

//Auth Routes
Route::group(
    ['middleware' => ['throttle:25,1']],
    function () {
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [LoginController::class, 'login'])->name('login')->middleware('decrypt.payload');
    }
);

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('index');
})->name('logout');
