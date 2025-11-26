@extends('layout.frontend')
@section('content')

<div class="container mt-5">
    <div class="row">

        {{-- Profile Info --}}
        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <h4>Profile</h4>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">{{ $errors->first() }}</div>
                @endif

                <form action="{{ url('/profile') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Profile Picture --}}
                    <div class="mb-3 text-center">
                        <img src="{{ $user->profile_picture ? asset('storage/'.$user->profile_picture) : 'https://via.placeholder.com/150' }}" class="img-thumbnail" width="150">
                        <input type="file" name="profile_picture" class="form-control mt-2">
                    </div>

                    {{-- Bio --}}
                    <div class="mb-3">
                        <label>Bio</label>
                        <textarea name="bio" class="form-control" rows="3">{{ $user->bio }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Update Profile</button>
                </form>
            </div>
        </div>

        {{-- Projects --}}
        <div class="col-md-8">
            <div class="card p-3 shadow-sm">
                <h4>My Projects</h4>

                {{-- Add project --}}
                <form action="{{ url('/profile/project') }}" method="POST" class="mb-3">
                    @csrf
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" name="title" class="form-control" placeholder="Project Title" required>
                        </div>
                        <div class="col-md-5">
                            <input type="text" name="description" class="form-control" placeholder="Description or link">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success w-100">Add</button>
                        </div>
                    </div>
                </form>

                {{-- Display projects --}}
                <ul class="list-group">
                    @forelse($projects as $index => $project)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $project['title'] }}</strong> - {{ $project['description'] ?? 'No description' }}
                            </div>
                            <form action="{{ url('/profile/project/delete/'.$index) }}" method="POST" onsubmit="return confirm('Delete this project?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </li>
                    @empty
                        <li class="list-group-item">No projects yet.</li>
                    @endforelse
                </ul>
            </div>
        </div>

    </div>
</div>

@endsection
