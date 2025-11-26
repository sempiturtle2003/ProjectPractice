@extends('layout.frontend')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm p-4">
                <h3 class="text-center mb-4">Login</h3>

                @if($errors->any())
                    <div class="alert alert-danger">{{ $errors->first() }}</div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ url('/login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Email Address</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Login</button>

                    <div class="text-center mt-3">
                        <a href="{{ url('/change-password') }}">Forgot your password?</a>
                    </div>

                    <div class="text-center mt-2">
                        <p>Don't have an account? <a href="{{ url('/signup') }}">Sign up</a></p>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
