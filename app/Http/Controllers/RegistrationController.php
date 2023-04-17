<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Profile;
use App\Models\Setting;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('auth.registration', ['title' => 'Registration Page']);
    }

    public function registrate(UserRequest $request)
    {
        if($request->validator->fails())
            return response()->json([
                'status' => 'error',
                'title_en' => 'Registration Failed',
                'sub_title_en' => 'New user registration failed'
            ], 400);

        $token = Str::random(30);
        $email = $request->email;

        if(Mail::to($email)->send(new VerifyEmail($token)))
            $user = [
                'email' => $email,
                'password' => Hash::make($request->password),
                'email_verified_token' => $token
            ];

            $lastInsertId = User::create($user);

            if($lastInsertId)
                $id = $lastInsertId->id;
                $defaultName = explode('@', $request->email);

                $profile = [
                    'user_id' => $id,
                    'name' => $defaultName[0],
                    'nickname' => $defaultName[0],
                    'email' => $request->email
                ];

                $setting_id = Profile::create($profile);

                $setting = [
                    'profile_id' => $setting_id->id,
                    'language' => 0,
                    'client' => 0,
                    'blog' => 0,
                ];

                Setting::create($setting);

                return response()->json([
                    'status' => 'success',
                    'title_en' => 'Registered User',
                    'sub_title_en' => 'The new user has been successfully registered'
                ], 200);
        
        return response()->json([
            'status' => 'error',
            'title_en' => 'Registration Failed',
            'sub_title_en' => 'New user registration failed'
        ], 400);
    
    }

    public function verify($token)
    {
        $user = User::where('email_verified_token', $token)->first();

        if(!$user){
            $data = [
                'status' => 'error',
                'title' => 'Verification Failed',
                'sub_title' => 'The email verification token is invalid'
            ];
            return view('auth.verify_token', $data);
        }

        if($user->email_verified_at != null){
            $data = [
               'status' => 'error',
               'title' => 'Verification Failed',
               'sub_title' => 'The email verification token has already been verified'
            ];
            return view('auth.verify_token', $data);
        }

        if(User::where('email_verified_token', $token)->update(['email_verified_at' => date('Y-m-d H:i:s')]))
            return redirect(url('admin/auth'));
    }
}
