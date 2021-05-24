<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BrandContorller;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\CategoryController as ControllersCategoryController;
use App\Http\Controllers\ChangePass;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use App\Models\About;
use App\Models\Multipic;
use Illuminate\Support\Facades\DB;
use App\Models\User;

/**
 * @WEBPAGE Verify Email
 * GET/email/verify -> Route to get verify email page
 * 
 */
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

/**
 * @WEBPAGE WELCOME
 * GET/ -> Router to index page
 * 
 */
Route::get('/', function () {
    $brands = DB::table('brands')->get();
    $about = About::first();
    $multipics = Multipic::all();
    return view('home', compact('brands', 'about', 'multipics'));
})->name('home.page');

/**
 * @WEBPAGE HOME
 * GET/home -> Router send data echo
 * 
 */
Route::get('/home', function () {
    echo 'This is the homepage';
});

/**
 * @WEBPAGE ABOUT
 * GET/about -> Router to contact page
 * 
 */
Route::get('/about', function () {
    return view('about');
});

/**
 * @WEBPAGE CONTACT
 * GET/contact -> Router to contact page
 * POST/contact/form -> Router to add data message to database
 * 
 */
Route::get('/contact', [ContactController::class, 'index']) -> name('contact');
Route::post('/contact/form', [ContactController::class, 'contactForm']) -> name('contact.form');

/**
 * @WEBPAGE CONTACT ADMIN PAGE
 * GET/admin/contact -> Router to contact admin page
 * GET/admin/add/contact -> Router to contact admin page
 * POST/admin/create/contact -> Router to add contact admin data to database
 * GET/admin/update/contact/{id} -> Router to contact update admin
 * POST/admin/update/contact/{id} -> Router to update contact admin data to database
 * GET/admin/delete/contact/{id} -> Router to delete contact data from database
 * 
 */
Route::get('/admin/contact', [ContactController::class, 'adminIndex']) -> name('admin.contact')->middleware('auth');
Route::get('/admin/add/contact', [ContactController::class, 'addContact']) -> name('add.contact')->middleware('auth');
Route::post('/admin/create/contact', [ContactController::class, 'createContact']) -> name('create.contact')->middleware('auth');
Route::get('/admin/update/contact/{id}', [ContactController::class, 'updateContact'])->middleware('auth');
Route::post('/admin/create/contact/{id}', [ContactController::class, 'editContact'])->middleware('auth');
Route::get('/admin/delete/contact/{id}', [ContactController::class, 'deleteContact'])->middleware('auth');
Route::get('/admin/contact/message', [ContactController::class, 'messageContact'])->name('admin.message')->middleware('auth');

/**
 * @WEBPAGE CATEGORY
 * GET/category/all -> Router To Index category page
 * POST/category/add -> Router to add data category
 * GET/category/update/{id} -> Router to get update page by 1 data
 * POST/category/edit/{id} -> Router to update data category by 1 data
 * GET/softdelete/delete/{id} -> Router to delete data but not actually delete
 * GET/category/restore/{id} -> Router to restore data from softdelete(trash)
 * GET/permanentDelete/delete/{id} -> Router to permanently deleted data from database
 * 
 */
Route::get('/category/all', [categoryController::class, 'allCat']) -> name('all.category');
Route::post('/category/add', [categoryController::class, 'addCat']) -> name('store.category');
Route::get('/category/update/{id}', [categoryController::class, 'updateCat']);
Route::post('/category/edit/{id}', [categoryController::class, 'editCat']);
Route::get('/softdelete/delete/{id}', [categoryController::class, 'deleteCat']);
Route::get('/category/restore/{id}', [categoryController::class, 'restoreCat']);
Route::get('/permanentDelete/delete/{id}', [categoryController::class, 'deletePermanentCat']);

/**
 * @WEBPAGE BRANDS
 * GET/brands/all -> Router to index brand page
 * POST/brands/add -> Router to fill data brand to database
 * GET/brands/update/{id} -> Router to edit page by id
 * POST/brands/edit/{id} -> Router to update data brand to database
 * GET/brands/delete/{id} -> Router to delete data brand from database
 * 
 */
