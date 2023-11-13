<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CabinetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;
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
/*
Route::get('/', function () {return view('welcome'); });
*/

Route::get('/', [HomeController::class, 'index'])->name('home');



// Разрешаем маршруты для неавторизованного пользователя
Route::group(['middleware' => 'guest'], function() {
    /* Регистрация */
// выводим форму, название действия сделали как в ресурсном контроллере
    Route::get('/register', [UserController::class, 'create'])->name('register');
// сохраняем в БД данные из формы
    Route::post('/register', [UserController::class, 'store'] )->name('register.store');

    /* Авторизация */
    Route::get('/login', [UserController::class, 'loginForm'])->name('login.create');
    Route::post('/login', [UserController::class, 'login'])->name('login');

});

// Разрешаем маршруты для авторизованного пользователя
Route::group(['middleware' => 'auth'], function() {

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/cabinet', [CabinetController::class, 'index'])->name('cabinet');

// редактирование профиля
Route::get('/cabinet/edit', [CabinetController::class, 'create'])->name('cabinet.edit');
Route::post('/cabinet/edit', [CabinetController::class, 'store'])->name('cabinetEdit.store');

// в кабинете добавление друга по заявке
Route::get('/cabinet/friend/{id}', [CabinetController::class, 'friend'])->name('cabinet.friend');
Route::post('/cabinet/friend/{id}', [CabinetController::class, 'storeFriend'])->name('cabinetFriend.store');

// из кабинета написать сообщение другу или удалить друга
Route::get('/cabinet/friendw/{id}', [CabinetController::class, 'friendw'])->name('cabinet.friendw');
Route::get('/cabinet/frienddel/{id}', [CabinetController::class, 'deleteFriendw']);
Route::get('/cabinet/friendmes/{id}', [CabinetController::class, 'messageFriendw']);
Route::post('/cabinet/friendmes/{id}', [CabinetController::class, 'storeCabinetMessage']);

Route::get('/wall', [PageController::class, 'wall'])->name('wall');
Route::post('/wall', [PageController::class, 'wallStore'])->name('wall.store');
Route::post('/comment', [PageController::class, 'commentStore'])->name('comment.store');

Route::get('/community', [PageController::class, 'community'])->name('community');
Route::get('/community/addfriend/{id}', [PageController::class, 'addfriend']);

});

// Страница для ошибки 404 resources/view/errors/404.blade.php
//404.blade.php - 404 должно совпадать с 404 в  abort()
Route::fallback(function(){
    // return redirect()->route('err');
    abort (404, 'Страница не найдена');
});



