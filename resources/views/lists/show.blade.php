@extends('layout.app')

@section('title', $post['title'])

@section('content')

@if ($post['is_new'])
    <p>It is new. Using if</p>
    @else
    <p>It isn't new, using else or elseif</p>
@endif

@unless ($post['is_new'])
    <h2>It is old, using unless</h2>
@endunless

@isset($post['has_comments'])
    <h3>It has comments, using isset.</h3>
@endisset

@if(now()->diffInMinutes($post->created_at) < 20)
    <x-badge type='success'>
        Brand new post!
    </x-badge>
@endif

<h1>{{ $post['title'] }}
</h1>
<p>{{ $post['content'] }}</p>
<x-updated :date="$post->created_at" :name="$post->user->name"></x-updated>

<h4>Comments</h4>
@forelse ($post->comments as $comment)
<p>{{$comment->context}}</p>
<p class="text-muted">added {{$comment->created_at->diffForHumans()}}</p>
@empty
<p>No comments here!</p>
@endforelse
@endsection

