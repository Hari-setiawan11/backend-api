<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => 'required',
            'alamat' => 'required',
            'telephone' => 'required|max:15',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi Kesalahan',
                'data' => $validator->errors()
            ], 422); // Mengembalikan response dengan HTTP status code 422 (Unprocessable Entity)
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        $success['email'] = $user->email;
        $success['name'] = $user->name;
        $success['username'] = $user->username;
        $success['alamat'] = $user->alamat;
        $success['telephone'] = $user->telephone;

        return response()->json([
            'success' => true,
            'message' => 'Register Berhasil',
            'data' => $success
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $authUser = Auth::user();
            $success['token'] = $authUser->createToken('auth_token')->plainTextToken;
            $success['name'] = $authUser->name;

            return response()->json([
                'success' => true,
                'message' => 'Login Berhasil',
                'data' => $success
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Cek kembali email dan password',
                'data' => null
            ], 401); // Mengembalikan response dengan HTTP status code 401 (Unauthorized)
        }
    }

    public function logout(Request $request)
    {
        // Mendapatkan user yang sedang login
        $user = Auth::user();

        // Menghapus semua token user
        $user->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout Berhasil'
        ]);
    }
}