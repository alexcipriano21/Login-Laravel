<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Hash; 

class AuthController extends Controller
{
    public function registro(Request $request) {
        $request->validate([
            'usuario' => 'required|unique:usuarios,usuario',
            'correo'  => 'required|email|unique:usuarios,correo',
            'contrasena'=> 'required|min:6'
        ]);
        $hash = bcrypt($request->contrasena);
        DB::select('CALL sp_registrarUsuario(?, ?, ?)', [
            $request->usuario,
            $request->correo,
            $hash
        ]);
        return redirect()->route('login')->with('swal_success', 'Cuenta creada con éxito.');
    }

    public function login(Request $request) {
    $request->validate([
        'correo'     => 'required|email',
        'contrasena' => 'required'
    ]);
    $usuarioArray = DB::select('CALL sp_getUsuarioLogin(?)', [$request->correo]);
    if (empty($usuarioArray)) {
        return redirect()->back()
            ->withInput($request->only('correo'))
            ->withErrors(['error' => 'Credenciales incorrectas o cuenta inactiva']);
    }
    $user = (array) $usuarioArray[0];
    if (!Hash::check($request->contrasena, $user['password_hash'])) {
        return redirect()->back()
            ->withInput($request->only('correo'))
            ->withErrors(['error' => 'La contraseña es incorrecta']);
    }
    session(['usuario' => $user['usuario']]);
    return redirect()->route('home');
}

    public function olvidarContrasena(Request $request) {
        $request->validate(['correo' => 'required|email']);
        $token = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $expiracion = now()->addMinutes(15); 

        DB::select('CALL sp_generarTokenRecuperacion(?, ?, ?)', [
            $request->correo,
            $token,
            $expiracion
        ]);
        return redirect()->back()->with('swal_success', 'Código enviado correctamente.');
    }

    public function actualizarContrasena(Request $request) {
        $request->validate([
            'correo' => 'required|email',
            'token' => 'required',
            'contrasena' => 'required|min:6'
        ]);

        $res = DB::select('CALL sp_obtenerTokenRecuperacion(?)', [$request->correo]);
        if (empty($res)) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
        if ($res[0]->token_recuperacion !== $request->token) {
            return response()->json(['message' => 'Token inválido'], 400);
        }
        DB::select('CALL sp_actualizarPassword(?, ?)', [
            $request->correo,
            bcrypt($request->contrasena)
        ]);
        return redirect()->route('login')->with('swal_success', 'Tu contraseña ha sido cambiada.');
    }
}