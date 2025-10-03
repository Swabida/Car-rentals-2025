// Handle login form submission
document.addEventListener("DOMContentLoaded", () => {
  const loginForm = document.getElementById("loginForm");

  loginForm.addEventListener("submit", (e) => {
    e.preventDefault();

    const email = loginForm.querySelector('input[type="email"]').value.trim();
    const password = loginForm.querySelector('input[type="password"]').value.trim();

    if (email === "" || password === "") {
      alert("Please fill in all fields.");
      return;
    }

    // Here you can add actual backend request (AJAX / Fetch API)
    alert(`Welcome back, ${email}!`);

    showPage("register");
  });
});

// Function to switch between pages (login/register)
function showPage(pageId) {
  const pages = document.querySelectorAll(".page");
  pages.forEach((page) => (page.style.display = "none"));

  const target = document.getElementById(pageId);
  if (target) target.style.display = "block";
}
