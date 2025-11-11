@extends('layouts.app')

@section('title', 'Chat - DODO Hotel')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4"><i class="fas fa-comments"></i> Chat en temps réel</h1>
            
            <div class="card">
                <div class="card-header">
                    <h4>Messages</h4>
                </div>
                <div class="card-body">
                    <div id="chat-messages" class="mb-3" style="height: 400px; overflow-y: auto; border: 1px solid #ddd; padding: 15px; border-radius: 5px;">
                        <!-- Les messages seront affichés ici -->
                    </div>
                    
                    <form id="chat-form">
                        <div class="input-group">
                            <input type="text" id="message-input" class="form-control" placeholder="Tapez votre message..." required>
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-paper-plane"></i> Envoyer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .message {
        margin-bottom: 15px;
        padding: 10px;
        border-radius: 10px;
        background-color: #f8f9fa;
    }
    
    .message.own {
        background-color: #007bff;
        color: white;
        text-align: right;
    }
    
    .message-header {
        font-weight: bold;
        margin-bottom: 5px;
    }
    
    .message-time {
        font-size: 0.8em;
        opacity: 0.7;
    }
</style>

<script>
    // Données de l'utilisateur actuel (en réalité, cela viendrait du backend)
    const currentUser = {
        id: {{ Auth::user()->id }},
        name: "{{ Auth::user()->name }}",
        role: "{{ Auth::user()->role }}"
    };
    
    // Messages de démonstration
    const messages = [
        {
            id: 1,
            user_id: 2,
            user_name: "Marie Dupont",
            user_role: "employee",
            content: "Bonjour à tous !",
            timestamp: "2023-05-15 10:30:00"
        },
        {
            id: 2,
            user_id: 3,
            user_name: "Pierre Martin",
            user_role: "admin",
            content: "Bonjour Marie, bienvenue sur le chat !",
            timestamp: "2023-05-15 10:31:15"
        },
        {
            id: 3,
            user_id: 1,
            user_name: "Jean Durand",
            user_role: "client",
            content: "Bonjour, j'ai une question concernant ma réservation.",
            timestamp: "2023-05-15 10:32:30"
        }
    ];
    
    // Fonction pour afficher les messages
    function displayMessages() {
        const chatMessages = document.getElementById('chat-messages');
        chatMessages.innerHTML = '';
        
        messages.forEach(message => {
            const messageDiv = document.createElement('div');
            messageDiv.className = `message ${message.user_id === currentUser.id ? 'own' : ''}`;
            
            const roleBadge = message.user_role === 'admin' ? '<span class="badge bg-danger">Admin</span>' : 
                             message.user_role === 'employee' ? '<span class="badge bg-primary">Employé</span>' : 
                             '<span class="badge bg-secondary">Client</span>';
            
            messageDiv.innerHTML = `
                <div class="message-header">
                    ${message.user_name} ${roleBadge}
                    <span class="message-time float-end">${formatDate(message.timestamp)}</span>
                </div>
                <div class="message-content">${message.content}</div>
            `;
            
            chatMessages.appendChild(messageDiv);
        });
        
        // Scroll vers le bas
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
    
    // Fonction pour formater la date
    function formatDate(timestamp) {
        const date = new Date(timestamp);
        return date.toLocaleTimeString('fr-FR', { 
            hour: '2-digit', 
            minute: '2-digit' 
        });
    }
    
    // Gestion de l'envoi de message
    document.getElementById('chat-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const messageInput = document.getElementById('message-input');
        const content = messageInput.value.trim();
        
        if (content) {
            // Ajouter le message à la liste
            const newMessage = {
                id: messages.length + 1,
                user_id: currentUser.id,
                user_name: currentUser.name,
                user_role: currentUser.role,
                content: content,
                timestamp: new Date().toISOString().slice(0, 19).replace('T', ' ')
            };
            
            messages.push(newMessage);
            displayMessages();
            
            // Vider le champ d'entrée
            messageInput.value = '';
        }
    });
    
    // Initialiser l'affichage des messages
    document.addEventListener('DOMContentLoaded', function() {
        displayMessages();
    });
</script>
@endsection