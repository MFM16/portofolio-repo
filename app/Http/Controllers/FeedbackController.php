<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Http\Requests\StoreFeedbackRequest;
use App\Http\Requests\UpdateFeedbackRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DataTables;


class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [
            'pages' => 'Feedback',
            'breadcrumbs' => Auth::user()->profile->setting->language == 1 ? 'Feedbacks' : 'Ulasan',
        ];
        if($request->ajax()) {
            $data = Feedback::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<button type="button" id="detail-feedback" data-id="'.$row->id.'" data-original-title="Detail" class="btn-success">Detail</button>';
                        $btn = $btn.' <button type="button" id="delete-feedback" data-id="'.$row->id.'" data-original-title="Delete" class="btn-danger ml-4">Delete</button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.feedback', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFeedbackRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFeedbackRequest $request)
    {
        if($request->validator->fails())
            return response()->json([
                'status' => 'error',
                'title_en' => 'Failed to Provide Feedback',
                'title_id' => 'Gagal Memberikan ulasan',
                'sub_title_en' => 'Please check again the data that you have entered',
                'sub_title_id' => 'Silahkan periksa kembali data yang anda masukan',
            ], 400);

        $data = [
            'category' => $request->category,
            'content' => $request->content
        ];

        if(Feedback::create($data))
            return response()->json([
                'status' => 'success',
                'title_en' => 'Success to Provide Feedback',
                'title_id' => 'Sukses Memberikan ulasan',
                'sub_title_en' => 'Feedback has been successfully given',
                'sub_title_id' => 'Ulasan berhasil diberikan'
            ], 200);

        return response()->json([
            'status' => 'error',
            'title_en' => 'Failed to Provide Feedback',
            'title_id' => 'Gagal Memberikan ulasan',
            'sub_title_en' => 'Please check again the data that you have entered',
            'sub_title_id' => 'Silahkan periksa kembali data yang anda masukan',
        ], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Feedback::findOrFail($id);
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Feedback::findOrFail($id)->delete())
            return response()->json([
                'status' => 'success',
                'title_en' => 'Success Delete Data',
                'title_id' => 'Sukses Hapus Data',
                'sub_title_en' => 'Deleting data successfully',
                'sub_title_id' => 'Berhasil hapus ulasan'
            ], 200);
        
        return response()->json([
            'status' => 'error',
            'title_en' => 'Failed Delete Data',
            'title_id' => 'Gagal Hapus Data',
            'sub_title_en' => 'Failed to deleted selected data',
            'sub_title_id' => 'Gagal hapus ulasan'
        ], 400);
    }
}
