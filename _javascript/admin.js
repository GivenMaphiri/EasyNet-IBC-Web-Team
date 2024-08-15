
const sidebar = document.querySelector('.sidebar');
const toggleButton = document.getElementById('sidebar-toggle');

toggleButton.addEventListener('click', () => {
    sidebar.classList.toggle('hidden');
  });

  // Add click event listener to the login button
      // Get the login button element
      const loginButton = document.getElementById('login_button');

      // Add click event listener to the button
      loginButton.addEventListener('click', () => {
        // Redirect to admin.php on click
        window.location.href = "admin.php";
      });
    