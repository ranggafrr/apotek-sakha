@extends('layout.app-index')
@section('content')
    <div class="panel h-[calc(100vh-200px)] flex flex-col mt-5">
        <!-- Chat Header -->
        <div class="flex items-center justify-between p-4 border-b">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center">
                    <span class="text-white font-bold">AI</span>
                </div>
                <div>
                    <h5 class="text-lg font-semibold">Sakha AI Assistant</h5>
                    <span class="text-xs text-gray-500">Online</span>
                </div>
            </div>
            <button class="btn btn-danger inline-flex gap-x-2 items-center h-10" onclick="clearChat()">
                <i data-lucide="trash-2" class="h-4 w-4"></i>
                Clear Chat
            </button>
        </div>

        <!-- Chat Messages -->
        <div class="flex-1 overflow-y-auto p-4 space-y-4" id="chatContainer">
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-white text-sm font-bold">AI</span>
                </div>
                <div class="bg-gray-100 rounded-lg p-3 max-w-md">
                    <p class="text-sm">Halo! Saya adalah asisten AI Apotek Sakha. Ada yang bisa saya bantu?</p>
                </div>
            </div>
        </div>

        <!-- Chat Input -->
        <div class="border-t p-4">
            <div class="flex gap-2">
                <input type="text" id="messageInput" placeholder="Ketik pesan Anda..."
                    class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <button onclick="sendMessage()" class="btn btn-primary px-6">
                    <i data-lucide="send" class="h-4 w-4"></i>
                </button>
            </div>
        </div>
    </div>

    <script>
        function formatMessage(text) {
            // Ganti **bold** jadi <strong>
            text = text.replace(/\*\*(.*?)\*\*/g, "<strong>$1</strong>");
            // Ganti --- jadi hr
            text = text.replace(/---/g, "<hr>");
            // Ganti baris baru jadi <br>
            text = text.replace(/\n/g, "<br>");
            return text;
        }

        function addMessage(message, isUser = false) {
            const chatContainer = document.getElementById('chatContainer');
            const messageDiv = document.createElement('div');

            if (isUser) {
                messageDiv.innerHTML = `
                <div class="flex items-start gap-3 justify-end">
                    <div class="bg-indigo-600 text-white rounded-lg p-3 max-w-md">
                        <p class="text-sm">${formatMessage(message)}</p>
                    </div>
                    <div class="w-8 h-8 bg-gray-400 rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="text-white text-sm font-bold">U</span>
                    </div>
                </div>
            `;
            } else {
                messageDiv.innerHTML = `
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="text-white text-sm font-bold">AI</span>
                    </div>
                    <div class="bg-gray-100 rounded-lg p-3 max-w-md">
                        <p class="text-sm">${formatMessage(message)}</p>
                    </div>
                </div>
            `;
            }

            chatContainer.appendChild(messageDiv);
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        async function sendMessage() {
            const input = document.getElementById('messageInput');
            const message = input.value.trim();

            if (message) {
                addMessage(message, true);
                input.value = '';

                // tampilkan loading
                const loadingId = "loading-" + Date.now();
                addMessage("⏳ Sedang memproses...", false);
                const chatContainer = document.getElementById('chatContainer');
                const loadingElement = chatContainer.lastElementChild;

                try {
                    const response = await fetch('/chat', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            message
                        })
                    });

                    const data = await response.json();

                    // hapus pesan loading
                    chatContainer.removeChild(loadingElement);

                    addMessage(data.bot_reply || "❌ Tidak ada respon dari server.", false);
                } catch (error) {
                    chatContainer.removeChild(loadingElement);
                    addMessage("⚠️ Gagal terhubung ke server.", false);
                }
            }
        }

        function clearChat() {
            const chatContainer = document.getElementById('chatContainer');
            chatContainer.innerHTML = `
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-white text-sm font-bold">AI</span>
                </div>
                <div class="bg-gray-100 rounded-lg p-3 max-w-md">
                    <p class="text-sm">Halo! Saya adalah asisten AI Apotek Sakha. Ada yang bisa saya bantu?</p>
                </div>
            </div>
        `;
        }

        document.getElementById('messageInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });
    </script>
@endsection
