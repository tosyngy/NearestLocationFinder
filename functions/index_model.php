<?php

class MyDB extends SQLite3 {

    function __construct() {
        $this->open('./phpliteadmin/elsewhereDb.sqlite');
    }

}

$db = new MyDB();
if (!$db) {
    echo $db->lastErrorMsg();
} else {
    // echo "Opened database successfully\n";
}

if (isset($_GET["signin"])) {
    signin($_POST);
} else if (isset($_GET["signup"])) {
    signup($_POST);
} else if (isset($_GET["logout"])) {
    logout();
}

function signin($data) {
    $db = new MyDB();
    Session::init();
    if (confirmUsername($data["te"]) == "0" || confirmUsername($data["tu"]) == "0") {
        $pass = Hash::create('sha256', $data["tp"], HASH_PASSWORD_KEY);
          $user=strtolower($data["te"]);
        $query = "SELECT username FROM login WHERE (email='$user' or username='$user') and password='{$pass}';";

        //echo $pass;
        $sql = $db->exec($query);
        $ret = $db->query($query);
        if ($sql == "1") {
            while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
                Session::set("usr", $row["username"]);
                Session::set("loggedin", $sql);
            echo "1";
            return exit;
            }
            echo "2";
            return exit; 
        }
    } else {
        echo "2";
        return exit;
    }
}

function signup($data) {
    $db = new MyDB();
    if (confirmEmail($data["te"]) > "0") {
        echo "0";
        return exit;
    } else if (confirmUsername($data["tu"]) > "0") {
        echo "-1";
        return exit;
    } else {
        $username =  strtolower($data["tu"]);
        $emial = strtolower($data["te"]);
        $pass = Hash::create('sha256', $data["tp"], HASH_PASSWORD_KEY);
        $sql = "insert into login (email,username,password) values('$emial','$username','$pass');";
        $ret = $db->exec($sql);
        if ($ret) {
            signin($data);
        } else {
            echo '3';
        }
        // insert("login", $param);
        //echo '1';
       
    }
}

function confirmEmail($data) {
    $data=  strtolower($data);
    $db = new MyDB();
    $sql = "SELECT email FROM login WHERE email='{$data}';";
    $ret = $db->query($sql);
    while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
        return "0";
    }
}

function confirmUsername($data) {
    $data=  strtolower($data);
    $db = new MyDB();
    $sql = "SELECT email FROM login WHERE username='{$data}';";
    $ret = $db->query($sql);
    while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
        return "0";
    }
}

function logout() {
    Session::init();
    Session::destroy();
    Session::offset("loggedin");
    Session::offset("usr");
    // header("location: ../index/index.php");
}

//}
