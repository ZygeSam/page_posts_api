<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = Page::with('posts')->get();
        return response()->json(['data'=> $page]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $data = request()->validate([
            'title'=> 'required|string',
            'description' => 'required|string'
        ]);
        // echo 'Hello';
        // print_r($data) ;
       if(Page::create($data)){
        return response()->json(['data'=>$data, 'status'=>'Record saved']);
       }else{
        return response()->json(['data'=>$data, 'status'=>'Wrong data parameters']);
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $page = Page::findOrFail($id);
        return response()->json(['data'=>$page]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $page = Page::findOrFail($id);
        $page->update($request->all());
        return response()->json(['data'=>$page, 'status'=>'Record Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $page = Page::findOrFail($id);
        $page->delete();
        return response()->json(['data'=>$page, 'status'=>'Record Deleted']);
    }
}
