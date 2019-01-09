<?php

class Dash_model extends Model {

    public function __construct() {
        Session::init();
        parent::__construct();
    }

    function category() {
        $sql = $this->db->select("SELECT name FROM cat WHERE status=0");
        return $sql;
    }

}
