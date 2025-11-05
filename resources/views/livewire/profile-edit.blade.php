<div>
    @if (Session::has('success'))
        <div class="success-message" id="successMessage">
            ✓ Profile updated successfully!
        </div>
    @endif
    
    <form id="profileForm" enctype="multipart/form-data" wire:submit.prevent="save">
        <div class="profile-image-section">
            <div class="image-upload-container">
                <img src="{{asset('storage/'.$profile_image)}}"  alt="Profile" class="profile-image" id="profileImage">
                <label class="upload-btn">
                    <input type="file" wire:model="profile_image" accept="image/*" id="imageUpload">
                    <span>📷</span>
                </label>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="firstName">First Name</label>
                <div class="input-icon" data-icon="👤">
                    <input wire:model="first_name" type="text" id="firstName" placeholder="Enter first name"
                        value="John" required>
                </div>
            </div>

            <div class="form-group">
                <label for="lastName">Last Name</label>
                <div class="input-icon" data-icon="👤">
                    <input type="text" wire:model="lastName" id="lastName" placeholder="Enter last name"
                        value="Doe" required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <div class="input-icon" data-icon="📧">
                <input type="email" wire:model="email" id="email" placeholder="your.email@example.com"
                    value="john.doe@example.com" required>
            </div>
            <p class="helper-text">We'll never share your email with anyone else</p>
        </div>

        <div class="form-group">
            <label for="phone">Phone Number</label>
            <div class="input-icon" data-icon="📱">
                <input type="tel" wire:model="phone" id="phone" placeholder="+1 (555) 123-4567"
                    value="+1 (555) 123-4567">
            </div>
        </div>

        <div class="form-group">
            <label for="about">About Me</label>
            <textarea id="about" wire:model="about" placeholder="Tell us something about yourself...">I'm a passionate professional who loves connecting with people and exploring new technologies.</textarea>
            <p class="helper-text">Brief description for your profile (max 500 characters)</p>
        </div>

        <div class="button-group">
            <button type="button" class="btn btn-secondary" onclick="handleCancel()">Cancel</button>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form>


</div>
