<?php
/**
 * Route (Route.php) - Hyper-simple router
 *
 * This is obviously an extremely simplified router, with no default controller set, no resiliency to unexpected
 * or dangerous URIs, and it is hard-coded expecting the URN to contain 3 levels (e.g. /exercise1/foo/bar ).
 * Of course it's just for demonstration, and would be much more robust if time allowed :)
 *
 * @author  Ethan Sundstrom
 *
 */


class Route {

    /**
     * @var string  $controller The name of the Controller that the request will call.
     * @var string  $action     The controller Method to be called.
     * @var string  $result     The property that is set by the controller's method.
     */
    public $controller;
    public $action;
    public $result;

    /**
     * Magic method constructor
     *
     * @param   string  $urn    The URN portion of the requested URI
     */
    public function __construct($urn = null)
    {
        // Send over the URN and parse out the controller segment.
        $this->setController($urn);

        // Send over the URN and parse out the action segment.
        $this->setAction($urn);

        // Get the name of the controller class to be used.
        $class = $this->getController();

        // Create a new controller object of the proper class.
        $controller = new $class;

        // Get the controller method name to be called.
        $method =  $this->action;

        // Call the controller method. In our case, this controller method just sets the Controller object's
        // $foo_data property.
        $controller->$method();

        // Set this route object's $result property to the returned value from the controller.
        $this->result = $controller->getData();
    }

    /**
     * Set the controller property based on the URN path.
     *
     * @param   string  $urn    The URN portion of the requested URI
     * @return  string          Returns true after the controller is set.
     */
    public function setController($urn)
    {
        // Create an array from the slash-separated URN segments.
        $urn_parts = explode('/', $urn);

        // Get the third segment and append "Controller", save to $controller property.
        $this->controller =  $urn_parts[2] . 'Controller';

        // Check if it's been est and return true is so, false if not.
        return $this->getController() ? true : false;
    }

    /**
     * Set the action property based on the URN path.
     *
     * @param   string  $urn    The URN portion of the requested URI
     * @return  string          Returns true after the action is set.
     */
    public function setAction($urn)
    {
        // Create an array from the slash-separated URN segments.
        $urn_parts = explode('/', $urn);

        // Get the fourth segment and append "Action", save to $action property.
        $this->action =  $urn_parts[3] . 'Action';

        // Check if it's been est and return true is so, false if not.
        return $this->getAction() ? true : false;
    }

    /**
     * Return the controller property of the object.
     *
     * @return  string          Returns the $controller property.
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Return the action property of the object.
     *
     * @return  string          Returns the $action property.
     */
    public function getAction()
    {
        return $this->action;
    }
}

/**
 * fooController (Route.php) - Hyper-simple router
 *
 * And an over-simplified controller to match.
 *
 * @author  Ethan Sundstrom
 *
 */

class fooController {

    /**
     * @var string  $foo_data   The one property in the class, just for testing things.
     */
    public $foo_data;

    /**
     * Sets the $foo_data property of the object.
     *
     * @return  string          Returns the $foo_data property.
     */
    public function barAction()
    {
        $this->foo_data = "foo Data!";
        return $this->getData();
    }

    public function getData()
    {
        return $this->foo_data;
    }
}

