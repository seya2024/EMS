<div id="chatbox"
     class="fixed bottom-4 right-4 w-80 bg-white shadow-lg rounded-xl overflow-hidden flex flex-col"
     style="z-index: 9999;">
    
    <div class="bg-purple-700 text-white p-2 font-semibold cursor-pointer" onclick="toggleChat()">
        Chat Support
    </div>

    <div id="chat-messages" class="flex-1 p-2 overflow-y-auto hidden bg-gray-50"></div>

    <div id="chat-input" class="p-2 hidden border-t border-gray-200">
        <input id="chat-text" type="text" class="w-full border rounded px-2 py-1" placeholder="Type a message..." 
               onkeydown="if(event.key==='Enter'){sendMessage()}">
    </div>
</div>

<script>
function toggleChat() {
    const messages = document.getElementById('chat-messages');
    const input = document.getElementById('chat-input');
    messages.classList.toggle('hidden');
    input.classList.toggle('hidden');
}

// Initialize Laravel Echo for Reverb
import Echo from 'laravel-echo';
window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher', // Reverb speaks Pusher protocol
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT,
    forceTLS: false,
    disableStats: true,
});

// Subscribe to user-specific channel
window.Echo.private('chat.' + {{ auth()->id() }})
    .listen('ChatMessageSent', (e) => {
        const messages = document.getElementById('chat-messages');
        const div = document.createElement('div');
        div.textContent = e.message;
        div.classList.add('my-1', 'p-1', 'bg-purple-100', 'rounded');
        messages.appendChild(div);
        messages.scrollTop = messages.scrollHeight;
    });

function sendMessage() {
    const input = document.getElementById('chat-text');
    const msg = input.value.trim();
    if(!msg) return;

    fetch('/chat/send', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ message: msg })
    });
    input.value = '';
}
</script>
