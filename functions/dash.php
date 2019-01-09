<?php

class Dash extends Controller {

    function __construct() {
        Session::init();
        parent::__construct();
    }

    function index() {
         $this->view->loc = $this->model->category();
        $this->view->render("dash/category", TRUE);
    }

    function category() {
        $this->view->loc = $this->model->category();
        $this->view->render("dash/category", TRUE);
    }

    function suggestlocation($loc) {
        $this->view->loc = $loc;
        $this->view->render("dash/suggestlocation", TRUE);
    }
   

}
