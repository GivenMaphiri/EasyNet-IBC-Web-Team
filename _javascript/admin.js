
const sidebar = document.querySelector('.sidebar');
const toggleButton = document.getElementById('sidebar-toggle');

toggleButton.addEventListener('click', () => {
    sidebar.classList.toggle('hidden');
  });