let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  const slides = document.querySelectorAll('.slides img');
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = 'none';
  }
  slideIndex++;
  if (slideIndex > slides.length) {
    slideIndex = 1;
  }
  slides[slideIndex - 1].style.display = 'block';
  setTimeout(showSlides, 2000); // Change image every 2 seconds (2000 milliseconds)
}


// footer

// Smooth scroll to anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      e.preventDefault();
  
      const targetId = this.getAttribute('href').substring(1);
      const targetElement = document.getElementById(targetId);
  
      if (targetElement) {
        window.scrollTo({
          top: targetElement.offsetTop - document.querySelector('header').offsetHeight,
          behavior: 'smooth'
        });
      }
    });
  });
  
// text slide

