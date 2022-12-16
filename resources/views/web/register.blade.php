@extends("welcome")
@section('title', 'Trang chủ')
@section('content')
<div style="background: rgba(57, 145, 172, 0.067);">
    <div class="container">

        <h1>Register Form</h1>

        @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
            @php
                Session::forget('success');
            @endphp
        </div>
        @endif


        <form method="POST" action="{{ route('user.registration') }}">

            {{ csrf_field() }}

            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" class="form-control" placeholder="Name">
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" class="form-control" placeholder="Password">
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="form-group">
                <strong>Email:</strong>
                <input type="text" name="email" class="form-control" placeholder="Email">
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="form-group">
                <button class="btn btn-success btn-submit" action="{{route('user.login')}}">Submit</button>
            </div>
        </form>
        <div>
            <a class="btn btn-sm btn-success" href="{{route('auth.login')}}">Login</a>
        </div>
    </div>
</div>
</html>
@endsection
