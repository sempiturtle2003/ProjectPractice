@extends('layout.frontend')

@section('content')

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">

        <a class="navbar-brand" href="{{ url('/homepage') }}">My Website</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto">

                {{-- Profile link --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/profile') }}">Profile</a>
                </li>

                {{-- About link --}}
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>

                {{-- Logout --}}
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm ms-3">Logout</button>
                    </form>
                </li>

            </ul>

        </div>

    </div>
</nav>

<div class="container">
    <div class="card shadow p-4">
        <h2>Welcome, {{ session('user_name') }}!</h2>
        <p>This is your homepage. Use the navigation bar to visit your profile, see your projects, or logout.</p>
    </div>
</div>

@endsection
