<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return redirect()->route('principal');
});

Route::get('/principal', function () {
    return view('principal');
})->name('principal');

// Authentication routes are handled by Laravel Fortify / Jetstream
// (Fortify registers its own login/register/logout routes when enabled in providers)
 
Route::get('/reserva', [ReservaController::class, 'index'])->name('reserva.index');

Route::post('/reserva', [ReservaController::class, 'store'])->name('reserva.store');

Route::get('/reservas/listado', [ReservaController::class, 'listado'])->name('reservas.listado');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Route::middleware(['auth']) → Aplica el middleware auth a todas las rutas dentro
// .group(function () { }) → Agrupa múltiples rutas bajo las mismas condiciones
// ¿Qué hace el middleware auth?
// Solo permite acceder a estas rutas si el usuario está autenticado (logged in). Si no está logueado, Laravel lo redirige al login.
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    /*
    =====================================================
    RUTAS MANUALES PARA CRUD DE USUARIOS (COMENTADAS)
    =====================================================
    Las siguientes rutas están comentadas porque se han
    reemplazado por la versión automática con Route::resource()
    que es más limpia y menos repetitiva.
    
    Las rutas generadas automáticamente son exactamente las mismas:
    GET    /admin/users              → index (listar usuarios)
    GET    /admin/users/create       → create (formulario crear)
    POST   /admin/users              → store (guardar nuevo usuario)
    GET    /admin/users/{id}         → show (mostrar detalles usuario)
    GET    /admin/users/{id}/edit    → edit (formulario editar)
    PUT    /admin/users/{id}         → update (actualizar usuario)
    DELETE /admin/users/{id}         → destroy (eliminar usuario)
    =====================================================
    
    Route::prefix('admin')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });
    */

    /**
     * =====================================================
     * RUTAS CRUD DE USUARIOS CON Route::resource()
     * =====================================================
     * 
     * Route::resource() genera automáticamente todas las rutas CRUD
     * El prefijo 'admin' hace que las rutas sean: /admin/users/...
     * 
     * Rutas generadas:
     * - GET    /admin/users              → users.index   (listar)
     * - GET    /admin/users/create       → users.create  (formulario crear)
     * - POST   /admin/users              → users.store   (guardar)
     * - GET    /admin/users/{id}         → users.show    (detalles)
     * - GET    /admin/users/{id}/edit    → users.edit    (formulario editar)
     * - PUT    /admin/users/{id}         → users.update  (actualizar)
     * - DELETE /admin/users/{id}         → users.destroy (eliminar)
     */
    Route::prefix('admin')->group(function () {
        Route::resource('users', UserController::class)->names([
            'index' => 'admin.users.index',
            'create' => 'admin.users.create',
            'store' => 'admin.users.store',
            'show' => 'admin.users.show',
            'edit' => 'admin.users.edit',
            'update' => 'admin.users.update',
            'destroy' => 'admin.users.destroy',
        ]);
    });
});