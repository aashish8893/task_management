<?php
session_start();
if(isset($_SESSION['user']) && ($_SESSION['user'] != '') ){
}
else{
header('location:index.php');
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "task_management";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);
//    if($connection)
//    {
//        echo "we are connected";
//    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Task Management Dashboard</title>
        <meta charset="utf-8">
        <meta content="ie=edge" http-equiv="x-ua-compatible">
        <meta content="template language" name="keywords">
        <meta content="Tamerlan Soziev" name="author">
        <meta content="Admin dashboard html template" name="description">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <link href="favicon.png" rel="shortcut icon">
        <link href="apple-touch-icon.png" rel="apple-touch-icon">
        <!--<link href="//fast.fonts.net/cssapi/487b73f1-c2d1-43db-8526-db577e4c822b.css" rel="stylesheet" type="text/css">-->
        <link href="bower_components/select2/dist/css/select2.min.css" rel="stylesheet">
        <link href="bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
        <link href="bower_components/dropzone/dist/dropzone.css" rel="stylesheet">
        <link href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
        <link href="bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet">
        <link href="bower_components/slick-carousel/slick/slick.css" rel="stylesheet">
        <link href="css/main.css?version=4.4.1" rel="stylesheet">
        <link herf="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
<!--        <link herf="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" rel="stylesheet">-->


<style>
    .pagination {
        margin: 5px;
        padding: 32px 0px 14px 555px;
    }

    .paginate_button  {
        padding: 00 00 00 18px;
    }
</style>
    </head>

    <body class="menu-position-side menu-side-left full-screen with-content-panel">
<?php

error_reporting(0);
if($_FILES['profile']['name']){
    $_SESSION['emp_pro'] = $_FILES['profile']['name'];
}
    // if($_SESSION['emp_pro']){
    //     $_SESSION['emp_pro'] = $_FILES['profile']['name'];
    // }
    // else{}
?>
<div class="all-wrapper with-side-panel solid-bg-all">
<div class="layout-w"> 
<?php include './includes/sidemenu.php';?>
<div class="content-w">
<?php include './includes/topmenubar.php';?>
