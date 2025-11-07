  <div class="chat-area">

      {{-- @dd($chatWindowUser) --}}
      {{-- @if ($receiverId != auth()->user()->id) --}}
      <div class="chat-header-bar">
          <div class="chat-header-info">
              <div class="chat-avatar">
                  <img src="{{ asset('storage/' . $chatWindowUser?->profile_image) }}" alt="User">
              </div>
              <div class="chat-header-details">
                  <h3>{{ $chatWindowUser?->name }}</h3>
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

          {{-- @if ($receivedMessages)
              @foreach ($receivedMessages as $message)
                  <div class="message received">
                      <div class="message-bubble">
                          <div class="message-content">
                              {{ $message->message }}
                          </div>
                          <div class="message-footer">
                              <span class="message-time">10:30 AM</span>
                          </div>
                      </div>
                  </div>
              @endforeach
          @endif --}}


          {{-- @dd($sentMessages, $receivedMessages) --}}
          @if ($allMessages)
              @foreach ($allMessages as $message)
                  @if ($message->from_user_id == auth()->user()->id)
                      <div class="message sent">
                          {{-- @dd($sentMessages, $message) --}}
                          <div class="message-bubble">
                              <div class="message-content">
                                  {{ $message->message }}
                              </div>
                              <div class="message-footer">
                                  <span
                                      class="message-time">{{ \Carbon\Carbon::parse($message->created_at)->format('h:i A') }}</span>
                                  <span class="message-status read">✓✓</span>
                              </div>
                          </div>
                      </div>
                  @else
                      <div class="message received">
                          <div class="message-bubble">
                              <div class="message-content">
                                  {{ $message->message }}
                              </div>
                              <div class="message-footer">
                                  <span
                                      class="message-time">{{ \Carbon\Carbon::parse($message->created_at)->format('h:i A') }}</span>
                              </div>
                          </div>
                      </div>
                  @endif
              @endforeach
          @endif

          {{-- <div class="message received">
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
          </div> --}}
      </div>


      <div class="input-area">
          <div class="input-actions">
              <button class="attach-btn" title="Attach file">📎</button>
              <button class="attach-btn" title="Attach image">📷</button>
          </div>
          <div class="message-input-wrapper">
              <textarea class="message-input"wire:model="message" placeholder="Type a message" rows="1"></textarea>
              <input type="hidden" wire:model="receiverId" value="2" />
              <button class="emoji-btn">😊</button>
          </div>
          <button class="send-btn" wire:click="sendMessage" wire:loading.attr="disabled">
              <span wire:loading.remove>➤</span>
              <span wire:loading>⏳</span>
          </button>
      </div>
      <script>
          // Auto-resize textarea
          const textarea = document.querySelector('.message-input');
          textarea.addEventListener('input', function() {
              this.style.height = 'auto';
              this.style.height = Math.min(this.scrollHeight, 100) + 'px';
          });

          // Send message on Enter (but allow Shift+Enter for new line)
          textarea.addEventListener('keypress', function(e) {
              if (e.key === 'Enter' && !e.shiftKey) {
                  e.preventDefault();
                  // Add your send message logic here
                  console.log('Message sent:', this.value);
                  this.value = '';
                  this.style.height = 'auto';
              }
          });
      </script>
      {{-- @endif --}}



      <script>
          window.authUserId = {{ $chatId }};
      </script>
      <script>
          // Wait for Echo to be initialized
          setTimeout(() => {
              if (window.Echo) {
                  window.Echo.private(`chat.${window.authUserId}`)
                      .listen('MessageSent', (e) => {

                          window.Livewire.dispatch('livewireMessageReceived', {
                              message: e.message,
                          });
                          console.log('Received message private:', e.message);
                      });
                  console.log('Event listener attached');
              } else {
                  console.log('Echo is not initialized');
              }
          }, 1000);
      </script>
      {{-- <script>
          // Wait for Echo to be initialized
          setTimeout(() => {
              if (window.Echo) {
                  window.Echo.channel('test-channel')
                      .listen('.TestBroadcast', (e) => {
                          console.log('Received message:', e);
                          // Emit event to Livewire only
                          // Livewire.emit('livewireMessageReceived', e.message);
                          window.Livewire.dispatch('livewireMessageReceived', {
                              message: e.message
                          });
                      });
                  console.log('Event listener attached');
              } else {
                  console.log('Echo is not initialized');
              }
          }, 1000);
      </script> --}}
  </div>
