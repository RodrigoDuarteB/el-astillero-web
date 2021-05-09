<?php

use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::middleware('auth:sanctum')->group(function (){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::name('api.')->group(function (){
        Route::prefix('books')->group(function (){
            Route::get('/', [BookController::class, 'all'])->name('books');
            Route::get('/{id}', [BookController::class, 'getById'])
            ->name('book.show');
            Route::post('/', [BookController::class, 'create'])->name('book.create');
            Route::put('/{id}', [BookController::class, 'update'])
            ->name('book.update');
            Route::delete('/{id}', [BookController::class, 'delete'])
            ->name('book.delete');
        });
    });
});


// api login token for API consumers
Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
    return $user->createToken($request->device_name)->plainTextToken;
});

