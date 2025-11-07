  <div class="chat-list" wire:ignore>
      {{-- @dd($getChatLists) --}}
      @foreach ($getChatLists as $getChatList)

      {{-- @dd($getChatList) --}}
          @php
              $allMessages = $user->allMessages()->sortByDesc('created_at');
          @endphp
          {{-- @dd($getChatList) --}}
          <div class="chat-item active" data-id="{{ $getChatList['chat_id']}}" wire:click="openChat({{ $getChatList['chat_id'] }})">
              <div class="chat-avatar">
                  <img src="{{ asset('storage/' . $getChatList['profile_image']) }}" alt="User">
              </div>
              <div class="chat-info">
                  {{-- @dd(  $allMessages->first()) --}}
                  <div class="chat-header">
                      <span class="chat-name">{{ $getChatList['other_user_name']}}</span>
                      <span
                          class="chat-time">{{ \Carbon\Carbon::parse($allMessages->first()->created_at ?? \Carbon\Carbon::now())->format('h:i A') }}</span>
                  </div>
                  <div class="chat-preview">
                      <span class="chat-message">{{ $allMessages->first()?->message }}</span>
                      <span class="unread-badge">3</span>
                  </div>
              </div>
          </div>
      @endforeach

      <script>
          document.addEventListener('updateChatWindow', event => {
              window.authUserId = event.detail.chatId;
              console.log('Updated authUserId:', window.authUserId);
          });
      </script>
  </div>
