<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login', ['title' => 'Login Page']);
    }

    public function authenticate(AuthRequest $request)
    {
        if($request->validator->fails())
            return response()->json([
                'status' => 'error',
                'title_en' => 'Login Failed',
                'sub_title_en' => 'Either email or password is incorrect'
            ], 400);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $user = User::where('email', $request->email)->first();
        if($user){
            if($user->email_verified_at == null){
                return response()->json([
                    'status' => 'error',
                    'title_en' => 'Login Failed',
                    'sub_title_en' => 'Either email or password is incorrect'
                ], 400);
            }else{
                if(Auth::attempt($credentials) == false)
                    return response()->json([
                        'status' => 'error',
                        'title_en' => 'Login Failed',
                        'sub_title_en' => 'Either email or password is incorrect'
                    ], 400);

                $request->session()->regenerate();
            
                return response()->json([
                    'status' => 'success',
                    'title_en' => 'Login Successfully',
                    'sub_title_en' => 'Welcome Back',
                    'data' => $user
                ], 200);     
            }
        }else{
            return response()->json([
                'status' => 'error',
                'title_en' => 'Login Failed',
                'sub_title_en' => 'Either email or password is incorrect'
            ], 400);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/');
    }
}
