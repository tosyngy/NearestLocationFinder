<?php
ob_start();
// library
//require 'Database.php';
require 'Session.php';
require 'Hash.php';


require '../functions/path.php';
require '../functions/database.php';


//equire '../functions/dash.php';
//require '../functions/dash_model.php';
//require '../functions/index.php';
require '../functions/index_model.php';
//require '../functions/error.php';

Session::init();
if (!Session::get("loggedin")) {
    header('location: ../views/index/index.php') ;
}else{
   header('location:../views/dash/category.php');  
    
}
?>
