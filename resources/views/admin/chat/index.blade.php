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

    {{-- Modal Konfirmasi Delete --}}
    <div id="deleteModal" class="modal-overlay" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>⚠️ Konfirmasi Hapus</h3>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus percakapan ini?</p>
                <p style="font-size: 0.875rem; color: #64748b; margin-top: 0.5rem;">
                    Semua pesan dalam percakapan ini akan dihapus secara permanen.
                </p>
            </div>
            <div class="modal-footer">
                <button id="cancelDelete" class="btn-cancel">Batal</button>
                <button id="confirmDelete" class="btn-delete">Hapus</button>
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
          position:relative;
        }
        .conversation-item:hover{background:#f1f5f9;}
        .conversation-item.active{background:#fee2e2;color:rgb(var(--red-dark));font-weight:600;}
        .conversation-avatar{
          width:48px;height:48px;border-radius:50%;display:grid;place-content:center;font-size:20px;font-weight:600;color:#fff;flex-shrink:0;
        }
        .conversation-avatar.guest{background:linear-gradient(135deg, #fca5a5 0%, rgb(var(--red-light)) 100%);}
        .conversation-avatar.client{background:linear-gradient(135deg, #fdba74 0%, #ea580c 100%);}
        .conversation-info{flex:1;min-width:0;}
        .conversation-name{font-size:.9375rem;font-weight:500;color:var(--text);display:flex;justify-content:space-between;align-items:center;margin-bottom:4px;}
        .conversation-preview{font-size:.8125rem;color:var(--text-sub);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
        .unread-badge{background:rgb(var(--red));color:#fff;font-size:.6875rem;font-weight:700;padding:2px 7px;border-radius:9999px;margin-left:8px;flex-shrink:0;}
        
        /* Delete Button */
        .delete-btn{
          position:absolute;
          right:8px;
          top:50%;
          transform:translateY(-50%);
          width:32px;
          height:32px;
          border-radius:50%;
          background:#ef4444;
          color:#fff;
          border:none;
          display:none;
          align-items:center;
          justify-content:center;
          cursor:pointer;
          transition:all .2s ease;
          z-index:10;
        }
        .delete-btn:hover{
          background:#dc2626;
          transform:translateY(-50%) scale(1.1);
        }
        .conversation-item:hover .delete-btn{
          display:flex;
        }
        .delete-btn svg{
          width:16px;
          height:16px;
        }
        
        /* ---------- CHAT AREA ---------- */
        .chat-area{flex:1;background:var(--chat-bg);display:flex;flex-direction:column;}
        .chat-header{
          display:flex;align-items:center;gap:1rem;padding:1rem 1.5rem;background:#fff;border-bottom:1px solid var(--border);box-shadow:var(--shadow);justify-content:space-between;
        }
        .chat-header-left{display:flex;align-items:center;gap:1rem;}
        .chat-header-info h3{margin:0;font-size:1rem;color:var(--text);}
        .chat-header-info p{margin:0;font-size:.8125rem;color:var(--text-sub);}
        .chat-header-actions{display:flex;gap:8px;}
        .header-delete-btn{
          padding:8px 16px;
          background:#ef4444;
          color:#fff;
          border:none;
          border-radius:8px;
          font-size:0.875rem;
          font-weight:500;
          cursor:pointer;
          display:flex;
          align-items:center;
          gap:6px;
          transition:background .2s ease;
        }
        .header-delete-btn:hover{
          background:#dc2626;
        }
        .header-delete-btn svg{
          width:16px;
          height:16px;
        }
        
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
        
        /* ---------- MODAL ---------- */
        .modal-overlay{
          position:fixed;
          top:0;
          left:0;
          right:0;
          bottom:0;
          background:rgba(0,0,0,0.5);
          display:flex;
          align-items:center;
          justify-content:center;
          z-index:1000;
          backdrop-filter:blur(4px);
        }
        .modal-content{
          background:#fff;
          border-radius:1rem;
          max-width:400px;
          width:90%;
          box-shadow:0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
          overflow:hidden;
          animation:modalSlideIn 0.3s ease;
        }
        @keyframes modalSlideIn{
          from{opacity:0;transform:translateY(-20px);}
          to{opacity:1;transform:translateY(0);}
        }
        .modal-header{
          padding:1.25rem 1.5rem;
          border-bottom:1px solid var(--border);
        }
        .modal-header h3{
          margin:0;
          font-size:1.125rem;
          font-weight:600;
          color:var(--text);
        }
        .modal-body{
          padding:1.5rem;
        }
        .modal-body p{
          margin:0;
          color:var(--text);
          line-height:1.5;
        }
        .modal-footer{
          padding:1rem 1.5rem;
          border-top:1px solid var(--border);
          display:flex;
          gap:12px;
          justify-content:flex-end;
        }
        .btn-cancel, .btn-delete{
          padding:8px 20px;
          border:none;
          border-radius:8px;
          font-size:0.9375rem;
          font-weight:500;
          cursor:pointer;
          transition:all .2s ease;
        }
        .btn-cancel{
          background:#f1f5f9;
          color:var(--text);
        }
        .btn-cancel:hover{
          background:#e2e8f0;
        }
        .btn-delete{
          background:#ef4444;
          color:#fff;
        }
        .btn-delete:hover{
          background:#dc2626;
        }
        
        /* ---------- SCROLLBAR MODERN ---------- */
        .conversations-list::-webkit-scrollbar,
        .messages-container::-webkit-scrollbar{width:6px;}
        .conversations-list::-webkit-scrollbar-track,
        .messages-container::-webkit-scrollbar-track{background:transparent;}
        .conversations-list::-webkit-scrollbar-thumb,
        .messages-container::-webkit-scrollbar-thumb{background:rgb(var(--red-light));border-radius:3px;}
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // --- Variabel Global ---
            let chatConversations = [];
            let activeChat = null;
            let activeMessages = [];
            let chatRefreshInterval = null;
            let conversationToDelete = null;

            // Setup Axios CSRF Token
            const csrfMeta = document.querySelector('meta[name="csrf-token"]');
            if (csrfMeta) {
                axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfMeta.content;
            }

            // --- Modal Elements ---
            const deleteModal = document.getElementById('deleteModal');
            const cancelDeleteBtn = document.getElementById('cancelDelete');
            const confirmDeleteBtn = document.getElementById('confirmDelete');

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
                    
                    const isActive = activeChat && (
                        (conv.type === 'guest' && activeChat.guest_token === conv.guest_token) ||
                        (conv.type === 'client' && activeChat.id_client === conv.id_client)
                    );

                    if (isActive) {
                        div.classList.add('active');
                    }

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
                        <button class="delete-btn" data-conv='${JSON.stringify(conv)}'>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 6h18M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2M10 11v6M14 11v6"/>
                            </svg>
                        </button>
                    `;

                    // Click event untuk membuka chat
                    div.addEventListener('click', (e) => {
                        if (!e.target.closest('.delete-btn')) {
                            openChat(conv);
                        }
                    });

                    // Click event untuk delete button
                    const deleteBtn = div.querySelector('.delete-btn');
                    deleteBtn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        showDeleteModal(conv);
                    });

                    container.appendChild(div);
                });
            }

            // 3. Open Specific Chat
            function openChat(conv) {
                activeChat = conv;
                renderConversationsList();
                renderChatArea();
                loadActiveMessages();

                if (chatRefreshInterval) clearInterval(chatRefreshInterval);
                chatRefreshInterval = setInterval(loadActiveMessages, 3000);
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
                        const shouldScroll = (activeMessages.length !== response.data.data.length);
                        activeMessages = response.data.data;
                        
                        renderMessagesContent(shouldScroll);
                        markMessagesAsRead();
                    })
                    .catch(error => console.error('Error loading messages:', error));
            }

            // 5. Render Chat Area Layout
            function renderChatArea() {
                const chatArea = document.getElementById('chat-area');
                if (!chatArea) return;

                const avatarLetter = (activeChat.name || '?').charAt(0).toUpperCase();
                const avatarClass = activeChat.type === 'guest' ? 'guest' : 'client';
                const subtitle = activeChat.type === 'guest' ? 'Guest User' : (activeChat.email || 'Registered Client');

                chatArea.innerHTML = `
                    <div class="chat-header">
                        <div class="chat-header-left">
                            <div class="conversation-avatar ${avatarClass}" style="width:40px; height:40px; font-size:16px;">${avatarLetter}</div>
                            <div class="chat-header-info">
                                <h3>${escapeHtml(activeChat.name)}</h3>
                                <p>${escapeHtml(subtitle)}</p>
                            </div>
                        </div>
                        <div class="chat-header-actions">
                            <button id="header-delete-conversation" class="header-delete-btn">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M3 6h18M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2M10 11v6M14 11v6"/>
                                </svg>
                                Hapus Chat
                            </button>
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

                // Event listeners
                document.getElementById('admin-send-btn').addEventListener('click', sendAdminMessage);
                document.getElementById('header-delete-conversation').addEventListener('click', () => showDeleteModal(activeChat));
                
                const input = document.getElementById('admin-message-input');
                input.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter' && !e.shiftKey) {
                        e.preventDefault();
                        sendAdminMessage();
                    }
                });
            }

            // 6. Render Messages Content
            function renderMessagesContent(shouldScroll = false) {
                const container = document.getElementById('messages-container');
                if (!container) return;

                if (activeMessages.length === 0) {
                    container.innerHTML = '<div style="text-align:center; margin-top:20px; color:#888; font-size:13px;">Belum ada pesan.</div>';
                    return;
                }

                container.innerHTML = '';

                activeMessages.forEach(msg => {
                    const div = document.createElement('div');
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

            // 7. Send Message
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

                input.value = '';

                axios.post(url, data)
                    .then(response => {
                        loadActiveMessages();
                        loadConversations();
                    })
                    .catch(error => {
                        console.error('Error sending message:', error);
                        alert('Gagal mengirim pesan.');
                    });
            }

            // 8. Mark as Read
            function markMessagesAsRead() {
                if (!activeChat) return;
                
                const data = activeChat.type === 'guest' 
                    ? { guest_token: activeChat.guest_token }
                    : { id_client: activeChat.id_client };

                axios.post('/api/chat/mark-read', data)
                    .catch(err => console.error(err));
            }

            // 9. Show Delete Modal
            function showDeleteModal(conv) {
                conversationToDelete = conv;
                deleteModal.style.display = 'flex';
            }

            // 10. Hide Delete Modal
            function hideDeleteModal() {
                deleteModal.style.display = 'none';
                conversationToDelete = null;
            }

            // 11. Delete Conversation
            function deleteConversation() {
                if (!conversationToDelete) return;

                let url;
                if (conversationToDelete.type === 'guest') {
                    url = `/admin/api/chat/delete-guest/${conversationToDelete.guest_token}`;
                } else {
                    url = `/admin/api/chat/delete-client/${conversationToDelete.id_client}`;
                }

                axios.delete(url)
                    .then(response => {
                        // Jika chat yang dihapus sedang aktif, tutup chat area
                        if (activeChat && (
                            (conversationToDelete.type === 'guest' && activeChat.guest_token === conversationToDelete.guest_token) ||
                            (conversationToDelete.type === 'client' && activeChat.id_client === conversationToDelete.id_client)
                        )) {
                            activeChat = null;
                            if (chatRefreshInterval) clearInterval(chatRefreshInterval);
                            
                            // Reset chat area ke empty state
                            const chatArea = document.getElementById('chat-area');
                            chatArea.innerHTML = `
                                <div class="empty-state">
                                    <svg viewBox="0 0 303 172" fill="none">
                                        <path d="M151.5 0C67.824 0 0 67.824 0 151.5S67.824 303 151.5 303 303 235.176 303 151.5 235.176 0 151.5 0z" fill="#F0F0F0"/>
                                        <circle cx="151.5" cy="151.5" r="50" fill="#25D366"/>
                                    </svg>
                                    <h3>Admin Chat Dashboard</h3>
                                    <p>Pilih percakapan untuk mulai chat</p>
                                </div>
                            `;
                        }

                        hideDeleteModal();
                        loadConversations();
                        
                        // Tampilkan notifikasi sukses (opsional)
                        showNotification('Percakapan berhasil dihapus', 'success');
                    })
                    .catch(error => {
                        console.error('Error deleting conversation:', error);
                        alert('Gagal menghapus percakapan. Silakan coba lagi.');
                    });
            }

            // 12. Show Notification (Optional)
            function showNotification(message, type = 'info') {
                // Simple notification - bisa diganti dengan library seperti Toastify
                const notification = document.createElement('div');
                notification.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    padding: 12px 20px;
                    background: ${type === 'success' ? '#10b981' : '#ef4444'};
                    color: white;
                    border-radius: 8px;
                    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                    z-index: 9999;
                    animation: slideIn 0.3s ease;
                `;
                notification.textContent = message;
                document.body.appendChild(notification);

                setTimeout(() => {
                    notification.style.animation = 'slideOut 0.3s ease';
                    setTimeout(() => notification.remove(), 300);
                }, 3000);
            }

            // Modal Event Listeners
            cancelDeleteBtn.addEventListener('click', hideDeleteModal);
            confirmDeleteBtn.addEventListener('click', deleteConversation);
            
            // Close modal on overlay click
            deleteModal.addEventListener('click', (e) => {
                if (e.target === deleteModal) {
                    hideDeleteModal();
                }
            });

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

    <style>
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideOut {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }
    </style>
</x-layout>