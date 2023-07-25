<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LangueController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\DiplomeController;
use App\Http\Controllers\LoisireController;
use App\Http\Controllers\MatiereController;

use App\Http\Controllers\StorageController;
use App\Http\Controllers\QualitesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompetenceController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ProfilLangueController;
use App\Http\Controllers\SecteurSpectController;
use App\Http\Controllers\TacheController;
use App\Http\Controllers\TechniqueController;

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
    return view('index');
})->name('dashboard');


Route::name('users.')->prefix('users')->controller(UserController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('{id}/delete', 'destroy')->name('delete');
        Route::get('{id}/show', 'show')->name('show');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::post('{id}/update', 'update')->name('update');
        Route::post('delete', 'destroyGroup')->name('destroyGroup');
    });





//-------------------------------------------------------------------------------------------

Route::name('profils.')->prefix('profils')->controller(ProfilController::class)
->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('{id}/delete', 'destroy')->name('delete');
    Route::get('{id}/show', 'show')->name('show');
    Route::get('create', 'create')->name('create');
    Route::post('store', 'store')->name('store');
    Route::post('{id}/update', 'update')->name('update');
    Route::post('delete', 'destroyGroup')->name('destroyGroup');
});

Route::name('loisirs.')->prefix('profils/')->controller(LoisireController::class)
    ->group(function () {
        Route::get('{profileId}/loisirs/', 'index')->name('index');
        Route::get('loisirs/{id}/delete', 'destroy')->name('delete');
        Route::get('loisirs/{id}/show', 'show')->name('show');
        Route::post('loisirs/{id}/update', 'update')->name('update');
        Route::get('{profileId}/loisirs/create', 'create')->name('create');
        Route::post('/loisirs/store', 'store')->name('store');
        Route::post('loisirs/delete', 'destroyGroup')->name('destroyGroup');
    });
Route::name('experiences.')->prefix('profils/')->controller(ExperienceController::class)
    ->group(function () {
        Route::get('{profileId}/experiences/', 'index')->name('index');
        Route::get('experiences/{id}/delete', 'destroy')->name('delete');
        Route::get('experiences/{id}/show', 'show')->name('show');
        Route::post('experiences/{id}/update', 'update')->name('update');
        Route::get('{profileId}/experiences/create', 'create')->name('create');
        Route::post('/experiences/store', 'store')->name('store');
        Route::post('experiences/delete', 'destroyGroup')->name('destroyGroup');
        Route::get('experiences/download', 'download')->name('download');
    });
    Route::name('taches.')->prefix('profils/')->controller(TacheController::class)
    ->group(function () {
        Route::get('{profileId}/taches/', 'index')->name('index');
        Route::get('taches/{id}/delete', 'destroy')->name('delete');
        Route::get('taches/{id}/show', 'show')->name('show');
        Route::post('taches/{id}/update', 'update')->name('update');
        Route::get('{profileId}/taches/create', 'create')->name('create');
        Route::post('/taches/store', 'store')->name('store');
        Route::post('taches/delete', 'destroyGroup')->name('destroyGroup');
    });
    Route::name('techniques.')->prefix('profils/')->controller(TechniqueController::class)
    ->group(function () {
        Route::get('{profileId}/techniques/', 'index')->name('index');
        Route::get('techniques/{id}/delete', 'destroy')->name('delete');
        Route::get('techniques/{id}/show', 'show')->name('show');
        Route::post('techniques/{id}/update', 'update')->name('update');
        Route::get('{profileId}/techniques/create', 'create')->name('create');
        Route::post('/techniques/store', 'store')->name('store');
        Route::post('techniques/delete', 'destroyGroup')->name('destroyGroup');
    });
    Route::name('diplomes.')->prefix('profils/')->controller(DiplomeController::class)
    ->group(function () {
        Route::get('{profileId}/diplomes/', 'index')->name('index');
        Route::get('diplomes/{id}/delete', 'destroy')->name('delete');
        Route::get('diplomes/{id}/show', 'show')->name('show');
        Route::post('diplomes/{id}/update', 'update')->name('update');
        Route::get('{profileId}/diplomes/create', 'create')->name('create');
        Route::post('/diplomes/store', 'store')->name('store');
        Route::post('diplomes/delete', 'destroyGroup')->name('destroyGroup');
        Route::get('diplomes/download', 'download')->name('download');
    });
