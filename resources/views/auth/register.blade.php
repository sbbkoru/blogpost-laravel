@extends('layout.app');
@section('content')
<form action="{{route('register')}}" method="POST">
    @csrf

    <div class="form-group">
        <label for="name">Name</label>
            <input type="text" name="name" value="{{old('name')}}" required class="form-control{{$errors->has('name') ? ' is-invalid' : ''}}">
            @if ($errors->has('name'))
                <span class="invalid-feedback">
                    <strong>{{$errors->first('name')}}</strong>
                </span>
            @endif
    </div>

    <div class="form-group">
        <label for="email">Email</label>
            <input type="text" name="email" value="{{old('email')}}" required class="form-control{{$errors->has('email') ? ' is-invalid' : ''}}">
            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{$errors->first('email')}}</strong>
                </span>
            @endif
        </div>

    <div class="form-group">
        <label for="password">Password</label>
            <input type="text" name="password" value="" required class="form-control{{$errors->has('password') ? ' is-invalid' : ''}}" type="password">
            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{$errors->first('password')}}</strong>
                </span>
            @endif
        </div>

    <div class="form-group">
        <label for="">Retyped Password</label>
            <input type="text" name="password_confirmation" value="" required class="form-control" type="password">
    </div>

    <button type="submit" class="btn btn-info btn-block mt-2">Register!</button>
</form>
@endsection
