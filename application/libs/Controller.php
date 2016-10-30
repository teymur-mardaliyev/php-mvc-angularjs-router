<?php

class Controller {

    /** @var View View The view object */
    public $View;

    /**
     * Construct the (base) controller. This happens when a real controller is constructed, like in
     * the constructor of IndexController when it says: parent::__construct();
     */
    function __construct() {
        // always initialize a session
        Session::init();

        // create a view object to be able to use it inside a controller, like $this->View->render();
        $this->View = new View();
    }
}
