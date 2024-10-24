<?php

// Load config file
require_once '../app/config/config.php';

// Load Url Helper file
require_once '../app/helpers/urlHelper.php';

// Load Session Helper file
require_once '../app/helpers/sessionHelper.php';

// Autoload Core libraries
spl_autoload_register(function ($className) {
    require_once 'libraries/' . $className . '.php';
});
