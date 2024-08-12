document.getElementById('contactForm').addEventListener('submit', function(e) {
  e.preventDefault();

  const name = document.getElementById('name').value;
  const email = document.getElementById('email').value;
  const message = document.getElementById('message').value;

  fetch('_php/save_message.php', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json'
      },
      body: JSON.stringify({ name, email, message })
  })
  .then(response => response.json())
  .then(data => {
      if (data.success) {
          alert('Message sent successfully');
      } else {
          alert('Failed to send message');
      }
  })
  .catch(error => console.error('Error:', error));
});

