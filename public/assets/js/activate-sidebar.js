// Get the current URL
var currentURL = window.location.href;

// Get all the menu links
var menuLinks = document.querySelectorAll('.menu-link');

// Loop through the menu links
menuLinks.forEach(function(link) {
  // Get the link's URL
  var linkURL = link.getAttribute('href');

  // Check if the link's URL matches the current URL
  if (linkURL === currentURL) {
    // Add the active class to the parent li element
    link.closest('.menu-item').classList.add('active');
    
      // if this link has a parent menu-sub 
      if(link.closest('.menu-sub')){
        // add open class to the parent menu-sub
        link.closest('.menu-sub').parentElement.classList.add('open');
      }
  }

  //Check if the link's URL is a parent of the current URL
  if (currentURL.includes(linkURL)) {
    // Add the active class to the parent li element
    link.closest('.menu-item').classList.add('active');
    
      // if this link has a parent menu-sub 
      if(link.closest('.menu-sub')){
        // add open class to the parent menu-sub
        link.closest('.menu-sub').parentElement.classList.add('open');
      }
  }
  

});
