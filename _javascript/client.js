/* code for second looping  carousel--------------------------------------------------------------------------*/

const carousel = document.querySelector('.carousel');
const partnerImgs = carousel.querySelector('#partner_imgs1');
const partnerImgsWidth = partnerImgs.offsetWidth; // Get the width of the partner_imgs1 element

// Clone the partner_imgs1 element to create a seamless loop
const partnerImgsClone = partnerImgs.cloneNode(true);
partnerImgs.parentNode.appendChild(partnerImgsClone);

// Set the total width of the carousel to hold all logos twice (for smooth transition)
carousel.style.width = `${partnerImgsWidth * 2}px`;

let currentPosition = 0; // Initial position

function moveCarousel() {
  currentPosition -= 1; // Move one logo to the left

  // Check if all logos have been scrolled through
  if (Math.abs(currentPosition) >= partnerImgsWidth) {
    currentPosition = 0; // Reset position to the beginning
    partnerImgs.style.transform = 'translateX(0)'; // Reset transform to avoid stacking issues
  }

  partnerImgs.style.transform = `translateX(${currentPosition}px)`;

  // Schedule the next movement using requestAnimationFrame for smoother animation
  requestAnimationFrame(moveCarousel);
}

// Start the carousel animation
requestAnimationFrame(moveCarousel);





/* First carousel code--------------------------------------------------------------------------*/

$(document).ready(function(){
    $('#partner_imgs').slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 2000,
      dots: true,
      arrows: true,
      responsive: [
        {
          breakpoint: 900,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });
  });