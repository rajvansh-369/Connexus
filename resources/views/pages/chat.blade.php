@extends('pages.layout.app')
@section('content')
    <!-- Chat Area -->



    @livewire('chat')



    <div id="myModal" class="modal">
        <div class="modal-content">
            <span id="closeModalBtn" class="close">&times;</span>
            <div class="container_profile_edit">
                <div class="header">
                    <h1>Edit Profile</h1>
                    <p>Update your personal information and preferences</p>
                </div>

                <div class="profile-content">


                    {{-- @dd($user); --}}
                    @livewire('profile-edit')
                </div>
            </div>

        </div>
    </div>
    <!-- Profile Panel (Optional - Hidden by default) -->
    <div class="profile-panel">
        <div class="profile-header">
            <h2>Contact Info</h2>
        </div>
        <div class="profile-content">
            <div class="profile-avatar-large">SJ</div>

            <div class="profile-section">
                <h3>Name</h3>
                <p>Sarah Johnson</p>
            </div>

            <div class="profile-section">
                <h3>About</h3>
                <p>Love traveling and photography 📸</p>
            </div>

            <div class="profile-section">
                <h3>Phone</h3>
                <p>+1 234 567 8900</p>
            </div>

            <div class="profile-section">
                <h3>Email</h3>
                <p>sarah.johnson@example.com</p>
            </div>
        </div>
    </div>

    
@endsection