Route::get('/brands/all', [BrandController::class, 'allBrand']) -> name('all.brands');
Route::post('/brands/add', [BrandController::class, 'storeBrand']) -> name('store.brand');
Route::get('/brand/update/{id}', [BrandController::class, 'updateBrand']);
Route::post('/brand/edit/{id}', [BrandController::class, 'editBrand']);
Route::get('/brand/delete/{id}', [BrandController::class, 'deleteBrand']);

/**
 * @WEBPAGE MULTIPIC
 * GET/multi/image -> Router to index multi Pic Page
 * Post/
 * 
 */
Route::get('/multi/image', [BrandController::class, 'multiPic']) -> name('multi.pic');
Route::post('/multi/add', [BrandController::class, 'storePic']) -> name('store.pic');

/**
 * @WEBPAGE SLIDER
 * GET/home/slider -> Router to slider page with auth
 * GET/add/slider -> Router to add slider page
 * POST/create/slider -> Router to put slider to home slider
 * GET/update/slider/{id} -> Router to slider update page by id
 * POST/update/slider/{id} -> Router to update slider data by id
 * GET/delete/slider/{id} -> Router to delete slider data by id
 * 
 */
Route::get('/home/slider', [HomeController::class, 'homeSlider']) -> name('home.slider');
Route::get('/add/slider', [HomeController::class, 'addSlider']) -> name('add.slider');
Route::post('/create/slider', [HomeController::class, 'createSlider']) -> name('create.slider');
Route::get('/update/slider/{id}', [HomeController::class, 'updateSlider']);
Route::post('/edit/slider/{id}', [HomeController::class, 'editSlider']);
Route::get('/delete/slider/{id}', [HomeController::class, 'deleteSlider']);


/**
 * @WEBPAGE HOME PORFOLIO
 * 
 */
Route::get('/portfolio', [HomeController::class, 'portfolio'])->name('portfolio.home');

/**
 * @WEBPAGE SLIDER
 * GET/home/about -> Router to  page with auth
 * GET/add/about -> Router to add  page
 * POST/create/ -> Router to put  to home 
 * GET/update/{id} -> Router to  update page by id
 * POST/update/{id} -> Router to update  data by id
 * GET/delete/{id} -> Router to delete  data by id
 * 
 */
Route::get('/home/about', [AboutController::class, 'homeAbout']) -> name('home.about');
Route::get('/add/about', [AboutController::class, 'addAbout']) -> name('add.about');
Route::post('/create/about', [AboutController::class, 'createAbout']) -> name('create.about');
Route::get('/update/about/{id}', [AboutController::class, 'updateAbout']);
Route::post('/edit/about/{id}', [AboutController::class, 'editAbout']);
Route::get('/delete/about/{id}', [AboutController::class, 'deleteAbout']);

/**
 * @WEBPAGE DASHBOARD
 * GET/dashboard -> Router to dashboard page with auth
 * 
 */
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

    // $users = User::all();
    return view('admin.index');
})->name('dashboard');

/**
 * @WEBPAGE CHANGE PASSWORD
 * GET/logout -> Router to change password page with auth
 * 
 */
Route::get('/admin/change-password', [ChangePass::class, 'changePassword']) -> name('change.password');
Route::post('/admin/change-password/update', [ChangePass::class, 'updatePassword']) -> name('password.update');

/**
 * @WEBPAGE CHANGE PASSWORD
 * GET/logout -> Router to change password page with auth
 * 
 */
Route::get('/admin/user-profile', [ChangePass::class, 'updateProfile']) -> name('change.profile');
Route::post('/admin/user-profile/update', [ChangePass::class, 'changeProfile']) -> name('profile.update');



/**
 * @WEBPAGE DASHBOARD
 * GET/logout -> Router to login page with auth
 * 
 */
Route::get('/logout', [LogoutController::class, 'logout']) -> name('logout');
