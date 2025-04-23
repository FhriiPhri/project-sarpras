@extends('layouts.app')

@section('title', 'Home')
@section('content')
<div class="auth-container">
    <div class="auth-card" style="text-align: center;">
        <div class="auth-header">
            <h2>Laravel Authentication System</h2>
            <p>A complete authentication system built with Laravel</p>
        </div>

        <div style="margin: 30px 0;">
            <a href="{{ route('login') }}" class="btn" style="margin-bottom: 15px;">Login</a>
            <a href="{{ route('register') }}" class="btn" style="background: white; color: var(--primary-color); border: 1px solid var(--primary-color);">Register</a>
        </div>
    </div>
</div>
@endsection