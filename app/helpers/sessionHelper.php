<?php
session_start();

// Flash Message Helper
function flashMessage($name = '', $message = '', $class = 'flash-message')
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
            $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : 'flash-message';
            echo '<div class="' . $class . '" id="msg-flash">' . $_SESSION[$name] . '</div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name . '_class']);
        }
    }
}
