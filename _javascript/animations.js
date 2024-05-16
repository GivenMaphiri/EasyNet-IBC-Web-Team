document.addEventListener("DOMContentLoaded", function() {
    var elements = document.querySelectorAll('.element');
    
    function animateElements() {
      elements.forEach(function(element) {
        if (isElementInViewport(element)) {
          element.style.opacity = 1;
          element.style.transform = 'translateY(0)';
        }
      });
    }
    
    function isElementInViewport(el) {
      var rect = el.getBoundingClientRect();
      return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
      );
    }
    
    animateElements();
    
    window.addEventListener('scroll', animateElements);
    window.addEventListener('resize', animateElements);
  });
  