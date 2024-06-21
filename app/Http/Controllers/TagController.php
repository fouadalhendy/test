<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\post_tag;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$idpost)
    {




        $tag=new Tag;
        $tag->coment=$request->coment;
        $tag->tag=$request->tags;
        $tag->save();

        $idtag=$tag->id;

        return view('tagpost',compact('idtag'))->with('idpost',$idpost);



    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,$idtag)
    {

            $user=auth()->user();

            $idpost=$request->input('ff');
            $posttag=new post_tag();
            $posttag->name_com=$user['name'];
            $posttag->post_id=intval($idpost);
            $posttag->tag_id=intval($idtag);
            $posttag->save();

            return redirect()->route('post.index');



    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit2(Request $request,Tag $tag )
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update2(Request $request, Tag $tag,$idpost)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy (Post $tag)
    {
        $tag->delete();
        return redirect()->route('post.index');
    }
}
