<?php

/*
 * Base Controller
 * Loads the model and views
*/

class Controller
{
    // Load model
    public function model($model)
    {
        // Require model file
        require_once '../app/models/' . $model . '.php';

        // Instantiate the model
        return new $model();
    }

    // Load views
    public function view($view, $data = [])
    {
        // Check for the view file
        if (file_exists('../app/views/' . $view . '.php')) {
            // Require the view file
            require_once '../app/views/' . $view . '.php';
        } else {
            // View does not exist
            die('View does not exist');
        }
    }
}
