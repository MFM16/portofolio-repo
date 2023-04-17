<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [
            'pages' => 'Client',
            'breadcrumbs' => Auth::user()->profile->setting->language == 1 ? 'Client' : 'Klien',
        ];
        if($request->ajax()) {
            $data = Client::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<button type="button" id="edit-client" data-id="'.$row->id.'" data-original-title="Edit" class="btn-success">Edit</button>';
                        $btn = $btn.' <button type="button" id="delete-client" data-id="'.$row->id.'" data-original-title="Delete" class="btn-danger ml-4">Delete</button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.client', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientRequest $request)
    {
        if($request->validator->fails())
            return response()->json([
                'status' => 'error',
                'title_en' => 'Failed Add New Client Picture',
                'title_id' => 'Gagal Menambah Foto Klien',
                'sub_title_en' => 'Please check again the data that you have entered',
                'sub_title_id' => 'Silahkan periksa kembali data yang anda masukan',
            ], 400);

        $data = [
            'profile_id' => $request->profile_id,
            'name' => $request->name,
        ];
        $data['photo'] = $request->file('photo')->store('client-img');

        if(Client::create($data))
            return response()->json([
                'status' => 'success',
                'title_en' => 'Success Add New Client Picture',
                'title_id' => 'Sukses Menambah Foto Klien',
                'sub_title_en' => 'Your new client picture has been added successfully',
                'sub_title_id' => 'Foto klien terbaru berhasil ditambahkan'
            ], 200);

        return response()->json([
            'status' => 'error',
            'title_en' => 'Failed Add New Client Picture',
            'title_id' => 'Gagal Menambah Foto Klien',
            'sub_title_en' => 'Please check again the data that you have entered',
            'sub_title_id' => 'Silahkan periksa kembali data yang anda masukan',
        ], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Client::findOrFail($id);
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
     * @param  \App\Http\Requests\UpdateClientRequest  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientRequest $request)
    {
        if($request->validator->fails())
            return response()->json([
                'status' => 'error',
                'title_en' => 'Edit Client Picture Failed',
                'title_id' => 'Foto Klien Gagal Diperbaharui',
                'sub_title_en' => 'Please check again the data that you have entered',
                'sub_title_id' => 'Silahkan periksa kembali data yang anda masukan',
            ], 400);

        $data = [
            'name' => $request->name,
        ];

        if($request->file('photo'))
            $data['photo'] = $request->file('photo')->store('client-img');

        if(Client::where('id', $request->id)->update($data))
            return response()->json([
                'status' => 'success',
                'title_en' => 'Update Client Picture Success',
                'title_id' => 'Edit Foto Klien Sukses',
                'sub_title_en' => 'Your client picture has been updated successfully',
                'sub_title_id' => 'Foto klien berhasil diperbaharui'
            ], 200);

        return response()->json([
            'status' => 'error',
            'title_en' => 'Edit Client Picture Failed',
            'title_id' => 'Edit Foto Klien Gagal',
            'sub_title_en' => 'Please check again the data that you have entered',
            'sub_title_id' => 'Silahkan periksa kembali data yang anda masukan',
        ], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Client::findOrFail($id)->delete())
            return response()->json([
                'status' => 'success',
                'title_en' => 'Success Delete Data',
                'title_id' => 'Sukses Hapus Data',
                'sub_title_en' => 'Deleting data successfully',
                'sub_title_id' => 'Berhasil hapus foto klien'
            ], 200);
    
        return response()->json([
            'status' => 'error',
            'title_en' => 'Failed Delete Data',
            'title_id' => 'Gagal Hapus Data',
            'sub_title_en' => 'Failed to deleted selected data',
            'sub_title_id' => 'Gagal hapus data klien'
        ], 400); 
    }
}
