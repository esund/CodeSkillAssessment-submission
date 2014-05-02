<?php
/**
 * Created by Ethan Sundstrom
 */

// Include the Route class (and the foo controller).
require_once("Route.php");

// Create a new Route object and pass in the URN portion of the URI. Make sure the .htaccess is in place and that the
// mod_rewrite module is installed in apache.
$route1 = new Route($_SERVER['REQUEST_URI']);

echo $_SERVER['REQUEST_URI'];

// Display the contents of the Route object. The "result" property shows that the output from the contoller.
echo '<pre>';
print_r($route1);
echo '</pre>';

echo '<br />$route1->controller = ' . $route1->controller;
echo '<br />$route1->action = ' . $route1->action;
echo '<br />$route1->result = ' . $route1->result;