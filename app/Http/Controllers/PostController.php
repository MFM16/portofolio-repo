<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [
            'pages' => 'Post',
            'breadcrumbs' => Auth::user()->profile->setting->language == 1 ? 'Post' : 'Artikel',
        ];
        if($request->ajax()) {
            $data = Post::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<button type="button" id="edit-post" data-id="'.$row->id.'" data-original-title="Edit" class="btn-success">Edit</button>';
                        $btn = $btn.' <button type="button" id="delete-post" data-id="'.$row->id.'" data-original-title="Delete" class="btn-danger ml-4">Delete</button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.post', $data);
    }

    public function storeImage(Request $request)
    {
        $post = new Post;
        $post->id = 0;
        $post->exists = true;
        $image = $post->addMediaFromRequest('upload')->toMediaCollection('post-images');

        return response()->json(
            [
                'url' => $image->getUrl()
            ]
        );
    }
    
    public function store(StorePostRequest $request)
    {
        if($request->validator->fails())
            return response()->json([
                'status' => 'error',
                'title_en' => 'Failed Add New Post',
                'title_id' => 'Gagal Menambah Tulisan',
                'sub_title_en' => 'Please check again the data that you have entered',
                'sub_title_id' => 'Silahkan periksa kembali data yang anda masukan'
            ], 400);

        $data = [
            'profile_id' => $request->profile_id,
            'name' => $request->name,
            'description' => $request->description,
            'full_description' => $request->full_description
        ];
        $data['slug'] = strtolower($request->name);
        $data['slug'] = str_replace(' ', '-', $data['slug']);

        $data['thumbnail'] = $request->file('thumbnail')->store('post-img');

        if(Post::create($data))
            return response()->json([
                'status' => 'success',
                'title_en' => 'Success Add New Post',
                'title_id' => 'Sukse Menambah Tulisan',
                'sub_title_en' => 'Your new Post has been added successfully',
                'sub_title_id' => 'Tulisan anda berhasil ditambahkan'
            ], 200);

        return response()->json([
            'status' => 'error',
            'title_en' => 'Failed Add New Post',
            'title_id' => 'Gagal Menambah Tulisan',
            'sub_title_en' => 'Please check again the data that you have entered',
            'sub_title_id' => 'Silahkan periksa kembali data yang anda masukan'
        ], 400);
    }

    public function show($id)
    {
        $data = Post::findOrFail($id);
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
    public function update(UpdatePostRequest $request)
    {
        if($request->validator->fails())
            return response()->json([
                'status' => 'error',
                'title_en' => 'Edit Post Failed',
                'title_id' => 'Gagal Perbaharui Tulisan',
                'sub_title_en' => 'Please check again the data that you have entered',
                'sub_title_id' => 'Silahkan periksa kembali data yang anda masukan'
            ], 400);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'full_description' => $request->full_description
        ];

        if($request->file('thumbnail'))
           $data['thumbnail'] = $request->file('thumbnail')->store('post-img');


        if(Post::where('id', $request->id)->update($data))
            return response()->json([
                'status' => 'success',
                'title_en' => 'Update Post Success',
                'title_id' => 'Sukses Perbaharui Tulisan',
                'sub_title_en' => 'Your Post has been updated successfully',
                'sub_title_id' => 'Tulisan anda berhasil diperbaharui'
            ], 200);

        return response()->json([
            'status' => 'error',
            'title_en' => 'Edit Post Failed',
            'title_id' => 'Gagal Perbaharui Tulisan',
            'sub_title_en' => 'Please check again the data that you have entered',
            'sub_title_id' => 'Silahkan periksa kembali data yang anda masukan'
        ], 400);
    }

    public function destroy($id)
    {
        if(Post::findOrFail($id)->delete())
            return response()->json([
                'status' => 'success',
                'title_en' => 'Success Delete Data',
                'title_id' => 'Sukses Hapus Data',
                'sub_title_en' => 'Deleting data successfully',
                'sub_title_id' => 'Berhasil hapus tulisan'
            ], 200);
        
        return response()->json([
            'status' => 'error',
            'title_en' => 'Failed Delete Data',
            'title_id' => 'Gagal Hapus Data',
            'sub_title_en' => 'Failed to deleted selected data',
            'sub_title_id' => 'Gagal hapus tulisan'
        ], 400); 
    }
}
