function onClick(e) {
  e.preventDefault(); // detener envío hasta tener token

  grecaptcha.ready(function() {
    grecaptcha.execute('6LfaqWYsAAAAAB6-VarlZVgzz9bj31BLiUe7w6fh', { action: 'submit' })
      .then(function(token) {
        document.getElementById('recaptchaToken').value = token;

        // enviar formulario al PHP del form
        e.target.submit();
      });
  });
}