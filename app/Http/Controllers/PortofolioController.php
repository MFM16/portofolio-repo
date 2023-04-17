<?php

namespace App\Http\Controllers;

use App\Models\Portofolio;
use App\Http\Requests\StorePortofolioRequest;
use App\Http\Requests\UpdatePortofolioRequest;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Illuminate\Http\Request;

class PortofolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [
            'pages' => 'Portofolio',
            'breadcrumbs' => Auth::user()->profile->setting->language == 1 ? 'Portfolio' : 'Portofolio',
        ];
        if($request->ajax()) {
            $data = Portofolio::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<button type="button" id="edit-portofolio" data-id="'.$row->id.'" data-original-title="Edit" class="btn-success">Edit</button>';
                        $btn = $btn.' <button type="button" id="delete-portofolio" data-id="'.$row->id.'" data-original-title="Delete" class="btn-danger ml-4">Delete</button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.portofolio', $data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePortofolioRequest  $request
     * @return \Illuminate\Http\Response
     */

    public function storeImage(Request $request)
    {
        $portofolio = new Portofolio;
        $portofolio->id = 0;
        $portofolio->exists = true;
        $image = $portofolio->addMediaFromRequest('upload')->toMediaCollection('portofolio-images');

        return response()->json(
            [
                'url' => $image->getUrl()
            ]
        );
    }
    
    public function store(StorePortofolioRequest $request)
    {
        if($request->validator->fails())
            return response()->json([
                'status' => 'error',
                'title_en' => 'Failed Add New Portfolio',
                'title_id' => 'Gagal Menambah Portofolio',
                'sub_title_en' => 'Please check again the data that you have entered',
                'sub_title_id' => 'Silahkan periksa kembali data yang anda masukan',
            ], 400);

        $data = [
            'profile_id' => $request->profile_id,
            'name' => $request->name,
            'description' => $request->description,
            'full_description' => $request->full_description
        ];
        $data['slug'] = strtolower($request->name);
        $data['slug'] = str_replace(' ', '-', $data['slug']);

        $data['thumbnail'] = $request->file('thumbnail')->store('portofolio-img');

        if(Portofolio::create($data))
            return response()->json([
                'status' => 'success',
                'title_en' => 'Success Add New Portfolio',
                'title_id' => 'Sukses Menambah Portofolio',
                'sub_title_en' => 'Your new portofolio has been added successfully',
                'sub_title_id' => 'Portofolio baru berhasil ditambahkan',
            ], 200);

        return response()->json([
            'status' => 'error',
            'title_en' => 'Failed Add New Portfolio',
            'title_id' => 'Gagal Menambah Portofolio',
            'sub_title_en' => 'Please check again the data that you have entered',
            'sub_title_id' => 'Silahkan periksa kembali data yang anda masukan',
        ], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Portofolio  $portofolio
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Portofolio::findOrFail($id);
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
     * @param  \App\Http\Requests\UpdatePortofolioRequest  $request
     * @param  \App\Models\Portofolio  $portofolio
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePortofolioRequest $request)
    {
        if($request->validator->fails())
            return response()->json([
                'status' => 'error',
                'title_en' => 'Edit Portfolio Failed',
                'title_id' => 'Gagal Memperbaharui Portofolio',
                'sub_title_en' => 'Please check again the data that you have entered',
                'sub_title_id' => 'Silahkan periksa kembali data yang anda masukan',
            ], 400);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'full_description' => $request->full_description
        ];
        $data['slug'] = strtolower($request->name);
        $data['slug'] = str_replace(' ', '-', $data['slug']);

        if($request->file('thumbnail'))
            $data['thumbnail'] = $request->file('thumbnail')->store('portofolio-img');

        if(Portofolio::where('id', $request->id)->update($data))
            return response()->json([
                'status' => 'success',
                'title_en' => 'Update Portfolio Success',
                'title_id' => 'Sukses Perbaharui Portofolio',
                'sub_title_en' => 'Your portofolio has been updated successfully',
                'sub_title_id' => 'Portofolio anda berhasil diperbaharui',
            ], 200);

        return response()->json([
            'status' => 'error',
            'title_en' => 'Edit Portfolio Failed',
            'title_id' => 'Gagal Memperbaharui Portofolio',
            'sub_title_en' => 'Please check again the data that you have entered',
            'sub_title_id' => 'Silahkan periksa kembali data yang anda masukan',
        ], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Portofolio  $portofolio
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Portofolio::findOrFail($id)->delete())
            return response()->json([
                'status' => 'success',
                'title_en' => 'Success Delete Data',
                'title_id' => 'Sukses Hapus Data',
                'sub_title_en' => 'Deleting data successfully',
                'sub_title_id' => 'Berhasil hapus data portofolio'
            ], 200);
        
        return response()->json([
            'status' => 'error',
            'title_en' => 'Failed Delete Data',
            'title_id' => 'Gagal Hapus Data',
            'sub_title_en' => 'Failed to deleted selected data',
            'sub_title_id' => 'Gagal hapus data portofolio'
        ], 400); 
    }
}
