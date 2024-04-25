

document.addEventListener('DOMContentLoaded', function() {
    const profileButton = document.getElementById('profileButton');
    const loginButton = document.getElementById('loginButton');
  
    // Check if the user is logged in (you can use session or local storage)
    const isLoggedIn = sessionStorage.getItem('isLoggedIn');
  
    if (isLoggedIn) {
      // If logged in, hide the login button and show the profile button
      loginButton.style.display = 'none';
      profileButton.style.display = 'block';
    } else {
      // If not logged in, show the login button and hide the profile button
      loginButton.style.display = 'block';
      profileButton.style.display = 'none';
    }
  });
  