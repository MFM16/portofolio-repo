<?php

namespace App\Http\Controllers;

use App\Models\Social;
use App\Models\Logo;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSocialRequest;
use App\Http\Requests\UpdateSocialRequest;
use Illuminate\Support\Facades\Auth;
use DataTables;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [
            'pages' => 'Social',
            'breadcrumbs' => Auth::user()->profile->setting->language == 1 ? 'Social Meadia Account' : 'Akun Sosial Media',
            'logos' => Logo::all()
        ];
        if($request->ajax()) {
            $data = Social::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<button type="button" id="edit-social" data-id="'.$row->id.'" data-original-title="Edit" class="btn-success">Edit</button>';
                        $btn = $btn.' <button type="button" id="delete-social" data-id="'.$row->id.'" data-original-title="Delete" class="btn-danger ml-4">Delete</button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.social', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSocialRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSocialRequest $request)
    {
        if($request->validator->fails())
            return response()->json([
                'status' => 'error',
                'title_en' => 'Failed Add New Social Media Account',
                'title_id' => 'Gagal Tambah Akun Media Sosial',
                'sub_title_en' => 'Please check again the data that you have entered',
                'sub_title_id' => 'Silahkan periksa kembali data yang anda masukan'
            ], 400);

        $data = [
            'profile_id' => $request->id,
            'name' => $request->name,
            'url' => $request->url,
            'logo' => $request->logo
        ];

        if(Social::create($data))
            return response()->json([
                'status' => 'success',
                'title_en' => 'Success Add New Social Media Account',
                'title_id' => 'Berhasil Tambah Akun Media Sosial',
                'sub_title_en' => 'Your social media account has been added successfully',
                'sub_title_id' => 'Akun media sosial anda berhasil ditambahkan'
            ], 200);

        return response()->json([
            'status' => 'error',
            'title_en' => 'Failed Add New Social Media Account',
            'title_id' => 'Gagal Tambah Akun Media Sosial',
            'sub_title_en' => 'Please check again the data that you have entered',
            'sub_title_id' => 'Silahkan periksa kembali data yang anda masukan'
        ], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Social::findOrFail($id);
        if($data)
            return response()->json([
                'status' => 'success',
                'title' => 'Data Found',
                'sub_title' => 'The data you are looking for has been found',
                'data' => $data
            ], 200);

        return response()->json([
            'status' => 'error',
            'title' => 'Data Not Found',
            'sub_title' => 'The data you are looking for has not been found',
            'data' => $data
        ], 400);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSocialRequest  $request
     * @param  \App\Models\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSocialRequest $request)
    {
        if($request->validator->fails())
            return response()->json([
                'status' => 'error',
                'title_en' => 'Edit Social Media Account Failed',
                'title_id' => 'Gagal Perbaharui Akun Media Sosial',
                'sub_title_en' => 'Please check again the data that you have entered',
                'sub_title_id' => 'Silahkan periksa kembali data yang anda masukan'
            ], 400);

        $data = [
            'name' => $request->name,
            'url' => $request->url,
            'logo' => $request->logo
        ];

        if(Social::where('id', $request->id_social)->update($data))
            return response()->json([
                'status' => 'success',
                'title_en' => 'Update Social Media Account Success',
                'title_id' => 'Sukses Perbaharui Akun Media Sosial',
                'sub_title_en' => 'Your social media account has been updated successfully',
                'sub_title_id' => 'Akun media sosial anda berhasil diperbaharui'
            ], 200);

        return response()->json([
            'status' => 'error',
            'title_en' => 'Edit Social Media Account Failed',
            'title_id' => 'Gagal Perbaharui Akun Media Sosial',
            'sub_title_en' => 'Please check again the data that you have entered',
            'sub_title_id' => 'Silahkan periksa kembali data yang anda masukan'
        ], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Social::findOrFail($id)->delete())
            return response()->json([
                'status' => 'success',
                'title_en' => 'Success Delete Data',
                'title_id' => 'Sukses Hapus Data',
                'sub_title_en' => 'Deleting data successfully',
                'sub_title_id' => 'Berhasil hapus akun media sosial'
            ], 200);
        
        return response()->json([
            'status' => 'error',
            'title_en' => 'Failed Delete Data',
            'title_id' => 'Gagal Hapus Data',
            'sub_title_en' => 'Failed to deleted selected data',
            'sub_title_id' => 'Gagal hapus akun media sosial'
        ], 400); 
    }
}
