  <div class="sidebar">
      <div class="sidebar-header">
          <div class="user-profile">
              <div class="avatar">
                  <img src="{{asset('storage/'.$user->profile_image)}}" alt="User">
              </div>
              <span style="font-weight: 500;">My Profile</span>
          </div>
          <div class="header-icons">
              <button id="openModalBtn" class="icon-btn">⚙️</button>
          </div>
      </div>

      <div class="search-box">
          <input type="text" class="search-input" placeholder="Search or start new chat">
      </div>

      @livewire('chat-list')
  </div>
