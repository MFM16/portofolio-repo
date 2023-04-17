<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use App\Http\Requests\StoreLogoRequest;
use App\Http\Requests\UpdateLogoRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DataTables;

class LogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [
            'pages' => 'Logo',
            'breadcrumbs' => Auth::user()->profile->setting->language == 1 ? 'Icons' : 'Ikon',
        ];
        if($request->ajax()) {
            $data = Logo::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<button type="button" id="edit-icon" data-id="'.$row->id.'" data-original-title="Edit" class="btn-success">Edit</button>';
                        $btn = $btn.' <button type="button" id="delete-icon" data-id="'.$row->id.'" data-original-title="Delete" class="btn-danger ml-4">Delete</button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.logo', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLogoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLogoRequest $request)
    {
        if($request->validator->fails())
            return response()->json([
                'status' => 'error',
                'title_en' => 'Failed Add New Logo',
                'title_id' => 'Gagal Menambah Logo',
                'sub_title_en' => 'Please check again the data that you have entered',
                'sub_title_id' => 'Silahkan periksa kembali data yang anda masukan',
            ], 400);

        $data = [
            'name' => $request->name,
            'icon' => $request->icon
        ];

        if(Logo::create($data))
            return response()->json([
                'status' => 'success',
                'title_en' => 'Success Add New Logo',
                'title_id' => 'Sukses Tambah Logo',
                'sub_title_en' => 'Your logo has been added successfully',
                'sub_title_id' => 'Logo berhasil ditambahakan'
            ], 200);

        return response()->json([
            'status' => 'error',
            'title_en' => 'Failed Add New Logo',
            'title_id' => 'Gagal Menambah Logo',
            'sub_title_en' => 'Please check again the data that you have entered',
            'sub_title_id' => 'Silahkan periksa kembali data yang anda masukan',
        ], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Logo::findOrFail($id);
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
     * @param  \App\Http\Requests\UpdateLogoRequest  $request
     * @param  \App\Models\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLogoRequest $request)
    {
        if($request->validator->fails())
            return response()->json([
                'status' => 'error',
                'title_en' => 'Edit Logo Failed',
                'title_id' => 'Logo Gagal Diperbaharui',
                'sub_title_en' => 'Please check again the data that you have entered',
                'sub_title_id' => 'Silahkan periksa kembali data yang anda masukan',
            ], 400);

        $data = [
            'name' => $request->name,
            'icon' => $request->icon
        ];

        if(Logo::where('id', $request->id)->update($data))
            return response()->json([
                'status' => 'success',
                'title_en' => 'Update Logo Success',
                'title_id' => 'Logo Berhasi Diperbaharui',
                'sub_title_en' => 'Your logo has been updated successfully',
                'sub_title_id' => 'Logo berhasil diperbaharui'
            ], 200);

        return response()->json([
            'status' => 'error',
            'title_en' => 'Edit Logo Failed',
            'title_id' => 'Logo Gagal Diperbaharui',
            'sub_title_en' => 'Please check again the data that you have entered',
            'sub_title_id' => 'Silahkan periksa kembali data yang anda masukan',
        ], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Logo::findOrFail($id)->delete())
            return response()->json([
                'status' => 'success',
                'title_en' => 'Success Delete Data',
                'title_id' => 'Sukses Hapus Data',
                'sub_title_en' => 'Deleting data successfully',
                'sub_title_id' => 'Berhasil hapus logo'
            ], 200);
        
        return response()->json([
            'status' => 'error',
            'title_en' => 'Failed Delete Data',
            'title_id' => 'Gagal Hapus Data',
            'sub_title_en' => 'Failed to deleted selected data',
            'sub_title_id' => 'Gagal hapus logo'
        ], 400); 
    }
}
