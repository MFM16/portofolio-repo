<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\Logo;
use App\Http\Requests\StoreSkillRequest;
use App\Http\Requests\UpdateSkillRequest;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [
            'pages' => 'Skill',
            'breadcrumbs' => Auth::user()->profile->setting->language == 1 ? 'Skills' : 'Keahlian',
            'logos' => logo::all()
        ];
        if($request->ajax()) {
            $data = Skill::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<button type="button" id="edit-skill" data-id="'.$row->id.'" data-original-title="Edit" class="btn-success">Edit</button>';
                        $btn = $btn.' <button type="button" id="delete-skill" data-id="'.$row->id.'" data-original-title="Delete" class="btn-danger ml-4">Delete</button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.skill', $data);
    }
    
    public function store(StoreSkillRequest $request)
    {
        if($request->validator->fails())
            return response()->json([
                'status' => 'error',
                'title_en' => 'Failed Add New Skill',
                'title_id' => 'Gagal Menambah Keahlian',
                'sub_title_en' => 'Please check again the data that you have entered',
                'sub_title_id' => 'Silahkan periksa kembali data yang anda masukan'
            ], 400);

        $data = [
            'profile_id' => $request->profile_id,
            'name' => $request->name,
            'photo' => $request->logo
        ];

        if(Skill::create($data))
            return response()->json([
                'status' => 'success',
                'title_en' => 'Success Add New Skill',
                'title_id' => 'Sukses Tambah Keahlian',
                'sub_title_en' => 'Your new skill has been added successfully',
                'sub_title_id' => 'Keahlian baru berhasil ditambahkan'
            ], 200);

        return response()->json([
            'status' => 'error',
            'title_en' => 'Failed Add New Skill',
            'title_id' => 'Gagal Menambah Keahlian',
            'sub_title_en' => 'Please check again the data that you have entered',
            'sub_title_id' => 'Silahkan periksa kembali data yang anda masukan'
        ], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Skill::findOrFail($id);
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

    public function update(UpdateSkillRequest $request)
    {
        if($request->validator->fails())
            return response()->json([
                'status' => 'error',
                'title_en' => 'Edit Skill Failed',
                'title_id' => 'Perbaharui Keahlian gagal',
                'sub_title_en' => 'Please check again the data that you have entered',
                'sub_title_id' => 'Silahkan periksa kembali data yang anda masukan'
            ], 400);

            $data = [
                'name' => $request->name,
                'photo' => $request->logo
            ];

            if(Skill::where('id', $request->id)->update($data))
            return response()->json([
                'status' => 'success',
                'title_en' => 'Update Skill Success',
                'title_id' => 'Sukses Perbaharui Keahlian',
                'sub_title_en' => 'Your skill has been updated successfully',
                'sub_title_id' => 'Keahlian anda berhasil diperbaharui'
            ], 200);

        return response()->json([
            'status' => 'error',
            'title_en' => 'Edit Skill Failed',
            'title_id' => 'Perbaharui Keahlian gagal',
            'sub_title_en' => 'Please check again the data that you have entered',
            'sub_title_id' => 'Silahkan periksa kembali data yang anda masukan'
        ], 400);
    }
    
    public function destroy($id)
    {
        if(Skill::findOrFail($id)->delete())
            return response()->json([
                'status' => 'success',
                'title_en' => 'Success Delete Data',
                'title_id' => 'Sukses Hapus Data',
                'sub_title_en' => 'Deleting data successfully',
                'sub_title_id' => 'Berhasil hapus keahlian'
            ], 200);
        
        return response()->json([
            'status' => 'error',
            'title_en' => 'Failed Delete Data',
            'title_id' => 'Gagal Hapus Data',
            'sub_title_en' => 'Failed to deleted selected data',
            'sub_title_id' => 'Gagal hapus keahlian'
        ], 400); 
    }
}
