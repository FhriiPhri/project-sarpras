@extends('layouts.app')

@section('title', 'My Profile')
@section('content')
<div class="dashboard-content">
    <div class="profile-header">
        <h1 class="welcome-message">My Profile</h1>
        <div class="profile-actions">
            <a href="{{ route('profile.edit') }}" class="btn">Edit Profile</a>
            <form action="{{ route('profile.delete') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">
                    Delete Account
                </button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="profile-info">
        <div class="profile-avatar">
            <div class="avatar-initial">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="avatar-details">
                <h2>{{ Auth::user()->name }}</h2>
                <p>{{ Auth::user()->username }}</p>
            </div>
        </div>

        <div class="account-details">
            <h3>Account Information</h3>
            <div class="details-grid">
                <div class="detail-item">
                    <span class="detail-label">Name</span>
                    <span class="detail-value">{{ Auth::user()->name }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Email</span>
                    <span class="detail-value">{{ Auth::user()->email }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Account Created</span>
                    <span class="detail-value">{{ Auth::user()->created_at->format('j F Y - H:i') }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Last Updated</span>
                    <span class="detail-value">{{ Auth::user()->updated_at->format('j F Y - H:i') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Profile Specific Styles */
    .profile-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 20px;
    }

    .profile-actions {
        display: flex;
        gap: 15px;
    }

    .profile-info {
        max-width: 800px;
        margin: 0 auto;
    }

    .profile-avatar {
        display: flex;
        align-items: center;
        margin-bottom: 30px;
        gap: 20px;
    }

    .avatar-details h2 {
        margin-bottom: 5px;
        font-size: 1.5rem;
    }

    .avatar-details p {
        color: var(--gray-color);
    }

    .account-details {
        background: white;
        border-radius: 8px;
        padding: 25px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .account-details h3 {
        color: var(--primary-color);
        margin-bottom: 20px;
        font-size: 1.3rem;
    }

    .details-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }

    .detail-item {
        display: flex;
        flex-direction: column;
    }

    .detail-label {
        color: var(--gray-color);
        font-size: 0.9rem;
        margin-bottom: 5px;
    }

    .detail-value {
        font-weight: 500;
    }

    @media (max-width: 576px) {
        .profile-actions {
            flex-direction: column;
            width: 100%;
        }
        
        .profile-actions .btn {
            width: 100%;
        }
        
        .profile-avatar {
            flex-direction: column;
            text-align: center;
        }
    }
</style>
@endsection