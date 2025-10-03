document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Get form values
        const name = document.querySelector('input[type="text"]').value;
        const email = document.querySelector('input[type="email"]').value;
        const subject = document.querySelectorAll('input[type="text"]')[1].value;
        const message = document.querySelector('textarea').value;
        
        // Simple validation
        if (!name || !email || !subject || !message) {
            alert('Please fill in all fields');
            return;
        }
        
        // Email validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert('Please enter a valid email address');
            return;
        }
        
        // Create success message
        const successMessage = document.createElement('div');
        successMessage.className = 'success-message';
        successMessage.textContent = `Thank you, ${name}! Your message has been sent successfully.`;
        
        // Add success message to form container
        const formContainer = document.querySelector('.form-container');
        formContainer.appendChild(successMessage);
        
        // Show success message
        successMessage.style.display = 'block';
        
        // Reset form
        contactForm.reset();
        
        // Hide success message after 5 seconds
        setTimeout(() => {
            successMessage.style.display = 'none';
        }, 5000);
    });
});