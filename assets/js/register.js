document.addEventListener("DOMContentLoaded", () => {
  const registerForm = document.getElementById("registerForm");

  registerForm.addEventListener("submit", (e) => {
    e.preventDefault();

    const fullName = registerForm.querySelector('input[type="text"]').value.trim();
    const email = registerForm.querySelector('input[type="email"]').value.trim();
    const phone = registerForm.querySelector('input[type="tel"]').value.trim();
    const password = registerForm.querySelectorAll('input[type="password"]')[0].value.trim();
    const confirmPassword = registerForm.querySelectorAll('input[type="password"]')[1].value.trim();
    const agreeTerms = document.getElementById("agreeTerms").checked;

    if (!fullName || !email || !phone || !password || !confirmPassword) {
      alert("Please fill in all fields.");
      return;
    }

    if (password !== confirmPassword) {
      alert("Passwords do not match!");
      return;
    }

    if (!agreeTerms) {
      alert("You must agree to the Terms and Conditions.");
      return;
    }

    // If all checks pass
    alert(`Account created successfully for ${fullName}!`);
    // Redirect to login page
    showPage("login");
  });
});

// Function to switch between login and register pages
function showPage(pageId) {
  const pages = document.querySelectorAll(".page");
  pages.forEach((page) => (page.style.display = "none"));

  const target = document.getElementById(pageId);
  if (target) target.style.display = "block";
}
