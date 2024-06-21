@extends('htm')
@section('titil' ,'creat')


@section('hea')
<h1>Show The Post</h1>
@endsection

@section('con')
<div style="display:flex; flex-direction:column; align-items:center; width:100%;gap:10px;">
    <h2 >{{$post->titel}}</h2>
    <p style="">{{$post->description}}</p>
    <img src="../imges/{{$post->img}}" alt="" style="width: 300px;">
<form action="{{route('tag.create',$post->id)}}" method="post">
    @csrf
    <input type="text" name="coment">
    <select name="tags" >
    <option value="null">null</option>
    @foreach ( $users as  $user)
    @foreach ( $user as $key=> $use)
    <option value="{{$key}}">{{$use}}</option>
    @endforeach
    @endforeach
    </select>
    <button type="submit" name="Comente">Comente</button>
</form>
</div>
<a href="{{route('post.index')}}" style="text-decoration: none;"> posts</a>
@endsection

@section('fot')



<div>
@forelse ( $name as $name1 )
<p style="color: red;">{{$name1."=>"}}</p>
@empty
@endforelse
</div>



<div>
    @forelse  ($us as $uss)
        <p style="color: blue;">{{"@" .$uss."<>"}}</p>
    @empty
        <h1>كن اول من يعلق</h1>ك
    @endforelse
</div>

@php
    $i=0;
@endphp


<div >
@forelse($comes as $com)
    <p>{{$com}}</p>

@empty
@endforelse
</div>

@endsection


@section('fot2')


    <div style="display: flex;
    padding-top: 10px;" >


@endsection
