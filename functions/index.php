<?php

class Index extends Controller {

    function __construct() {
        Session::init();
        parent::__construct();
    }

    function index(){
             $this->view->render("index/index", TRUE);
    }
    function register(){
             $this->view->render("index/register", TRUE);
    }
    function category(){
             $this->view->render("index/category", TRUE);
    }
    function suggestlocation($loc){
           $this->view->loc=$loc;
             $this->view->render("index/suggestlocation", TRUE);
     }
     
      function signin() {
        if (isset($_POST['coming_from'])) {
        $this->model->signin($_POST);
        }else{
           $this->view->render('index/login', true);  
        }
    }

    function signup() {
        if (isset($_POST['coming_from'])) {
            $this->model->signup($_POST);
        } else {
            $this->view->render('index/register', true);
        }
    }
     function logout() {
        $this->model->logout();
    }
//ENDS PAYMENT SETUP
}
