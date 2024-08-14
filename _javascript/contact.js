const contactForm = document.getElementById('contactForm');

contactForm.addEventListener('submit', (event) => {
  event.preventDefault(); // Prevent default form submission

  const formData = new FormData(contactForm);
  const name = formData.get('name');
  const email = formData.get('email');
  const message = formData.get('message');

  // Simulate sending message to server (replace with your actual logic)
  console.log(`Name: ${name}, Email: ${email}, Message: ${message}`);

  alert('Message sent successfullys!');

  // Clear the form after successful submission (optional)
  contactForm.reset();
});