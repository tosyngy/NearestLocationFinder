<?php

class Error extends Controller {
    function __construct() {
        Session::init();
        parent::__construct();
    }

    function index() {
        echo 'error';
//         $this->view->loc = $this->model->category();
//        $this->view->render("e/category", TRUE);
    }
}

?>
