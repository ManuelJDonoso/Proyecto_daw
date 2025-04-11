
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const chatWindow = document.getElementById('chatWindow');
    const chatMessages = document.getElementById('chatMessages');
    const chatInput = document.getElementById('chatInput');
    const chatBubble = document.querySelector('.chat-bubble');

    chatBubble.addEventListener('click', () => {
      chatWindow.style.display = chatWindow.style.display === 'flex' ? 'none' : 'flex';
    });

    window.sendMessage = function () {
      const text = chatInput.value.trim();
      if (text === '') return;

      // Mostrar mensaje del usuario
      const userMsg = document.createElement('div');
      userMsg.innerHTML = `<strong>Tú:</strong> ${text}`;
      chatMessages.appendChild(userMsg);
      chatMessages.scrollTop = chatMessages.scrollHeight;

      // Enviar a la base de datos con fetch
      fetch('controllers/guardar_mensaje_help.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'mensaje=' + encodeURIComponent(text)
      })
      .then(response => response.text())
      .then(data => {
        console.log('Respuesta del servidor:', data);
      })
      .catch(error => {
        console.error('Error al guardar en la base de datos:', error);
      });

      // Simular respuesta automática del bot
      setTimeout(() => {
        const botMsg = document.createElement('div');
        botMsg.innerHTML = `<strong>Bot:</strong> Gracias por tu mensaje. Te responderemos pronto.`;
        chatMessages.appendChild(botMsg);
        chatMessages.scrollTop = chatMessages.scrollHeight;
      }, 1000);

      chatInput.value = '';
    };
  });
</script>
