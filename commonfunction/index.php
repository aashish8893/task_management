<?php

include 'includes/db.php';

class getData {
    public function __construct()
    {
        
    }

    function userIdbyUserName(){
        $id = $_SESSION['user'];
        $query = "SELECT t1.emp_name FROM `emp_login` as t1 where id = $id";
        return $query;
    }
    /*project_master */
    function projectIdbyProjectName($id){        
        $query = "SELECT pro.id, pro.name FROM `project_master` as pro where id = $id";

              
        return $query;
    }
}