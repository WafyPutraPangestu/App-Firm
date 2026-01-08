<x-layout>
    {{-- Tambahkan library Axios jika belum ada di layout utama --}}
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    @endpush

    <div class="chat-container">
        <div class="sidebar">
            <div class="sidebar-header">
                <h2>💬 Chat Admin</h2>
            </div>
            <div class="conversations-list" id="conversations-list">
                <div style="padding: 20px; text-align: center; color: #666;">
                    Loading conversations...
                </div>
            </div>
        </div>

        <div class="chat-area" id="chat-area">
            <div class="empty-state">
                <svg viewBox="0 0 303 172" fill="none">
                    <path d="M151.5 0C67.824 0 0 67.824 0 151.5S67.824 303 151.5 303 303 235.176 303 151.5 235.176 0 151.5 0z" fill="#F0F0F0"/>
                    <circle cx="151.5" cy="151.5" r="50" fill="#25D366"/>
                </svg>
                <h3>Admin Chat Dashboard</h3>
                <p>Pilih percakapan untuk mulai chat</p>
            </div>
        </div>
    </div>

    {{-- CSS Styles --}}
    <style>
        /* ---------- ROOT TOKENS ---------- */
        :root{
          --red: 153 27 27;           /* red-800 */
          --red-light: 185 28 28;     /* red-700 */
          --red-dark: 127 29 29;      /* red-900 */
          --bg: #f8fafc;              /* slate-50 */
          --chat-bg: #e2e8f0;         /* slate-200 */
          --bubble-sent: #fecaca;     /* red-100 */
          --bubble-rcv: #fff;
          --text: #1e293b;            /* slate-800 */
          --text-sub: #64748b;        /* slate-500 */
          --border: #cbd5e1;          /* slate-300 */
          --unread: rgb(var(--red));
          --shadow: 0 4px 6px -1px rgb(0 0 0 / .07), 0 2px 4px -2px rgb(0 0 0 / .07);
          --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / .1), 0 4px 6px -4px rgb(0 0 0 / .1);
        }
        
        /* ---------- LAYOUT ---------- */
        .chat-container{
          display:flex;
          height:calc(100vh - 100px);
          max-width:100%;
          background:var(--bg);
          border-radius:1rem;
          overflow:hidden;
          box-shadow:var(--shadow-lg);
          margin-top:20px;
        }
        
        /* ---------- SIDEBAR ---------- */
        .sidebar{
          width:380px;
          background:rgba(255,255,255,.75);
          backdrop-filter:blur(12px);
          border-right:1px solid var(--border);
          display:flex;
          flex-direction:column;
        }
        .sidebar-header{
          padding:1.25rem 1.5rem;
          background:rgb(var(--red));
          color:#fff;
          font-size:1.125rem;
          font-weight:600;
          letter-spacing:.3px;
        }
        .conversations-list{
          flex:1;
          overflow-y:auto;
          padding:.5rem;
        }
        .conversation-item{
          display:flex;
          align-items:center;
          gap:.875rem;
          padding:.875rem 1rem;
          margin-bottom:.35rem;
          border-radius:.75rem;
          cursor:pointer;
          transition:background .18s ease;
        }
        .conversation-item:hover{background:#f1f5f9;}
        .conversation-item.active{background:#fee2e2;color:rgb(var(--red-dark));font-weight:600;}
        .conversation-avatar{
          width:48px;height:48px;border-radius:50%;display:grid;place-content:center;font-size:20px;font-weight:600;color:#fff;
        }
        .conversation-avatar.guest{background:linear-gradient(135deg, #fca5a5 0%, rgb(var(--red-light)) 100%);}
        .conversation-avatar.client{background:linear-gradient(135deg, #fdba74 0%, #ea580c 100%);}
        .conversation-name{font-size:.9375rem;font-weight:500;color:var(--text);}
        .conversation-preview{font-size:.8125rem;color:var(--text-sub);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
        .unread-badge{background:rgb(var(--red));color:#fff;font-size:.6875rem;font-weight:700;padding:2px 7px;border-radius:9999px;margin-left:auto;}
        
        /* ---------- CHAT AREA ---------- */
        .chat-area{flex:1;background:var(--chat-bg);display:flex;flex-direction:column;}
        .chat-header{
          display:flex;align-items:center;gap:1rem;padding:1rem 1.5rem;background:#fff;border-bottom:1px solid var(--border);box-shadow:var(--shadow);
        }
        .chat-header-info h3{margin:0;font-size:1rem;color:var(--text);}
        .chat-header-info p{margin:0;font-size:.8125rem;color:var(--text-sub);}
        .messages-container{
          flex:1;overflow-y:auto;padding:1.25rem;display:flex;flex-direction:column;gap:.5rem;
          background-image:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23cbd5e1' fill-opacity='.18'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .message{display:flex;margin-bottom:2px;}
        .message.sent{justify-content:flex-end;}
        .message.received{justify-content:flex-start;}
        .message-bubble{
          max-width:65%;padding:.625rem .875rem;border-radius:1rem;box-shadow:var(--shadow);font-size:.9375rem;line-height:1.35;
        }
        .message.sent .message-bubble{background:var(--bubble-sent);color:rgb(var(--red-dark));border-top-right-radius:.25rem;}
        .message.received .message-bubble{background:var(--bubble-rcv);color:var(--text);border-top-left-radius:.25rem;}
        .message-time{font-size:.6875rem;color:var(--text-sub);float:right;margin-left:.5rem;margin-top:.2rem;}
        
        /* ---------- INPUT AREA ---------- */
        .chat-input-area{
          display:flex;align-items:center;gap:.75rem;padding:.875rem 1.25rem;background:#fff;border-top:1px solid var(--border);
        }
        .chat-input{
          flex:1;padding:.625rem .875rem;border:1px solid var(--border);border-radius:.75rem;font-size:.9375rem;resize:none;outline:none;transition:border-color .2s;
        }
        .chat-input:focus{border-color:rgb(var(--red-light));}
        .send-btn{
          width:44px;height:44px;border:none;background:rgb(var(--red));color:#fff;border-radius:50%;display:grid;place-content:center;cursor:pointer;transition:background .2s;
        }
        .send-btn:hover{background:rgb(var(--red-dark));}
        .send-btn svg{width:22px;height:22px;}
        
        /* ---------- EMPTY STATE ---------- */
        .empty-state{flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;color:var(--text-sub);background:#fff;}
        .empty-state svg{width:120px;height:120px;margin-bottom:1.5rem;opacity:.25;}
        .empty-state h3{margin:0;font-size:1.25rem;font-weight:600;color:var(--text);}
        .empty-state p{margin:.25rem 0 0;font-size:.9375rem;}
        
        /* ---------- SCROLLBAR MODERN ---------- */
        .conversations-list::-webkit-scrollbar,
        .messages-container::-webkit-scrollbar{width:6px;}
        .conversations-list::-webkit-scrollbar-track,
        .messages-container::-webkit-scrollbar-track{background:transparent;}
        .conversations-list::-webkit-scrollbar-thumb,
        .messages-container::-webkit-scrollbar-thumb{background:rgb(var(--red-light));border-radius:3px;}
        </style>

    <script>
        // Gunakan Event Listener untuk memastikan DOM sudah siap
        document.addEventListener('DOMContentLoaded', function() {
            
            // --- Variabel Global (di dalam scope ini agar tidak konflik) ---
            let chatConversations = [];
            let activeChat = null;
            let activeMessages = [];
            let chatRefreshInterval = null;

            // Pastikan Axios ada
            if (typeof axios === 'undefined') {
                console.error('Axios is not loaded! Please include axios CDN.');
                return;
            }

            // Setup Axios CSRF Token
            const csrfMeta = document.querySelector('meta[name="csrf-token"]');
            if (csrfMeta) {
                axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfMeta.content;
            }

            // --- Function Definitions ---

            // 1. Load Conversations List
            function loadConversations() {
                axios.get('/admin/api/chat/conversations')
                    .then(response => {
                        chatConversations = response.data.data;
                        renderConversationsList();
                    })
                    .catch(error => {
                        console.error('Error loading conversations:', error);
                    });
            }

            // 2. Render Conversations List Sidebar
            function renderConversationsList() {
                const container = document.getElementById('conversations-list');
                if (!container) return;

                if (chatConversations.length === 0) {
                    container.innerHTML = '<div style="padding:20px; text-align:center; color:#888;">Belum ada percakapan</div>';
                    return;
                }

                container.innerHTML = '';

                chatConversations.forEach(conv => {
                    const div = document.createElement('div');
                    div.className = 'conversation-item';
                    
                    // Cek apakah item ini sedang aktif
                    const isActive = activeChat && (
                        (conv.type === 'guest' && activeChat.guest_token === conv.guest_token) ||
                        (conv.type === 'client' && activeChat.id_client === conv.id_client)
                    );

                    if (isActive) {
                        div.classList.add('active');
                    }

                    // Setup Avatar & Nama
                    const avatarLetter = (conv.name || '?').charAt(0).toUpperCase();
                    const avatarClass = conv.type === 'guest' ? 'guest' : 'client';
                    const timeStr = formatTimeShort(conv.last_message_at);

                    div.innerHTML = `
                        <div class="conversation-avatar ${avatarClass}">${avatarLetter}</div>
                        <div class="conversation-info">
                            <div class="conversation-name">
                                <span>${escapeHtml(conv.name)}</span>
                                <span style="font-size:11px; font-weight:normal; color:#666;">${timeStr}</span>
                            </div>
                            <div style="display:flex; justify-content:space-between; align-items:center;">
                                <div class="conversation-preview">${escapeHtml(conv.last_message || '')}</div>
                                ${conv.unread_count > 0 ? `<span class="unread-badge">${conv.unread_count}</span>` : ''}
                            </div>
                        </div>
                    `;

                    // Klik event untuk membuka chat
                    div.addEventListener('click', () => openChat(conv));
                    container.appendChild(div);
                });
            }

            // 3. Open Specific Chat
            function openChat(conv) {
                activeChat = conv;
                renderConversationsList(); // Update UI active state
                renderChatArea(); // Tampilkan header chat area
                loadActiveMessages(); // Ambil pesan

                // Clear interval lama jika ada, lalu set yang baru
                if (chatRefreshInterval) clearInterval(chatRefreshInterval);
                chatRefreshInterval = setInterval(loadActiveMessages, 3000); // Auto refresh pesan tiap 3 detik
            }

            // 4. Load Messages for Active Chat
            function loadActiveMessages() {
                if (!activeChat) return;

                let url;
                if (activeChat.type === 'guest') {
                    url = `/api/chat/guest/${activeChat.guest_token}`;
                } else {
                    url = `/api/chat/client/${activeChat.id_client}`;
                }

                axios.get(url)
                    .then(response => {
                        // Cek apakah ada pesan baru untuk discroll ke bawah
                        const shouldScroll = (activeMessages.length !== response.data.data.length);
                        activeMessages = response.data.data;
                        
                        renderMessagesContent(shouldScroll);
                        markMessagesAsRead();
                    })
                    .catch(error => console.error('Error loading messages:', error));
            }

            // 5. Render Chat Area Layout (Header + Container)
            function renderChatArea() {
                const chatArea = document.getElementById('chat-area');
                if (!chatArea) return;

                const avatarLetter = (activeChat.name || '?').charAt(0).toUpperCase();
                const avatarClass = activeChat.type === 'guest' ? 'guest' : 'client';
                const subtitle = activeChat.type === 'guest' ? 'Guest User' : (activeChat.email || 'Registered Client');

                chatArea.innerHTML = `
                    <div class="chat-header">
                        <div class="conversation-avatar ${avatarClass}" style="width:40px; height:40px; font-size:16px;">${avatarLetter}</div>
                        <div class="chat-header-info">
                            <h3>${escapeHtml(activeChat.name)}</h3>
                            <p>${escapeHtml(subtitle)}</p>
                        </div>
                    </div>
                    <div class="messages-container" id="messages-container">
                        <div style="text-align:center; padding:20px; color:#888;">Memuat pesan...</div>
                    </div>
                    <div class="chat-input-area">
                        <textarea id="admin-message-input" class="chat-input" placeholder="Ketik pesan..." rows="1"></textarea>
                        <button id="admin-send-btn" class="send-btn">
                            <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
                                <path d="M1.101 21.757L23.8 12.028 1.101 2.3l.011 7.912 13.623 1.816-13.623 1.817-.011 7.912z"/>
                            </svg>
                        </button>
                    </div>
                `;

                // Re-attach event listener for send button
                document.getElementById('admin-send-btn').addEventListener('click', sendAdminMessage);
                
                // Enter to send
                const input = document.getElementById('admin-message-input');
                input.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter' && !e.shiftKey) {
                        e.preventDefault();
                        sendAdminMessage();
                    }
                });
            }

            // 6. Render Messages Bubble inside Container
            function renderMessagesContent(shouldScroll = false) {
                const container = document.getElementById('messages-container');
                if (!container) return;

                if (activeMessages.length === 0) {
                    container.innerHTML = '<div style="text-align:center; margin-top:20px; color:#888; font-size:13px;">Belum ada pesan.</div>';
                    return;
                }

                container.innerHTML = ''; // Clear loading text

                activeMessages.forEach(msg => {
                    const div = document.createElement('div');
                    // Logic: 'admin' = sent (kanan), 'guest'/'client' = received (kiri)
                    const isSent = msg.pengirim === 'admin';
                    div.className = isSent ? 'message sent' : 'message received';

                    const time = new Date(msg.created_at).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });

                    div.innerHTML = `
                        <div class="message-bubble">
                            <div class="message-text">${escapeHtml(msg.isi_pesan)}</div>
                            <div class="message-time">${time}</div>
                        </div>
                    `;
                    container.appendChild(div);
                });

                if (shouldScroll) {
                    container.scrollTop = container.scrollHeight;
                }
            }

            // 7. Send Message Logic
            function sendAdminMessage() {
                const input = document.getElementById('admin-message-input');
                const text = input.value.trim();
                if (!text || !activeChat) return;

                let url, data;
                if (activeChat.type === 'guest') {
                    url = '/admin/api/chat/reply-guest';
                    data = { guest_token: activeChat.guest_token, isi_pesan: text };
                } else {
                    url = '/admin/api/chat/reply-client';
                    data = { id_client: activeChat.id_client, isi_pesan: text };
                }

                // Optimistic UI clear
                input.value = '';

                axios.post(url, data)
                    .then(response => {
                        loadActiveMessages(); // Reload chat
                        loadConversations(); // Update list (last message preview)
                    })
                    .catch(error => {
                        console.error('Error sending message:', error);
                        alert('Gagal mengirim pesan.');
                    });
            }

            // 8. Mark as Read Logic
            function markMessagesAsRead() {
                if (!activeChat) return;
                
                const data = activeChat.type === 'guest' 
                    ? { guest_token: activeChat.guest_token }
                    : { id_client: activeChat.id_client };

                axios.post('/api/chat/mark-read', data)
                    .then(() => {
                        // Optional: kurangi unread count di list secara lokal agar responsif
                    })
                    .catch(err => console.error(err));
            }

            // Helper Functions
            function escapeHtml(text) {
                if (!text) return '';
                return text.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
            }

            function formatTimeShort(datetime) {
                if (!datetime) return '';
                const date = new Date(datetime);
                return date.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
            }

            // --- Start Initialization ---
            loadConversations();
            
            // Auto refresh list conversation setiap 10 detik
            setInterval(loadConversations, 10000);

        });
    </script>
</x-layout>