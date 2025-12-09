<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * UserController - Controlador CRUD para la gestión de usuarios
 * 
 * Maneja todas las operaciones CRUD (Create, Read, Update, Delete) para usuarios.
 * Incluye validaciones completas, encriptación de contraseñas y protección contra auto-eliminación.
 * Todas las rutas están protegidas por middleware de autenticación.
 */
class UserController extends Controller
{
    /**
     * Lista todos los usuarios con paginación.
     * 
     * @return \Illuminate\View\View Vista con listado de usuarios (10 por página)
     */
    public function index()
    {
        // Paginamos los usuarios, 10 por página, esto hace que funcione el método links() en la vista
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Muestra el formulario para crear un nuevo usuario.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Guarda un nuevo usuario en el almacenamiento.
     * 
     * Valida los datos ingresados:
     * - Nombre: requerido, texto, máx 255 caracteres
     * - Email: requerido, válido, único en la BD
     * - Contraseña: requerida, mín 8 caracteres, debe coincidir con confirmación
     * 
     * La contraseña se encripta con Hash::make() antes de guardarse.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse Redirige a index con mensaje de éxito
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], [], [
            'name' => 'nombre',
            'email' => 'correo electrónico',
            'password' => 'contraseña',
            'password_confirmation' => 'confirmación de contraseña',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('users.index')
                        ->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Muestra el usuario especificado.
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Muestra el formulario para editar el usuario especificado.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Actualiza el usuario especificado en el almacenamiento.
     * 
     * Validaciones:
     * - Nombre: requerido, texto, máx 255 caracteres
     * - Email: requerido, válido, único (excepto el email actual del usuario)
     * - Contraseña: opcional, mín 8 caracteres si se proporciona, debe coincidir con confirmación
     * 
     * Lógica especial para contraseña:
     * - Si está vacía: se mantiene la contraseña anterior (no se actualiza)
     * - Si está llena: se encripta con Hash::make() y se actualiza
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user Usuario a actualizar (obtenido por model binding)
     * @return \Illuminate\Http\RedirectResponse Redirige a index con mensaje de éxito
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ], [], [
            'name' => 'nombre',
            'email' => 'correo electrónico',
            'password' => 'contraseña',
            'password_confirmation' => 'confirmación de contraseña',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('users.index')
                        ->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Elimina el usuario especificado del almacenamiento.
     * 
     * IMPORTANTE: Valida que el usuario actual no intente eliminarse a sí mismo.
     * Si lo intenta, retorna un mensaje de error sin eliminar.
     *
     * @param \App\Models\User $user Usuario a eliminar
     * @return \Illuminate\Http\RedirectResponse Redirige a index con mensaje de éxito o error
     */
    public function destroy(User $user)
    {
        // Impedir que un usuario intente eliminarse a sí mismo
         if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                            ->with('error', __('No puedes eliminar tu propia cuenta de ususario.'));
        }

        $user->delete();

        return redirect()->route('admin.users.index')
                        ->with('success', __('Usuario eliminado.'));
    }
}
