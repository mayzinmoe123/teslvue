<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\User;

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

Route::middleware(['auth'])->group(function(){
    Route::get('/', function () {
        return Inertia::render('UserView/Home');
    });

    Route::get('/users', function () {
        return Inertia::render('UserView/Users/Index', [
            'users' => User::query()
                ->when(Request::input('search'), function($query, $search){
                    $query->where('name', 'like', "%{$search}%");
                })
                ->paginate(10)
                ->withQueryString()
                ->through(fn($user) => [
                    'name' => $user->name,
                    'id' => $user->id,
                    'can' => [
                        'edit' => Auth::user()->can('edit', $user)
                    ]
                ]),

            'filter' => Request::only(['search']),

            'can' => [
                'create' => Auth::user()->can('create', User::class)
            ]
        ]);
    });

    Route::get('/users/create', function(){
        return Inertia::render('UserView/Users/Create');
    })->middleware('can:create, App\Models\User');

    Route::get('/users/createhelper', function(){
        return Inertia::render('UserView/Users/CreateHelper');
    })->can('create', 'App\Models\User');

    Route::post('/users', function(){
        $attribute = Request::validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6', 'max:20']
        ]);
        User::create($attribute);
        return redirect('/users');
    });

    Route::post('/usercreatehelper', function(){
        $attribute = Request::validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6', 'max:20']
        ]);

        User::create($attribute);

        return redirect('/users/createhelper');
    });


});
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