Route::name('qualites.')->prefix('profils/')->controller(QualitesController::class)
    ->group(function () {
        Route::get('{profileId}/qualites/', 'index')->name('index');
        Route::get('qualites/{id}/delete', 'destroy')->name('delete');
        Route::get('qualites/{id}/show', 'show')->name('show');
        Route::post('qualites/{id}/update', 'update')->name('update');
        Route::get('{profileId}/qualites/create', 'create')->name('create');
        Route::post('/qualites/store', 'store')->name('store');
        Route::post('qualites/delete', 'destroyGroup')->name('destroyGroup');
    });
Route::name('competences.')->prefix('profils/')->controller(CompetenceController::class)
    ->group(function () {
        Route::get('{profileId}/competences/', 'index')->name('index');
        Route::get('competences/{id}/delete', 'destroy')->name('delete');
        Route::get('competences/{id}/show', 'show')->name('show');
        Route::post('competences/{id}/update', 'update')->name('update');
        Route::get('{profileId}/competences/create', 'create')->name('create');
        Route::post('/competences/store', 'store')->name('store');
        Route::post('competences/delete', 'destroyGroup')->name('destroyGroup');
    });
    
Route::name('profilLangues.')->prefix('profils/')->controller(ProfilLangueController::class)
    ->group(function () {
        Route::get('{profileId}/profilLangues/', 'index')->name('index');
        Route::get('profilLangues/{id}/delete', 'destroy')->name('delete');
        Route::get('profilLangues/{id}/show', 'show')->name('show');
        Route::post('profilLangues/{id}/update', 'update')->name('update');
        Route::get('{profileId}/profilLangues/create', 'create')->name('create');
        Route::post('/profilLangues/store', 'store')->name('store');
        Route::post('profilLangues/delete', 'destroyGroup')->name('destroyGroup');
    });
    
    
    
// =======================================
Route::name('secteursspects.')->prefix('profils/secteursspects')->controller(SecteurSpectController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('{id}/delete', 'destroy')->name('delete');
        Route::get('{id}/show', 'show')->name('show');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::post('{id}/update', 'update')->name('update');
        Route::post('delete', 'destroyGroup')->name('destroyGroup');
    });


    Route::name('langues.')->prefix('profils/langues')->controller(LangueController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('{id}/delete', 'destroy')->name('delete');
        Route::get('{id}/show', 'show')->name('show');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::post('{id}/update', 'update')->name('update');
        Route::post('delete', 'destroyGroup')->name('destroyGroup');
    });

   





    
//-------------------------------------------------------------------------------------------

































Route::group(['prefix' => 'admins'], function () {
    Route::get('', [AdminController::class, 'index'])
        ->name('admins');
    Route::get('delete/{id}', [AdminController::class, 'delete'])
        ->name('admin.delete');
    Route::get('create', [AdminController::class, 'create'])
        ->name('admin.create');
    Route::post('store', [AdminController::class, 'store'])
        ->name('admin.store');
    Route::get('/{id}/get', [AdminController::class, 'show'])
        ->name('admin.show');
    Route::post('update/{id}', [AdminController::class, 'update'])
        ->name('admin.update');
    Route::get('status/{id}/{status}', [AdminController::class, 'status'])
        ->name('admin.change.status');
    Route::get('rule/{id}/{rule}', [AdminController::class, 'rule'])
        ->name('admin.change.rule');
});


Route::get('language/{locale}', function ($locale = 'fr') {
    Session::put('locale', $locale);
    return back();
})->name('setLang');





Route::get('file/{file?}', [StorageController::class, 'public'])
    ->where('file', '.*')
    ->name('file.get');


Route::get('private/{file?}', [StorageController::class, 'private'])
    ->where('file', '.*')
    ->name('file.private.get');


Route::get('/error', function () {
    abort(500);
});


require __DIR__ . '/auth.php';
