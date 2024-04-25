document.addEventListener('DOMContentLoaded', function () {
    const stars = document.querySelectorAll('.star');
    const ratingInput = document.getElementById('rating');
  
    stars.forEach(star => {
      star.addEventListener('mouseenter', function () {
        const value = parseInt(star.getAttribute('data-value'));
        highlightStars(value);
      });
  
      star.addEventListener('mouseleave', function () {
        const value = parseInt(ratingInput.value);
        highlightStars(value);
      });
  
      star.addEventListener('click', function () {
        const value = parseInt(star.getAttribute('data-value'));
        ratingInput.value = value; // Update the hidden input with the selected rating
        highlightStars(value);
      });
    });
  
    function highlightStars(num) {
      stars.forEach((star, index) => {
        if (index < num) {
          star.classList.add('active');
        } else {
          star.classList.remove('active');
        }
      });
    }
  });
  
  