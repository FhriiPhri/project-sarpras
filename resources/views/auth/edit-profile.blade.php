@extends('layouts.app')

@section('title', 'Edit Profile')
@section('content')
<div class="dashboard-content">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h1 class="welcome-message">Edit Profile</h1>
        <a href="{{ route('profile') }}" class="btn" style="padding: 8px 16px;">Back to Profile</a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="errors">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="max-width: 600px; margin: 0 auto;">
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', Auth::user()->name) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', Auth::user()->email) }}" required>
            </div>

            <button type="submit" class="btn" style="margin-top: 20px;">Update Profile</button>
        </form>
    </div>
</div>
@endsection