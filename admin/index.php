<?php
    include './../database/index.php';    
    session_start();
    $chck_Active_User = '';
    if (isset($_POST['login'])== 'submit') {
        $uemail = mysqli_real_escape_string($connection, $_POST['name']);    
        $pass = mysqli_real_escape_string($connection, $_POST['pwd']);    
        $sql = "SELECT * FROM `emp_login` where  user_id= '$uemail' and pswd = '$pass'";
        $query = mysqli_query($connection, $sql);
        $row = mysqli_fetch_array($query);
        $count = mysqli_num_rows($query); 
        print_r($sql);
        exit();
        if ($count > 0) {
            $_SESSION['user'] = $row['id'];
            $_SESSION['emp_name'] = $row['emp_name'];
            $_SESSION['emp_pro'] = $row['emp_pro'];
            $_SESSION['User_type'] = $row['user_role'];
            //$_SESSION['User_type']=$row['user_role'];
            //$_SESSION['User_type']=$row['user_role'];
            $chck_Active_User = $row['status'];
            if ($chck_Active_User == '0') {
                echo "<script>alert('your account is currently deactivated. please contact customer care +918305453647');  window.location.href='../login.php';</script>";
            } else {
                echo "<script>window.location.href='dashboard.php';</script>";
                //   echo "<script>alert ('Login Successfull');
                //   window.location.href='dashboard.php';
                //   </script>";
            }
        } else { 
?>
    <script>
        alert('Failed to login');
        window.location.href = "<?php echo $_SERVER['HTTP_REFERER'] ?>";
    </script>
<?php
} } ?>

<!DOCTYPE html>
<html>

<head>
    <title>Super Admin</title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="template language" name="keywords">
    <meta content="Tamerlan Soziev" name="author">
    <meta content="Admin dashboard html template" name="description">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="favicon.png" rel="shortcut icon">
    <link href="apple-touch-icon.png" rel="apple-touch-icon">
    <link href="//fast.fonts.net/cssapi/487b73f1-c2d1-43db-8526-db577e4c822b.css" rel="stylesheet" type="text/css">
    <link href="./../bower_components/select2/dist/css/select2.min.css" rel="stylesheet">
    <link href="./../bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="./../bower_components/dropzone/dist/dropzone.css" rel="stylesheet">
    <link href="./../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="./../bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="./../bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet">
    <link href="./../bower_components/slick-carousel/slick/slick.css" rel="stylesheet">
    <link href="./../css/main.css?version=4.4.1" rel="stylesheet">
</head>

<body class="auth-wrapper">
    <div class="row" style="background-color: #3867d6;color:red;padding: 10px;">
        <marquee direction="left" onmouseover="this.stop();" onmouseout="this.start();">
            <span class="breadcrumb-item">
                <?php
                $qry = mysqli_query($connection, "SELECT * FROM news_and_update where news_type='alert' order by created_date desc");
                
                while ($row = mysqli_fetch_assoc($qry)) {
                    $news_title = $row['news_title'];
                ?>
                    <a href="#" style="color:#fff;font-size: 18px;"><?php echo $news_title; ?>&nbsp;</a>
                <?php } ?>
            </span>


        </marquee>
    </div>
    <div class="all-wrapper menu-side with-pattern">
        <div class="auth-box-w">
            <div class="logo-w">
                <a href="#">
                    <h2>Admin Credentials</h2>  
                    <!-- <img style="width: 100%;height: auto;" alt="" src="piit-logo2.png"> -->
                </a>
            </div>
            <h4 class="auth-header">Login</h4>
            <form action="#" method="post">                     
                <div class="form-group">
                    <label for="">Username</label>
                    <input class="form-control" name="name" placeholder="Enter your username" type="text">
                <div class="pre-icon os-icon os-icon-user-male-circle"></div>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input class="form-control" name="pwd" placeholder="Enter your password" type="password">
                <div class="pre-icon os-icon os-icon-fingerprint"></div>
                </div>
                <div class="buttons-w">
                    <input name="login" type="submit" value="submit" class="btn btn-primary">                  
                </div>

            </form>
        </div>
    </div>
</body>

</html>