<?php
require_once __DIR__ . "/../controllers/button_help.php"
?>



  <style>

  </style>


<div class="chat-bubble" onclick="toggleChat()">
  💬
</div>

<div class="chat-window" id="chatWindow">
  <div class="chat-header">Chat Automático</div>
  <div class="chat-messages" id="chatMessages">
    <div><strong>Bot:</strong> ¡Hola! ¿En qué puedo ayudarte?</div>
  </div>
  <div class="chat-input">
    <input type="text" id="chatInput" placeholder="Escribe un mensaje...">
    <button onclick="sendMessage()">Enviar</button>
  </div>
</div>




