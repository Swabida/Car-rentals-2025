// Show page function
function showPage(pageId) {
  document.querySelectorAll('.page').forEach(page => {
    page.classList.remove('active');
    page.style.display = 'none';
  });

  const selectedPage = document.getElementById(pageId);
  if (selectedPage) {
    selectedPage.classList.add('active');
    selectedPage.style.display = 'block';
  }

  // Update active nav link
  document.querySelectorAll('.nav-link').forEach(link => {
    link.classList.remove('active');
  });
  const activeLink = Array.from(document.querySelectorAll('.nav-link'))
    .find(link => link.getAttribute("onclick") === `showPage('${pageId}')`);
  if (activeLink) activeLink.classList.add('active');
}

// Car selection
function selectCar(carName, price) {
  alert(`You selected ${carName} for $${price}/day`);
  showPage('book-now');
}
