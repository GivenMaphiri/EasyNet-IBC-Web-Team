document.addEventListener("DOMContentLoaded", function () {
  const sidebarToggle = document.getElementById("menubutton");
  const sidebar = document.getElementById("sidebar");

  sidebarToggle.addEventListener("click", function () {
    sidebar.classList.toggle("active");
  });
});
