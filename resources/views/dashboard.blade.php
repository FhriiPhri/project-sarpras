@extends('layouts.app')

@section('title', 'Dashboard')
@section('content')

<div class="container">
    <div class="dashboard-content">
        <h1 class="welcome-message">Welcome, {{ Auth::user()->name }}! 👋👋</h1>
        
        <div class="user-info">
            <p><strong>Name :</strong> {{ Auth::user()->name }}</p>
            <p><strong>Username :</strong> {{ Auth::user()->username }}</p>
            <p><strong>Email :</strong> {{ Auth::user()->email }}</p>
            <p><strong>Account Created :</strong> {{ Auth::user()->created_at->format('j F Y - H:i') }} WIB</p>
        </div>

        <div style="margin-top: 30px;">
            <a href="{{ route('profile') }}" class="btn" style="display: inline-block; width: auto; padding: 10px 20px;">View My Profile</a>
        </div>
    </div>
</div>
@endsection