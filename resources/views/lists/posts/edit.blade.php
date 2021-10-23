@extends('layout.app')

@section('title', 'Edit A Post')

@section('content')
<form action="{{route('posts.update', ['post' => $post->id])}}" method="POST">
    @csrf    
    @method('PUT')
   @include('lists.posts.form')
    <div>
        <input type="submit" value="Edit!" class="btn btn-primary btn-block">
    </div>
</form>

@endsection
