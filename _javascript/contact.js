// Get the contact form element
const contactForm = document.getElementById('contactForm');

// Handle form submission
contactForm.addEventListener('submit', (event) => {
  event.preventDefault(); // Prevent default form submission

  // Get form data
  const formData = new FormData(contactForm);
  const name = formData.get('name');
  const email = formData.get('email');
  const message = formData.get('message');

  // Send message to the server
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
          // Clear the form after successful submission
          contactForm.reset();
      } else {
          alert('Failed to send message');
      }
  })
  .catch(error => console.error('Error:', error));
});

