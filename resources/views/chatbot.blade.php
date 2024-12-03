@extends('adminlte::page')

@section('title', 'Chat Bot')

@section('content_header')
    <h1 class="m-0 text-dark">Chat Bot</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">AI Chatbot Assistant</h3>
                </div>
                <div class="card-body">
                    <!-- Chatbot Section -->
                    <div class="chatbot-section">
                        <form id="chat-form">
                            <div class="input-group mb-3">
                                <input type="text" id="message" class="form-control" placeholder="Ketik pertanyaan Anda..." required>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-paper-plane"></i> Tanya
                                    </button>
                                </div>
                            </div>
                        </form>
                        
                        <div id="chat-log" class="direct-chat-messages" 
                             style="height: 300px; overflow-y: auto; border: 1px solid #ddd; padding: 10px;">
                            <!-- Chat messages will be dynamically inserted here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        #chat-log .user-message {
            text-align: right;
            margin-bottom: 10px;
        }
        #chat-log .bot-message {
            text-align: left;
            margin-bottom: 10px;
        }
        #chat-log .user-message .message {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 8px 12px;
            border-radius: 10px;
            max-width: 70%;
        }
        #chat-log .bot-message .message {
            display: inline-block;
            background-color: #e9ecef;
            color: #333;
            padding: 8px 12px;
            border-radius: 10px;
            max-width: 70%;
        }
    </style>
@endsection

@section('js')
    <script>
        document.getElementById('chat-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            const messageInput = document.getElementById('message');
            const message = messageInput.value;
            const chatLog = document.getElementById('chat-log');

            // User message
            const userMessageEl = document.createElement('div');
            userMessageEl.classList.add('user-message');
            userMessageEl.innerHTML = `<div class="message"><strong>You:</strong> ${message}</div>`;
            chatLog.appendChild(userMessageEl);

            try {
                const response = await fetch('{{ route('chatbot.reply') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ message })
                });

                const data = await response.json();

                // Bot message
                const botMessageEl = document.createElement('div');
                botMessageEl.classList.add('bot-message');
                botMessageEl.innerHTML = `<div class="message"><strong>Bot:</strong> ${data.response}</div>`;
                chatLog.appendChild(botMessageEl);

                // Auto-scroll to bottom
                chatLog.scrollTop = chatLog.scrollHeight;
            } catch (error) {
                console.error('Error:', error);
            }

            // Clear input
            messageInput.value = '';
        });
    </script>
@endsection