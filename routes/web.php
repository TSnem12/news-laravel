<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\DistrictController;
use App\Http\Controllers\Backend\SubdistrictController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\GalleryController;

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
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
});

Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');

//All Categories Routes
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/add/category', [CategoryController::class, 'create'])->name('add.category');
Route::post('/store/category', [CategoryController::class, 'store'])->name('store.category');
Route::get('/edit/category/{id}', [CategoryController::class, 'edit'])->name('edit.category');
Route::post('/update/category/{id}', [CategoryController::class, 'update'])->name('update.category');
Route::get('/delete/category/{id}', [CategoryController::class, 'destroy'])->name('delete.category');

//All SubCategories Routes
Route::get('/subcategories', [SubCategoryController::class, 'index'])->name('subcategories');
Route::get('/add/subcategory', [SubCategoryController::class, 'create'])->name('add.subcategory');
Route::post('/store/subcategory', [SubCategoryController::class, 'store'])->name('store.subcategory');
Route::get('/edit/subcategory/{id}', [SubCategoryController::class, 'edit'])->name('edit.subcategory');
Route::post('/update/subcategory/{id}', [SubCategoryController::class, 'update'])->name('update.subcategory');
Route::get('/delete/subcategory/{id}', [SubCategoryController::class, 'delete'])->name('delete.subcategory');


//All District Routes
Route::get('/districts', [DistrictController::class, 'index'])->name('districts');
Route::get('/add/district', [DistrictController::class, 'create'])->name('add.district');
Route::post('/store/district', [DistrictController::class, 'store'])->name('store.district');
Route::get('/edit/district/{id}', [DistrictController::class, 'edit'])->name('edit.district');
Route::post('/update/district/{id}', [DistrictController::class, 'update'])->name('update.district');
Route::get('/delete/district/{id}', [DistrictController::class, 'delete'])->name('delete.district');

//All SubDistrict Routes
Route::get('/subdistricts', [SubDistrictController::class, 'index'])->name('subdistricts');
Route::get('/add/subdistrict', [SubDistrictController::class, 'create'])->name('add.subdistrict');
Route::post('/store/subdistrict', [SubDistrictController::class, 'store'])->name('store.subdistrict');
Route::get('/edit/subdistrict/{id}', [SubDistrictController::class, 'edit'])->name('edit.subdistrict');
Route::post('/update/subdistrict/{id}', [SubDistrictController::class, 'update'])->name('update.subdistrict');
Route::get('/delete/subdistrict/{id}', [SubDistrictController::class, 'destroy'])->name('delete.subdistrict');


// Json Data for Category and District
Route::get('/get/subcategory/{category_id}', [PostController::class, 'getSubCategory']);
Route::get('/get/subdistrict/{district_id}', [PostController::class, 'getSubDistrict']);


//All Posts Routes
Route::get('/posts', [PostController::class, 'index'])->name('posts');
Route::get('/add/post', [PostController::class, 'create'])->name('add.post');
Route::post('/store/post', [PostController::class, 'store'])->name('store.post');
Route::get('/edit/post/{id}', [PostController::class, 'edit'])->name('edit.post');
Route::post('/update/post/{id}', [PostController::class, 'update'])->name('update.post');
Route::get('/delete/post/{id}', [PostController::class, 'delete'])->name('delete.post');


// Settings Routes
Route::get('/social/setting/', [SettingController::class, 'SocialSetting'])->name('social.setting');
Route::post('/update/social/{id}', [SettingController::class, 'UpdateSocial'])->name('update.social');

Route::get('/seo/setting/', [SettingController::class, 'SeoSetting'])->name('seo.setting');
Route::post('/update/seo/{id}', [SettingController::class, 'UpdateSeo'])->name('update.seo');

Route::get('/prayer/setting/', [SettingController::class, 'PrayerSetting'])->name('prayer.setting');
Route::post('/update/prayer/{id}', [SettingController::class, 'UpdatePrayer'])->name('update.prayer');

Route::get('/livetv/setting/', [SettingController::class, 'LivetvSetting'])->name('livetv.setting');
Route::post('/update/livetv/{id}', [SettingController::class, 'UpdateLivetv'])->name('update.livetv');
Route::get('/active/livetv/{id}', [SettingController::class, 'ActiveLivetv'])->name('active.livetv');
Route::get('/deactive/livetv/{id}', [SettingController::class, 'DeActiveLivetv'])->name('deactive.livetv');

Route::get('/notice/setting/', [SettingController::class, 'NoticeSetting'])->name('notice.setting');
Route::post('/update/notice/{id}', [SettingController::class, 'UpdateNotice'])->name('update.notice');
Route::get('/active/notice/{id}', [SettingController::class, 'ActiveNotice'])->name('active.notice');
Route::get('/deactive/notice/{id}', [SettingController::class, 'DeActiveNotice'])->name('deactive.notice');

Route::get('/website/setting', [SettingController::class, 'WebsiteSetting'])->name('all.website');
Route::get('/add/website', [SettingController::class, 'AddWebsiteSetting'])->name('add.website');
Route::post('/store/website', [SettingController::class, 'StoreWebsite'])->name('store.website');
Route::get('/edit/website/{id}', [SettingController::class, 'EditWebsite'])->name('edit.website');
Route::post('/update/website/{id}', [SettingController::class, 'UpdateWebsite'])->name('update.website');
Route::get('/delete/website/{id}', [SettingController::class, 'DeleteWebsite'])->name('delete.website');


// All Photos Gallery Routes 
Route::get('/photo/gallery', [GalleryController::class, 'PhotoGallery'])->name('photo.gallery');
Route::get('/add/photo', [GalleryController::class, 'AddPhoto'])->name('add.photo');
Route::post('/store/photo', [GalleryController::class, 'StorePhoto'])->name('store.photo');
Route::get('/edit/photo/{id}', [GalleryController::class, 'EditPhoto'])->name('edit.photo');
Route::post('/update/photo/{id}', [GalleryController::class, 'UpdatePhoto'])->name('update.photo');
Route::get('/delete/photo/{id}', [GalleryController::class, 'DeletePhoto'])->name('delete.photo');

Route::get('/video/gallery', [GalleryController::class, 'VideoGallery'])->name('video.gallery');
Route::get('/add/video', [GalleryController::class, 'AddVideo'])->name('add.video');
Route::post('/store/video', [GalleryController::class, 'StoreVideo'])->name('store.video');
Route::get('/edit/video/{id}', [GalleryController::class, 'EditVideo'])->name('edit.video');
Route::post('/update/video/{id}', [GalleryController::class, 'UpdateVideo'])->name('update.video');
Route::get('/delete/video/{id}', [GalleryController::class, 'DeleteVideo'])->name('delete.video');
