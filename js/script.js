// Check if the document is ready before executing
document.addEventListener('DOMContentLoaded', function() {

  // Validate the data in the search form
  const searchInput = document.querySelector('#search');

  // Add event listener to trigger search on input change
  searchInput.addEventListener('input', function() {
    const searchTerm = searchInput.value.trim();
    // Instant search feature can be added here to update results without reloading the page
  });

  // Effects when hovering over images (zoom in on hover)
  const galleryImages = document.querySelectorAll('.gallery img');
  galleryImages.forEach(img => {
    img.addEventListener('mouseenter', function() {
      img.style.transform = 'scale(1.1)';
    });

    img.addEventListener('mouseleave', function() {
      img.style.transform = 'scale(1)';
    });
  });

  // Smooth scroll when clicking on links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      document.querySelector(this.getAttribute('href')).scrollIntoView({
        behavior: 'smooth'
      });
    });
  });
});

// Open Modal when image is clicked
function openModal(imgElement) {
var modal = document.getElementById("imageModal");
var modalImg = document.getElementById("modalImage");
var captionText = document.getElementById("caption");

modal.style.display = "block"; // Show the modal
modalImg.src = imgElement.src; // Set the source of the modal image
captionText.innerHTML = imgElement.alt; // Set the caption of the modal
}

// Close Modal when clicked
function closeModal() {
var modal = document.getElementById("imageModal");
modal.style.display = "none"; // Hide the modal
}
