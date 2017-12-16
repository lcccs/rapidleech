<?php

// Application name
// Usage is to check direct access to a file
define('APPNAME', 'APP');

// Load autoloader
require_once __DIR__ . '/vendor/autoload.php';

if(!isset($_POST['ct']))
{
        // Load the form
        require_once __DIR__ . '/src/form.php';
}
else
{
        // Process the form
        require_once __DIR__ . '/src/sc.php';
}
