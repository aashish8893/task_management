<?php
include 'database/index.php';
session_start();
if($_SESSION['user']){
}else{
    header('location:index.php');
}
$id = $_GET['id'];
$status = $_GET['status'];



if ($status == 'edit') {
   die('edit');
}





if($status == 'delete'){
    $query = "UPDATE `project_master` SET `status` = '3' WHERE `project_master`.`id` = $id";
    $result = $connection->query($query);
    
    if($result == '1' || $result == 1){
        header('location:project_list.php');
    }else{
        header('location:index.php');
    }
}else{
    header('location:dashboard.php');
}

if($_GET['status'] == 1 || $_GET['status'] == '1'){
    $query = "UPDATE `project_master` SET `status` = '2' WHERE `project_master`.`id` = $id";
    $result = $connection->query($query);
    if($result == '1' || $result == 1){
        header('location:project_list.php');
    }else{
        header('location:index.php');
    }
}else{

    if($status != 'delete'){

        $query = "UPDATE `project_master` SET `status` = '1' WHERE `project_master`.`id` = $id";
        $result = $connection->query($query);
        if($result == '1' || $result == 1){
            header('location:project_list.php');
        }else{
            header('location:index.php');
        }
    }
}

