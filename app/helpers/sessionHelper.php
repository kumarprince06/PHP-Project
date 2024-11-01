<?php
session_start();

// Flash Message Helper
function flashMessage($name = '', $message = '', $class = 'flash-message')
{
    if (empty($name)) {
        return;
    }
    if (!empty($message) && empty($_SESSION[$name])) {

        // Unset any previous message with the same name
        if (!empty($_SESSION[$name])) {
            unset($_SESSION[$name]);
        }
        if (!empty($_SESSION[$name . '_class'])) {
            unset($_SESSION[$name . '_class']);
        }

        // Set session variables
        $_SESSION[$name] = $message;
        $_SESSION[$name . '_class'] = $class;
    }
    // Display the message
    elseif (empty($message) && !empty($_SESSION[$name])) {
        $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : 'flash-message';
        echo '<div class="' . $class . '" id="msg-flash">' . $_SESSION[$name] . '</div>';
        unset($_SESSION[$name]);
        unset($_SESSION[$name . '_class']);
    }
}

// Flash Error Message Helper
function flashErrorMessage($name = '', $message = '', $class = 'flash-message-error')
{
    if (!empty($name)) {
        if (!empty($message) && empty($_SESSION[$name])) {

            // Unset any previous message with the same name
            if (!empty($_SESSION[$name])) {
                unset($_SESSION[$name]);
            }
            if (!empty($_SESSION[$name . '_class'])) {
                unset($_SESSION[$name . '_class']);
            }

            // Set session variables
            $_SESSION[$name] = $message;
            $_SESSION[$name . '_class'] = $class;
        }
        // Display the message
        elseif (empty($message) && !empty($_SESSION[$name])) {
            // Ensure that we set the class correctly
            $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : 'flash-message-error';
            echo '<div class="' . $class . '" id="msg-flash-error">' . $_SESSION[$name] . '</div>';

            // Unset session data after display
            unset($_SESSION[$name]);
            unset($_SESSION[$name . '_class']);
        }
    }
}




// Is User Logged In
function isLoggedIn()
{

    // Check if sessionData exists and has a userId
    return isset($_SESSION['sessionData']) && isset($_SESSION['sessionData']['userId']);
}
