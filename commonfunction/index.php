<?php

class getData {
    //protected $connection;
    public function __construct()
    {
       //$this->connection = $connection = new mysqli("localhost", "root", "", "task_management"); 
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

    /*project_phase_master */
    function projectpIdbyProjectName($id){        
        $query = "SELECT pro.id, pro.name FROM `project_phase_master` as pro where id = $id";              
        return $query;
    }

    // function projectIdbyProjectName2($id){        
    //     $query = "SELECT pro.id, pro.name FROM `project_master` as pro where id = $id";
    //     $res = mysqli_query($this->connection, $query);
    //     $res = mysqli_fetch_assoc($res);
    //     print_r($res['emp_name']);           
    //     return $query;
    // }
}