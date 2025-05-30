document.addEventListener("DOMContentLoaded", function () {
  const checkbox = document.getElementById("themeToggle");

  // Load saved theme
  const savedTheme = localStorage.getItem("theme") || "light";
  document.documentElement.setAttribute("data-theme", savedTheme);
  checkbox.checked = savedTheme === "dark"; // Match checkbox state

  // Handle toggle
  checkbox.addEventListener("change", function () {
    const newTheme = checkbox.checked ? "dark" : "light";
    document.documentElement.setAttribute("data-theme", newTheme);
    localStorage.setItem("theme", newTheme);
  });
});