document.addEventListener("DOMContentLoaded", function(event) {
  const showNavbar = (toggleId, navId, bodyId, headerId) => {
    const toggle = document.getElementById(toggleId),
      nav = document.getElementById(navId),
      bodypd = document.getElementById(bodyId),
      headerpd = document.getElementById(headerId);
  
    // Validate that all variables exist
    if (toggle && nav && bodypd && headerpd) {
      toggle.addEventListener('click', () => {
        // show navbar
        nav.classList.toggle('show');
        // change icon
        toggle.classList.toggle('bx-x');
        // add padding to body
        bodypd.classList.toggle('body-pd');
        // add padding to header
        headerpd.classList.toggle('body-pd');
      });
    }
  };
  
  showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header');
  
  /*===== LINK ACTIVE =====*/
  const linkColor = document.querySelectorAll('.nav_link');
  
  function colorLink() {
    if (linkColor) {
      linkColor.forEach(l => l.classList.remove('active'));
      this.classList.add('active');
    }
  }
  
  linkColor.forEach(l => l.addEventListener('click', colorLink));
  
  const currentPath = window.location.pathname.split('/').filter(Boolean);
  const navLinks = document.querySelectorAll('.nav_link');
  
  navLinks.forEach(link => {
    const basePath = link.getAttribute('href').split('/').filter(Boolean)[0];
    const isMatch = currentPath.includes(basePath);
    
    console.log(currentPath);
    console.log(basePath);
    if (currentPath.includes('new')) {
      document.getElementById('book').classList.remove('active')
    } else {
      document.getElementById('new').classList.remove('active')
    }
    if (isMatch) {
      link.classList.add('active');
    }
  });
});
