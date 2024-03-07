const TIMEOUT_DURATION = 24 * 60 * 60 * 1000; // 1 day in milliseconds

let logoutTimer;

// Function to start the logout timer
function startLogoutTimer() {
    logoutTimer = setTimeout(logoutUser, TIMEOUT_DURATION);
}

// Function to reset the logout timer
function resetLogoutTimer() {
    clearTimeout(logoutTimer);
    startLogoutTimer();
}

// Function to perform logout
function logoutUser() {
    // Perform logout action here (e.g., clear authentication token)
    console.log('User automatically logged out');
    // Redirect to login page or update UI
    window.location.href = 'login.php'; // Example: Redirecting to login page
}

// Event listener to reset the timer when user interacts with the application
document.addEventListener('click', resetLogoutTimer);
document.addEventListener('mousemove', resetLogoutTimer);
document.addEventListener('keypress', resetLogoutTimer);

// Start the logout timer when the user logs in
startLogoutTimer();
