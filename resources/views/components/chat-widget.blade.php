@php
    use App\Models\Client;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Session;

    $isClient = false;
    $clientId = 'null';
    $clientName = 'Tamu';

    // 1. CEK SESSION (Ini yang Anda gunakan di Controller Login)
    if (Session::has('client_id')) {
        $clientData = Client::find(Session::get('client_id'));
        
        // Pastikan datanya ada di database
        if ($clientData) {
            $isClient = true;
            $clientId = $clientData->id;
            $clientName = $clientData->nama_lengkap;
        }
    }
    
    // HAPUS BAGIAN "elseif (Auth::guard('client')->check())" 
    // KARENA ITU PENYEBAB ERRORNYA.

    $mode = $isClient ? 'client' : 'guest';
@endphp

<style>
    /* Floating Chat Button */
    .chat-widget-button {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        z-index: 9998;
        transition: transform 0.3s;
    }

    .chat-widget-button:hover {
        transform: scale(1.1);
    }

    .chat-widget-button svg {
        width: 30px;
        height: 30px;
        fill: white;
    }

    .chat-widget-button.hidden {
        display: none;
    }

    .unread-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background: #ff4757;
        color: white;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: bold;
        border: 2px solid white;
    }

    /* Chat Window */
    .chat-widget-window {
        position: fixed;
        bottom: 90px;
        right: 20px;
        width: 380px;
        height: 600px;
        max-height: calc(100vh - 120px);
        background: white;
        border-radius: 16px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
        z-index: 9999;
        display: none;
        flex-direction: column;
        overflow: hidden;
        font-family: 'Instrument Sans', sans-serif;
    }

    .chat-widget-window.open {
        display: flex;
    }

    /* Header */
    .chat-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .chat-header-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .chat-avatar {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 18px;
    }

    .chat-title h3 {
        font-size: 16px;
        font-weight: 600;
        margin: 0 0 2px 0;
    }

    .chat-title p {
        font-size: 12px;
        opacity: 0.9;
        margin: 0;
    }

    .close-button {
        background: none;
        border: none;
        color: white;
        cursor: pointer;
        padding: 5px;
        font-size: 24px;
        line-height: 1;
    }

    /* Messages */
    .messages-area {
        flex: 1;
        overflow-y: auto;
        padding: 20px;
        background: #f5f5f5;
    }

    .message {
        margin-bottom: 16px;
        display: flex;
        animation: slideIn 0.3s ease-out;
    }

    @keyframes slideIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .message.sent { justify-content: flex-end; }
    .message.received { justify-content: flex-start; }

    .message-bubble {
        max-width: 75%;
        padding: 10px 14px;
        border-radius: 12px;
        word-wrap: break-word;
    }

    .message.sent .message-bubble {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 12px 12px 4px 12px;
    }

    .message.received .message-bubble {
        background: white;
        color: #333;
        border-radius: 12px 12px 12px 4px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }

    .message-text {
        font-size: 14px;
        line-height: 1.5;
        margin-bottom: 4px;
    }

    .message-time {
        font-size: 11px;
        opacity: 0.7;
        text-align: right;
    }

    /* Input Area */
    .input-area {
        padding: 16px;
        background: white;
        border-top: 1px solid #e0e0e0;
        display: flex;
        gap: 10px;
        align-items: flex-end;
    }

    .message-input {
        flex: 1;
        padding: 10px 14px;
        border: 1px solid #e0e0e0;
        border-radius: 20px;
        font-size: 14px;
        outline: none;
        resize: none;
        max-height: 100px;
        min-height: 40px;
        font-family: inherit;
    }

    .message-input:focus { border-color: #667eea; }

    .send-button {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 50%;
        color: white;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.2s;
        flex-shrink: 0;
    }

    .send-button:hover { transform: scale(1.1); }
    .send-button svg { width: 18px; height: 18px; fill: white; }

    /* Welcome Message */
    .welcome-message {
        background: white;
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 16px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
    }
    .welcome-message h4 { color: #667eea; margin-bottom: 8px; font-size: 16px; }
    .welcome-message p { color: #666; font-size: 14px; line-height: 1.5; }

    /* Scrollbar */
    .messages-area::-webkit-scrollbar { width: 6px; }
    .messages-area::-webkit-scrollbar-track { background: transparent; }
    .messages-area::-webkit-scrollbar-thumb { background: rgba(0, 0, 0, 0.2); border-radius: 3px; }

    /* Mobile Responsive */
    @media (max-width: 480px) {
        .chat-widget-window {
            width: calc(100vw - 20px);
            height: calc(100vh - 100px);
            right: 10px;
            bottom: 80px;
        }
    }

    /* Client Mode Styling */
    .chat-header.client-mode,
    .message.sent.client-mode .message-bubble,
    .send-button.client-mode,
    .chat-widget-button.client-mode {
        background: linear-gradient(135deg, #991b1b 0%, #7f1d1d 100%); /* Merah khas App Hukum */
    }
</style>

<div class="chat-widget-button {{ $mode === 'client' ? 'client-mode' : '' }}" id="chatButton">
    <svg viewBox="0 0 24 24">
        <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H6l-2 2V4h16v12z"/>
    </svg>
    <span class="unread-badge" id="unreadBadge" style="display: none;">0</span>
</div>

<div class="chat-widget-window" id="chatWindow">
    <div class="chat-header {{ $mode === 'client' ? 'client-mode' : '' }}" id="chatHeader">
        <div class="chat-header-info">
            <div class="chat-avatar">
                {{ $mode === 'client' ? '👤' : '⚖️' }}
            </div>
            <div class="chat-title">
                <h3 id="chatTitle">
                    {{ $mode === 'client' ? 'Support (Client)' : 'Layanan Pelanggan' }}
                </h3>
                <p id="chatSubtitle">Online</p>
            </div>
        </div>
        <button class="close-button" id="closeButton">×</button>
    </div>

    <div class="messages-area" id="messagesArea">
        <div class="welcome-message">
            <h4>👋 Halo, {{ $clientName }}!</h4>
            <p>
                @if($mode === 'client')
                    Terima kasih telah login. Ada kendala hukum yang bisa kami bantu?
                @else
                    Selamat datang! Silakan chat sebagai tamu untuk bertanya info umum.
                @endif
            </p>
        </div>
    </div>

    <div class="input-area">
        <textarea 
            class="message-input" 
            id="messageInput" 
            placeholder="Ketik pesan..."
            rows="1"
        ></textarea>
        <button class="send-button {{ $mode === 'client' ? 'client-mode' : '' }}" id="sendButton">
            <svg viewBox="0 0 24 24">
                <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
            </svg>
        </button>
    </div>
</div>

<script>
    // Konfigurasi Dinamis dari PHP Blade
    const CONFIG = {
        API_BASE_URL: "{{ url('/api') }}", 
        MODE: "{{ $mode }}",           // 'client' atau 'guest'
        CLIENT_ID: {{ $clientId }},    // ID Client (integer) atau null
        AUTO_REFRESH_INTERVAL: 3000
    };

    console.log("Chat Widget Config:", CONFIG); // Debugging: Cek di Console Browser

    let guestToken = localStorage.getItem('chat_guest_token');
    let messages = [];
    let refreshInterval = null;
    let isOpen = false;
    let unreadCount = 0;

    const chatButton = document.getElementById('chatButton');
    const chatWindow = document.getElementById('chatWindow');
    const messagesArea = document.getElementById('messagesArea');
    const messageInput = document.getElementById('messageInput');
    const sendButton = document.getElementById('sendButton');
    const closeButton = document.getElementById('closeButton');
    const unreadBadge = document.getElementById('unreadBadge');

    // --- Event Listeners ---
    chatButton.addEventListener('click', toggleChat);
    closeButton.addEventListener('click', toggleChat);
    sendButton.addEventListener('click', sendMessage);
    messageInput.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); sendMessage(); }
    });

    // --- LOGIC FUNCTIONS ---

    async function initialize() {
        // HANYA generate guest token jika mode adalah GUEST
        if (CONFIG.MODE === 'guest') {
            if (!guestToken) {
                try {
                    const res = await fetch(`${CONFIG.API_BASE_URL}/chat/guest/generate-token`);
                    const data = await res.json();
                    guestToken = data.guest_token;
                    localStorage.setItem('chat_guest_token', guestToken);
                } catch (e) { console.error("Gagal generate token:", e); }
            }
        }
        loadMessages();
    }

    function toggleChat() {
        isOpen = !isOpen;
        chatWindow.classList.toggle('open', isOpen);
        chatButton.classList.toggle('hidden', isOpen);
        
        if (isOpen) {
            messageInput.focus();
            loadMessages(); // Load immediately
            if (refreshInterval) clearInterval(refreshInterval);
            refreshInterval = setInterval(loadMessages, CONFIG.AUTO_REFRESH_INTERVAL);
            unreadCount = 0;
            updateUnreadBadge();
            scrollToBottom();
        } else {
            if (refreshInterval) {
                clearInterval(refreshInterval);
                refreshInterval = null;
            }
        }
    }

    async function loadMessages() {
        try {
            let url;
            // PENTING: Pembedaan URL berdasarkan MODE
            if (CONFIG.MODE === 'client') {
                // Endpoint: /api/chat/client/{id_client}
                url = `${CONFIG.API_BASE_URL}/chat/client/${CONFIG.CLIENT_ID}`;
            } else {
                // Endpoint: /api/chat/guest/{guest_token}
                url = `${CONFIG.API_BASE_URL}/chat/guest/${guestToken}`;
            }

            const response = await fetch(url);
            const result = await response.json();

            if (result.success) {
                const newMessages = result.data;
                // Render ulang hanya jika ada pesan baru/beda jumlah
                if (newMessages.length !== messages.length) {
                    messages = newMessages;
                    renderMessages();
                    if(!isOpen) {
                        // Logic unread count simpel (bisa dikembangkan)
                        unreadCount = 1; 
                        updateUnreadBadge();
                    }
                }
            }
        } catch (error) {
            console.error('Error loading messages:', error);
        }
    }

    async function sendMessage() {
        const text = messageInput.value.trim();
        if (!text) return;

        // Optimistic UI Update
        addMessageToUI(text, 'sent');
        messageInput.value = '';
        messageInput.style.height = '40px'; 
        scrollToBottom();

        try {
            let url, bodyData;

            // PENTING: Pembedaan Endpoint SEND
            if (CONFIG.MODE === 'client') {
                url = `${CONFIG.API_BASE_URL}/chat/client/send`;
                bodyData = {
                    id_client: CONFIG.CLIENT_ID,
                    isi_pesan: text
                };
            } else {
                url = `${CONFIG.API_BASE_URL}/chat/guest/send`;
                bodyData = {
                    guest_token: guestToken,
                    isi_pesan: text
                };
            }

            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(bodyData)
            });
            
            const result = await response.json();
            if(!result.success) {
                console.error("Server Error:", result.message);
                alert("Gagal kirim pesan: " + result.message);
            } else {
                // Load ulang untuk dapat timestamp server dll
                loadMessages(); 
            }
        } catch (error) {
            console.error('Network Error sending message:', error);
        }
    }

    function renderMessages() {
        // Reset area
        messagesArea.innerHTML = ''; 
        
        // Tambahkan Welcome Message (Dynamic)
        const welcomeDiv = document.createElement('div');
        welcomeDiv.className = 'welcome-message';
        let welcomeText = CONFIG.MODE === 'client' 
            ? `Terima kasih telah login. Ada kendala hukum yang bisa kami bantu?`
            : `Selamat datang! Silakan chat sebagai tamu untuk bertanya info umum.`;
            
        welcomeDiv.innerHTML = `
            <h4>👋 Halo, ${CONFIG.MODE === 'client' ? '{{ $clientName }}' : 'Tamu'}!</h4>
            <p>${welcomeText}</p>
        `;
        messagesArea.appendChild(welcomeDiv);

        // Loop Pesan
        messages.forEach(msg => {
            let type = 'received';
            
            // Logic menentukan pesan ini dikirim oleh siapa
            if (CONFIG.MODE === 'client' && msg.pengirim === 'client') type = 'sent';
            if (CONFIG.MODE === 'guest' && msg.pengirim === 'guest') type = 'sent';

            addMessageToUI(msg.isi_pesan, type, msg.created_at);
        });
        scrollToBottom();
    }

    function addMessageToUI(text, type, dateStr = null) {
        const div = document.createElement('div');
        const extraClass = (CONFIG.MODE === 'client' && type === 'sent') ? 'client-mode' : '';
        
        div.className = `message ${type} ${extraClass}`;
        
        const time = dateStr 
            ? new Date(dateStr).toLocaleTimeString('id-ID', {hour:'2-digit', minute:'2-digit'})
            : new Date().toLocaleTimeString('id-ID', {hour:'2-digit', minute:'2-digit'});

        div.innerHTML = `
            <div class="message-bubble">
                <div class="message-text">${escapeHtml(text)}</div>
                <div class="message-time">${time}</div>
            </div>
        `;
        messagesArea.appendChild(div);
    }

    function updateUnreadBadge() {
        if (unreadCount > 0) {
            unreadBadge.textContent = unreadCount > 99 ? '99+' : unreadCount;
            unreadBadge.style.display = 'flex';
        } else {
            unreadBadge.style.display = 'none';
        }
    }

    function scrollToBottom() {
        messagesArea.scrollTop = messagesArea.scrollHeight;
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    // Start Widget
    initialize();
    
    // Polling background
    setInterval(() => {
        if (!isOpen) loadMessages();
    }, 10000);
</script>