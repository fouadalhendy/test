<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\post_tag;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {

        $posts = Post::all();
        if(count($posts)>0){
        for ($i=0; $i <count($posts) ; $i++) {
            $post=$posts[$i];
            $user=User::findorfail($post["user_id"]);
            $use[]=$user["name"];

        }
        for ($j=0; $j <count($posts) ; $j++) {
            $post=$posts[$j];
            $tagspost=post_tag::all()->where("post_id",$post["id"]);
            $tagpost[$j]=$tagspost;
        }


        if(count($tagspost)>1){
        for ($i=0; $i <count($tagpost) ; $i++) {
            $t=$tagpost[$i];
            foreach ($t as  $value) {

                    $v=$value;
                    $nt[]= $v['tag_id'];
            }
            $namtag[]=$nt;
            $nt=[];
        }
        for ($i=0; $i <count($namtag) ; $i++) {
            foreach ($namtag[$i] as $value) {
                $n=Tag::findorfail($value);
                $n2[]=$n['tag'];
            }
            $n3[]=$n2;
            $n2 =[];
        }


        for ($i=0; $i <count($n3) ; $i++)
        {
            foreach ($n3[$i] as $value) {
                if($value=="null"){

                }
                else{
                    $u=User::findorfail($value);
                    $n4[]=$u['id'];

                }
            }
            $posttag=$i+1;
            $u1[]=$n4;
            $n4=[];
        }

        return view('post.index',compact('posts'))->with('use',$use)->with('tagpost',$tagpost)->with('u',$u1);
        }else
        {
            $u1=[];
            $tagpost=[];
        return view('post.index',compact('posts'))->with('use',$use)->with('tagpost',$tagpost)->with('u',$u1);
        }
    }else{
        $use=[];
        $u1=[];
        $tagpost=[];
        return view('post.index',compact('posts'))->with('use',$use)->with('tagpost',$tagpost)->with('u',$u1);
    }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $e=auth()->user();
        $post = new Post;
        if ($request->hasFile("img")) {
            $img = $request->img;
            $imgname = time() . '.' . $img->getClientOriginalExtension();;
            $img->move(public_path('imges'), $imgname);
        }

        $post->user_id=$e["id"];
        $post->titel = $request->titel;
        $post->description = $request->description;
        $post->img = $imgname;
        $post->save();


        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $Post)
    {
        $com=post_tag::all()->where('post_id',$Post->id);
        foreach ($com as  $key=>$value) {
            $coment[]=$value;
        }


    if (count( $com)>0) {



        for ($i=0; $i < count($coment); $i++) {

            $q=$coment[$i];
            $id[]=$q["id"];
            $c[]= $q["tag_id"];
            $p[]=$q["post_id"];
            $name[]=$q["name_com"];
        }


            for ($i=0; $i <count($c) ; $i++)
            {
            $tag=tag::findorfail($c[$i]);
            $comes[]= $tag->coment;
            $tags[]=$tag->tag ;
            }

            for ($i=0; $i <count($tags) ; $i++)
            {
                if ($tags[$i]!="null") {
                    $uss=User::findorfail($tags[$i]);
                    $us[]=$uss->name ;
                }else{
                    $us[]="";
                }

            }

            $use=User::all();
            for ($i=0; $i < count($use); $i++) {
                $user=$use[$i];
                $users[]=array($user["id"]=>$user["name"]) ;

            }

        return view('post.show',compact('users'))->with('post', $Post )->with('comes', $comes )->with('us',$us)->with('name',$name);

        }
        $comes=[];
        $name=[];
        $us=[];
        $use=User::all();
        for ($i=0; $i < count($use); $i++) {
            $user=$use[$i];
            $users[]=array($user["id"]=>$user["name"]) ;
        }

        return view('post.show',compact('users'))->with('post',$Post )->with('post', $Post )->with('comes', $comes )->with('us',$us)->with('name',$name);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $Post)
    {
        return view('post.edit')->with('post', $Post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $e=auth()->user();
        $up = Post::findorfail($id);
        $imgname =  $up->img;
        if ($request->hasFile("img")) {
            $img = $request->img;
            $imgname = time() . '.' . $img->getClientOriginalExtension();;
            $img->move(public_path('imges'), $imgname);
        }

        $up->user_id=$e["id"];
        $up->titel = $request->titel;
        $up->description = $request->description;
        $up->img = $imgname;
        $up->save();


        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $Post)
    {
        $Post->delete();
        return redirect()->route('post.index');
    }
}
