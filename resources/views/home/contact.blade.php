@extends('layout.app')

@section('title', 'Contact List')

@section('content')
<h1>Contact List</h1>
@can('home.secret')
<p><a href="{{route('secret')}}"> Special Contact List</a></p>
@endcan
@endsection
