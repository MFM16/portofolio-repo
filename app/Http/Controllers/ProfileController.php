<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Portofolio;
use App\Models\Social;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->profile->id;
        $data = [
            'pages' => 'Profile',
            'breadcrumbs' => Auth::user()->profile->setting->language == 1 ? 'Profile' : 'Profil',
            'user' => Profile::findOrFail(Auth::user()->profile->id),
            'socials' => Social::where('profile_id', $id)->get()
        ];
        return view('admin.profile', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Profile::findOrFail($id);
        if($user)
            return response()->json([
                'status' => 'success',
                'title' => 'User Found',
                'sub_title' => 'The user you are looking for has been found',
                'data' => $user
            ], 200);

        return response()->json([
            'status' => 'error',
            'title' => 'User Not Found',
            'sub_title' => 'The user you are looking for has not been found',
            'data' => $user
        ], 400);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProfileRequest  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request)
    {
        if($request->validator->fails())
            return response()->json([
                'status' => 'error',
                'title_en' => 'Edit Profile Failed',
                'title_id' => 'Gagal Perbaharui Profil',
                'sub_title_en' => 'Please check again the data that you have entered',
                'sub_title_id' => 'Silahkan periksa kembali data yang anda masukan'
            ], 400);

        $data = [
            'name' => $request->name,
            'nickname' => $request->nickname,
            'address' => $request->address,
            'biography' => $request->bio,
            'job' => $request->job,
            'job_description' => $request->jobdesc,
        ];

        if($request->file('photo'))
            $data['photo'] = $request->file('photo')->store('profil-img');

        if($request->file('logo'))
            $data['logo'] = $request->file('logo')->store('logo-img');

        if(Profile::where('id', $request->id)->update($data))
            return response()->json([
                'status' => 'success',
                'title_en' => 'Update Profile Success',
                'title_id' => 'Sukses Perbaharui Profil',
                'sub_title_en' => 'Your profile has been updated successfully',
                'sub_title_id' => 'Profil anda berhasil diperbaharui'
            ], 200);

        return response()->json([
            'status' => 'error',
            'title_en' => 'Edit Profile Failed',
            'title_id' => 'Gagal Perbaharui Profil',
            'sub_title_en' => 'Please check again the data that you have entered',
            'sub_title_id' => 'Silahkan periksa kembali data yang anda masukan'
        ], 400);
    }
}
