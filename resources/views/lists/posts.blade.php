@extends('layout.app')

@section('title', 'Posts List')

@section('content')

<div class="row">
    <div class="col-8">
@forelse ($posts as $key => $post)
@include('lists.posts.partial')
@empty
<p>No blog post has been recorded!</p>
@endforelse
    </div>
    <div class="col-4">
        <div class="container">
@component('components.card', ['title' => 'Most Commented Posts', 'subtitle' => 'Here are the posts that people talking about mostly!'])
    @slot('items')
    @foreach ($mostCommented as $post ) <a href="{{route('posts.show', ['post' => $post->id])}}">
<li class="list-group-item">{{$post->title}}</li></a>
        @endforeach
    @endslot
@endcomponent
</div>

<div class="container">
@component('components.card', ['title' => 'Most Active Users', 'subtitle' => 'Here are the users that wrote mostly!'])
    @slot('items', collect($mostActive)->pluck('name'))
@endcomponent
</div>

<div class="container">
@component('components.card', ['title' => 'Most Active Users Last Month', 'subtitle' => 'Here are the users that wrote mostly in last month!'])
    @slot('items', collect($mostActiveLastMonth)->pluck('name'))
@endcomponent
</div>
</div>
</div>
@endsection

