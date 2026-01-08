<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Chat Tamu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: sans-serif; padding: 20px; }
        #chat-box { width: 100%; max-width: 400px; height: 300px; border: 1px solid #333; overflow-y: scroll; padding: 10px; margin-bottom: 10px; background: #f9f9f9; }
        .msg { margin-bottom: 5px; padding: 5px; border-radius: 4px; }
        .guest { text-align: right; background-color: #d1e7dd; } /* Hijau */
        .admin { text-align: left; background-color: #e2e3e5; } /* Abu */
    </style>
</head>
<body>

    <h3>Chat Sebagai Tamu (Anonymous)</h3>
    <div id="status-koneksi" style="color: red;">Menghubungkan ke server...</div>
    
    <div id="chat-box"></div>
    
    <input type="text" id="pesan" placeholder="Ketik pesan..." style="width: 70%;">
    <button onclick="kirimPesan()">Kirim</button>

    <script>
        // 1. Buat Token Tamu (Kalau belum ada)
        let token = localStorage.getItem('guest_token');
        if (!token) {
            token = 'guest_' + Math.random().toString(36).substr(2, 9);
            localStorage.setItem('guest_token', token);
        }
        console.log("Identitas Saya (Token):", token);

        // 2. Tunggu sebentar agar Laravel Echo siap
        setTimeout(() => {
            const status = document.getElementById('status-koneksi');
            
            // Cek apakah Echo sudah terload
            if (window.Echo) {
                status.innerText = "Terhubung! (Token: " + token + ")";
                status.style.color = "green";

                // --- BAGIAN MENDENGARKAN PESAN ---
                // Kita mendengarkan channel: chat.guest.{token}
                window.Echo.channel('chat.guest.' + token)
                    .listen('.message.new', (e) => {
                        console.log("Pesan Masuk dari Server:", e);
                        
                        // Jika pengirimnya admin, tampilkan di kiri
                        if (e.chat.pengirim === 'admin') {
                            tambahChatKeLayar(e.chat.isi_pesan, 'admin');
                        }
                    });
            } else {
                status.innerText = "Gagal memuat Laravel Echo.";
            }
        }, 1500);

        // 3. Fungsi Kirim Pesan ke API
        async function kirimPesan() {
            const input = document.getElementById('pesan');
            const teks = input.value;
            if(!teks) return;

            // Tampilkan pesan sendiri di layar (langsung, biar responsif)
            tambahChatKeLayar(teks, 'guest');
            input.value = '';

            // Kirim ke Backend
            await fetch('/api/chat/guest', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    isi_pesan: teks,
                    guest_token: token
                })
            });
        }

        function tambahChatKeLayar(pesan, pengirim) {
            const box = document.getElementById('chat-box');
            box.innerHTML += `<div class="msg ${pengirim}"><b>${pengirim}:</b> ${pesan}</div>`;
            box.scrollTop = box.scrollHeight;
        }
    </script>
</body>
</html>