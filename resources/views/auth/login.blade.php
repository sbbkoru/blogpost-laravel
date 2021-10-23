@extends('layout.app');
@section('content')
<form action="{{route('login')}}" method="POST">
    @csrf

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
            <input type="password" name="password" value="" required class="form-control{{$errors->has('password') ? ' is-invalid' : ''}}" type="password">
            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{$errors->first('password')}}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="remember" value="{{old('remember') ? 'checked' : ''}}">
                <label for="remember">Remember Me</label>
            </div>
        </div>

    <button type="submit" class="btn btn-info btn-block mt-2">Login!</button>
</form>
@endsection
