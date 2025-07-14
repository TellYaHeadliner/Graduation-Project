<script>

    window.Pusher = Pusher;

    const Echo = new window.Echo({
        broadcaster: 'reverb',
        key: "{{ env('REVERB_APP_KEY') }}",
        wsHost: "{{ env('REVERB_HOST', request()->getHost()) }}",
        wsPort: {{ env('REVERB_PORT', 80) }},
        wssPort: {{ env('REVERB_PORT', 443) }},
        forceTLS: "{{ env('REVERB_SCHEME', 'http') }}" === 'https',
        enabledTransports: ['ws', 'wss'],
        withCredentials: false,
        authEndpoint: "{{ url('/broadcasting/auth') }}",
    });

    const userId = {{ auth()->id() }};
    let currentConversationId = null;

    function loadConversation(id) {
        currentConversationId = id;

        fetch(`/hotel/chat/message/${userId}/${id}`)
            .then(res => res.json())
            .then(res => {
                const box = document.getElementById('message-list');
                box.innerHTML = '';

                res.messages.forEach(msg => {
                    const div = document.createElement('div');
                    div.className = 'mb-2';
                    div.innerHTML = `<div class="${msg.sender_id === userId ? 'text-right' : 'text-left'}">
                        <span class="inline-block px-3 py-2 rounded bg-${msg.sender_id === userId ? 'blue' : 'gray'}-200">
                            ${msg.content}
                        </span>
                    </div>`;
                    box.appendChild(div);
                });

                box.scrollTop = box.scrollHeight;
            });
    }

    function sendMessage() {
        const input = document.getElementById('chat-input');
        if (!input.value.trim()) return;

        fetch(`/hotel/chat/send-message/${userId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                conversation_id: currentConversationId,
                content: input.value
            })
        }).then(res => res.json()).then(res => {
            input.value = '';
        });
    }

    Echo.private('conversation.' + userId)
        .listen('MessageSent', (e) => {
            if (e.conversation_id == currentConversationId) {
                loadConversation(currentConversationId);
            } else {

                const list = document.getElementById('conversation-list');
                const convoEl = document.getElementById('conversation-' + e.conversation_id);
                if (convoEl) {
                    list.prepend(convoEl);
                }
            }
        });
</script>