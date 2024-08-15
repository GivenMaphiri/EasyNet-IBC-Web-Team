const form = document.getElementById('loginForm');
const usernameInput = document.getElementById('email');
const passwordInput = document.getElementById('password');
const emailError = document.getElementById('emailError');
const passwordError = document.getElementById('passwordError');

form.addEventListener('submit', (event) => {
  event.preventDefault(); // Prevent form submission

  // Basic validation (add more complex checks as needed)
  if (usernameInput.value === '') {
    usernameError.textContent = 'Email is required';
  } else {
    usernameError.textContent = '';
  }

  if (passwordInput.value === '') {
    passwordError.textContent = 'Password is required';
  } else {
    passwordError.textContent = '';
  }

  // If there are no errors, submit the form or perform other actions
  if (usernameInput.value !== '' && passwordInput.value !== '') {
    // Submit the form or handle login logic
    console.log('Form submitted');
  }

//   // Replace this with your actual authentication logic
//   if (usernameInput.value === 'admin@gmail.com' && passwordError.textContent === 'admin123') {
//     // This is a placeholder for secure authentication
//     window.location.href = 'admin.html'; // Redirect to admin page
//   } else {
//     // Handle incorrect login
//     alert('Invalid credentials');
//   }
});