<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::with('page')->get();
        return response()->json(['data'=> $posts]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = request()->validate([
            'page_id'=> 'required|int',
            'title'=> 'required|string',
            'content' => 'required|string'
        ]);
        if(Post::create($data)){
            return response()->json(['data'=>$data, 'status'=>' Post Record saved']);
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
        $post = Post::findOrFail($id);
        return response()->json(['data'=>$post]);
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
        $data = request()->validate([
            'page_id'=> 'required|int',
            'title'=> 'required|string',
            'content' => 'required|string'
        ]);
        $post = Post::findOrFail($id);
        if($post->update($request->all())){
            return response()->json(['data'=>$data, 'status'=>' Post Record updated']);
           }
        


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
        $post = Post::findOrFail($id);
        $post->delete();
        return response()->json(['data'=>$post, 'status'=>' Post Record deleted']);
    }
}
