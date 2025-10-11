@extends('pages.layout.app')
@section('content')
    <!-- Chat Area -->
    <div class="chat-area">
        <div class="chat-header-bar">
            <div class="chat-header-info">
                <div class="chat-avatar">
                    <img src="https://via.placeholder.com/50" alt="User">
                </div>
                <div class="chat-header-details">
                    <h3>Sarah Johnson</h3>
                    <p>Online</p>
                </div>
            </div>
            <div class="chat-actions">
                <button class="icon-btn">🔍</button>
                <button class="icon-btn">⋮</button>
            </div>
        </div>

        <div class="messages-container">
            <div class="message-date">
                <span>Today</span>
            </div>

            <div class="message received">
                <div class="message-bubble">
                    <div class="message-content">
                        Hey! How are you doing?
                    </div>
                    <div class="message-footer">
                        <span class="message-time">10:30 AM</span>
                    </div>
                </div>
            </div>

            <div class="message sent">
                <div class="message-bubble">
                    <div class="message-content">
                        I'm doing great! Thanks for asking. How about you?
                    </div>
                    <div class="message-footer">
                        <span class="message-time">10:32 AM</span>
                        <span class="message-status read">✓✓</span>
                    </div>
                </div>
            </div>

            <div class="message received">
                <div class="message-bubble">
                    <img src="https://via.placeholder.com/300x200" alt="Shared image" class="message-image">
                    <div class="message-content">
                        Check out this amazing view from my trip!
                    </div>
                    <div class="message-footer">
                        <span class="message-time">2:15 PM</span>
                    </div>
                </div>
            </div>

            <div class="message sent">
                <div class="message-bubble">
                    <div class="message-content">
                        Wow! That's absolutely beautiful! Where is this?
                    </div>
                    <div class="message-footer">
                        <span class="message-time">2:20 PM</span>
                        <span class="message-status read">✓✓</span>
                    </div>
                </div>
            </div>

            <div class="message received">
                <div class="message-bubble">
                    <div class="message-content">
                        This is from the mountains in Switzerland. We should plan a trip together sometime!
                    </div>
                    <div class="message-footer">
                        <span class="message-time">2:40 PM</span>
                    </div>
                </div>
            </div>

            <div class="message sent">
                <div class="message-bubble">
                    <div class="message-content">
                        That sounds great! See you then 👍
                    </div>
                    <div class="message-footer">
                        <span class="message-time">2:45 PM</span>
                        <span class="message-status">✓</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="input-area">
            <div class="input-actions">
                <button class="attach-btn" title="Attach file">📎</button>
                <button class="attach-btn" title="Attach image">📷</button>
            </div>
            <div class="message-input-wrapper">
                <textarea class="message-input" placeholder="Type a message" rows="1"></textarea>
                <button class="emoji-btn">😊</button>
            </div>
            <button class="send-btn">➤</button>
        </div>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span id="closeModalBtn" class="close">&times;</span>
            <div class="container_profile_edit">
                <div class="header">
                    <h1>Edit Profile</h1>
                    <p>Update your personal information and preferences</p>
                </div>

                <div class="profile-content">
                    <div class="success-message" id="successMessage">
                        ✓ Profile updated successfully!
                    </div>

                    <div class="profile-image-section">
                        <div class="image-upload-container">
                            <img src="https://via.placeholder.com/150" alt="Profile" class="profile-image"
                                id="profileImage">
                            <label class="upload-btn">
                                <input type="file" accept="image/*" id="imageUpload">
                                <span>📷</span>
                            </label>
                        </div>
                    </div>

                    <form id="profileForm">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="firstName">First Name</label>
                                <div class="input-icon" data-icon="👤">
                                    <input type="text" id="firstName" placeholder="Enter first name" value="John"
                                        required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="lastName">Last Name</label>
                                <div class="input-icon" data-icon="👤">
                                    <input type="text" id="lastName" placeholder="Enter last name" value="Doe"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <div class="input-icon" data-icon="📧">
                                <input type="email" id="email" placeholder="your.email@example.com"
                                    value="john.doe@example.com" required>
                            </div>
                            <p class="helper-text">We'll never share your email with anyone else</p>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <div class="input-icon" data-icon="📱">
                                <input type="tel" id="phone" placeholder="+1 (555) 123-4567"
                                    value="+1 (555) 123-4567">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="about">About Me</label>
                            <textarea id="about" placeholder="Tell us something about yourself...">I'm a passionate professional who loves connecting with people and exploring new technologies.</textarea>
                            <p class="helper-text">Brief description for your profile (max 500 characters)</p>
                        </div>

                        <div class="button-group">
                            <button type="button" class="btn btn-secondary" onclick="handleCancel()">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
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
