<?php

// Simple Page redirect

function redirect($location)
{
    header('location:' . URLROOT . '/' . $location);
}
