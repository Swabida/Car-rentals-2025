// Handle login form submission
document.addEventListener("DOMContentLoaded", () => {
  const loginForm = document.getElementById("loginForm");

  loginForm.addEventListener("submit", (e) => {
    e.preventDefault();

    const username = loginForm.querySelector('input[type="username"]').value.trim();
    const password = loginForm.querySelector('input[type="password"]').value.trim();

    if (username === "" || password === "") {
      alert("Please fill in all fields.");
      return;
    }

    // Here you can add actual backend request (AJAX / Fetch API)
    alert(`Welcome back, ${username}!`);

  });
});


