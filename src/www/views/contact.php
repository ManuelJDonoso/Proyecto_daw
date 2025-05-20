 <section class="contact">
      <h1 class="contact__title">Contacta al Administrador</h1>
      
      <form id="contactForm" class="contact__form">
        <div id="formMessage" class="form__message"></div>
        
        <div class="form__group">
          <label for="name" class="form__label">Nombre completo</label>
          <input type="text" name="name" id="name" class="form__input" required>
        </div>
        
        <div class="form__group">
          <label for="email" class="form__label">Correo electrónico</label>
          <input type="email" name="email" id="email" class="form__input" required>
        </div>
        
        <div class="form__group">
          <label for="subject" class="form__label">Asunto</label>
          <input type="text" name="subject" id="subject" class="form__input" required>
        </div>
        
        <div class="form__group">
          <label for="message" class="form__label">Mensaje</label>
          <textarea id="message" name="message" class="form__textarea" required></textarea>
        </div>
        
         <div class="">
          
          <input type="checkbox" id="terms" name="message" class="" ><a href="?pag=privacy" for="acuerdo" class="form__label"  onclick="window.open(this.href, 'popup', 'width=600,height=400'); return false;">Acepto Terminos y condiciones</a></input>
        </div>

        <button type="submit" class="form__submit">Enviar mensaje</button>
      </form>
      
      <div class="contact__info">
        <h2 class="contact__subtitle">Otras formas de contacto</h2>
        <div class="contact__details">
          <div class="contact__detail">
            <span class="contact__icon">📧</span>
            <span>dev@manueldonoso.es</span>
          </div>
          <div class="contact__detail">
            <span class="contact__icon">📱</span>
            <span>+34 123 456 789</span>
          </div>
          <div class="contact__detail">
            <span class="contact__icon">🏠</span>
            <span>Plaza Mayor, 1, Mérida,CP 06031, España.</span>
           
          </div>
      <div class="contact__detail">
            <span class="contact__icon">🏢</span>
            <span>Manuel Donoso S.L.</span>
            <br>
            <span> Su CIF es: B-12345678.</span>
        
      </div>
          
        </div>
      </div>
    </section>


    <script>
document.getElementById('contactForm').addEventListener('submit', function(e) {
  e.preventDefault();

  const formMessage = document.getElementById('formMessage');
  const termsCheckbox = document.getElementById('terms');
  
  // Verificar si el checkbox de términos está marcado
  if (!termsCheckbox.checked) {
    formMessage.textContent = 'Debes aceptar los términos y condiciones para enviar el formulario';
    formMessage.className = 'form__message form__message--error';
    return; // Detener la ejecución si no está marcado
  }

  const formData = new FormData(this);

  fetch('controllers/contact_form.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      formMessage.textContent = data.success;
      formMessage.className = 'form__message form__message--success';
      this.reset();
      // Opcional: desmarcar el checkbox después del envío
      termsCheckbox.checked = false;
    } else {
      formMessage.textContent = data.error;
      formMessage.className = 'form__message form__message--error';
    }
  })
  .catch(() => {
    formMessage.textContent = 'Error de conexión. Inténtalo más tarde.';
    formMessage.className = 'form__message form__message--error';
  });
});
</script>