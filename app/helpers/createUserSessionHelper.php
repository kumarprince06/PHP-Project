<?php

// Create user session
function createUserSession($user)
{
    // Start session if not already started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Store user data in session variables
    $_SESSION['user_id'] = $user->id; // Assuming $user has an 'id' property
    $_SESSION['user_email'] = $user->email; // Assuming $user has an 'email' property
    // Redirect to the homepage or dashboard
    redirect('pages/index'); // Change 'pages/index' to your desired location
}
