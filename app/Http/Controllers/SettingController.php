<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;

class SettingController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSettingRequest  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSettingRequest $request)
    {
        if($request->validator->fails())
            return response()->json([
                'status' => 'error',
                'title_en' => 'Setting Failed',
                'title_id' => 'Pengaturan Gagal',
                'sub_title_en' => 'Please check again the data that you have entered',
                'sub_title_id' => 'Silahkan periksa kembali data yang anda masukan'
            ], 400);

        $data = [
            'language' => $request->lang,
            'client' => $request->client,
            'blog' => $request->blog
        ];

        if(Setting::where('id', $request->id)->update($data))
            return response()->json([
                'status' => 'success',
                'title_en' => 'Setting Success',
                'title_id' => 'Pengaturan Berhasil',
                'sub_title_en' => 'Setting has been updated successfully',
                'sub_title_id' => 'Pengaturan berhasil diperbaharui'
            ], 200);

        return response()->json([
            'status' => 'error',
            'title_en' => 'Setting Failed',
            'title_id' => 'Pengaturan Gagal',
            'sub_title_en' => 'Please check again the data that you have entered',
            'sub_title_id' => 'Silahkan periksa kembali data yang anda masukan'
        ], 400);
    }
}
