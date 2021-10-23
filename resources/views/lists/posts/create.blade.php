@extends('layout.app')

@section('title', 'Create A Post')

@section('content')
<form action="{{route('posts.store')}}" method="POST">
    @csrf

   @include('lists.posts.form')
    <div>
        <input type="submit" value="Create!" class="btn btn-primary btn-block mt-2">
    </div>
</form>

@endsection
