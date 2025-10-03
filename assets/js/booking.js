document.addEventListener('DOMContentLoaded', function() {
  // Form elements
  const bookingForm = document.getElementById('bookingForm');
  const pickupDateInput = document.querySelector('input[type="date"]:first-of-type');
  const dropoffDateInput = document.querySelector('input[type="date"]:last-of-type');
  const carTypeSelect = document.getElementById('carType');
  
  // Set minimum date to today
  const today = new Date().toISOString().split('T')[0];
  pickupDateInput.min = today;
  dropoffDateInput.min = today;
  
  // Update dropoff date minimum when pickup date changes
  pickupDateInput.addEventListener('change', function() {
    dropoffDateInput.min = this.value;
    if (dropoffDateInput.value && dropoffDateInput.value < this.value) {
      dropoffDateInput.value = this.value;
    }
  });
  
  // Form submission
  bookingForm.addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Get form values
    const pickupLocation = this.querySelector('select:first-of-type').value;
    const dropoffLocation = this.querySelector('select:last-of-type').value;
    const pickupDate = pickupDateInput.value;
    const dropoffDate = dropoffDateInput.value;
    const carType = carTypeSelect.value;
    const driverAge = this.querySelector('input[type="number"]').value;
    
    // Validate dates
    if (new Date(dropoffDate) <= new Date(pickupDate)) {
      showToast('Drop-off date must be after pick-up date', 'error');
      return;
    }
    
    // Calculate rental days
    const pickup = new Date(pickupDate);
    const dropoff = new Date(dropoffDate);
    const timeDiff = dropoff.getTime() - pickup.getTime();
    const daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));
    
    // Get car price
    const selectedOption = carTypeSelect.options[carTypeSelect.selectedIndex];
    const pricePerDay = selectedOption.getAttribute('data-price');
    
    // Calculate total price
    const totalPrice = daysDiff * parseInt(pricePerDay);
    
    // Show confirmation
    showToast(`Booking confirmed! ${daysDiff} days rental of ${carType} for $${totalPrice}`, 'success');
    
    // In a real application, you would send this data to a server
    console.log({
      pickupLocation,
      dropoffLocation,
      pickupDate,
      dropoffDate,
      carType,
      driverAge,
      daysDiff,
      totalPrice
    });
  });
  
  // Car selection function
  window.selectCar = function(carName, pricePerDay) {
    // Find the car type option that matches the selected car
    const options = carTypeSelect.options;
    for (let i = 0; i < options.length; i++) {
      if (options[i].value.includes(carName.split(' ')[0])) {
        carTypeSelect.selectedIndex = i;
        break;
      }
    }
    
    // Scroll to form
    document.querySelector('.booking-form').scrollIntoView({ behavior: 'smooth' });
    
    // Show notification
    showToast(`${carName} selected. Please complete the booking form.`, 'success');
  };
  
  // Toast notification function
  function showToast(message, type = 'success') {
    // Create toast container if it doesn't exist
    let toastContainer = document.querySelector('.toast-container');
    if (!toastContainer) {
      toastContainer = document.createElement('div');
      toastContainer.className = 'toast-container';
      document.body.appendChild(toastContainer);
    }
    
    // Create toast element
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    
    // Set icon based on type
    const icon = type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-circle-fill';
    
    // Set toast content
    toast.innerHTML = `
      <i class="bi ${icon} toast-icon"></i>
      <div class="toast-body">${message}</div>
      <button class="toast-close">&times;</button>
    `;
    
    // Add to container
    toastContainer.appendChild(toast);
    
    // Add close functionality
    toast.querySelector('.toast-close').addEventListener('click', function() {
      toast.style.animation = 'slideIn 0.3s ease reverse';
      setTimeout(() => toast.remove(), 300);
    });
    
    // Auto remove after 5 seconds
    setTimeout(() => {
      if (toast.parentNode) {
        toast.style.animation = 'slideIn 0.3s ease reverse';
        setTimeout(() => toast.remove(), 300);
      }
    }, 5000);
  }
  
  // Add animation classes to elements
  document.querySelectorAll('.car-card').forEach(el => {
    el.classList.add('animate-fade-in');
  });
  
  // Animation on scroll
  const animateElements = document.querySelectorAll('.animate-fade-in');
  
  function checkScroll() {
    animateElements.forEach(element => {
      const elementTop = element.getBoundingClientRect().top;
      const elementVisible = 150;
      
      if (elementTop < window.innerHeight - elementVisible) {
        element.classList.add('visible');
      }
    });
  }
  
  // Check on initial load
  checkScroll();
  
  // Check on scroll
  window.addEventListener('scroll', checkScroll);
});