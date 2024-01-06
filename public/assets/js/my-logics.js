// Get the current page URL
var currentPageUrl = window.location.href;

// Find the corresponding link and add 'active' class
var links = document.querySelectorAll('#header nav ul li a');
links.forEach(function (link) {
    if (link.href === currentPageUrl) {
        link.classList.add('active');
    }
});