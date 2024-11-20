<?php


// Create user session
function createUserSession($user)
{
    // Start session if not already started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $sessionData = [
        'userId' => $user->id,
        'userName' => $user->name,
        'userEmail' => $user->email,
        'role' => $user->role,
    ];

    // Store user data in session variables
    $_SESSION['sessionData'] = $sessionData;

    // Redirect to the homepage or dashboard
    redirect('pages/index'); // Change 'pages/index' to your desired location
}
