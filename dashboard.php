<?php

    include './includes/admin_header.php';
    $msg = '';
    if (isset($_GET['UserID']) && isset($_GET['Status'])) {
        $userID = $_GET['UserID'];
        $Inactive = $_GET['Status'];
        $msg = $Inactive;
        if ($Inactive == '1') {
            $query = "UPDATE `user_details` SET `Inactive`='0' WHERE User_ID='$userID'";
            $Active_User = mysqli_query($connection, $query);
            if (!$Active_User) {
                die('QUERY FAILD' . mysqli_error($connection));
            }
        } else if ($Inactive == '0') {
            //   echo $Inactive;
            $query = "UPDATE `user_details` SET `Inactive`='1' WHERE User_ID='$userID'";
            $deactive_User = mysqli_query($connection, $query);
            if (!$deactive_User) {
                die('QUERY FAILD' . mysqli_error($connection));
            }
        }
        //  header("location:./admin/retailer_account_list.php");
    }

?>
<!--------------------
START - Breadcrumbs
-------------------->
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><span>Dashboard</span></li>
</ul>
<!--------------------
END - Breadcrumbs
-------------------->
<div class="content-panel-toggler"><i class="os-icon os-icon-grid-squares-22"></i><span>Sidebar</span></div>
<div class="content-i">
    <div class="content-box">
        <marquee direction="left" style="background: #0a7cf8;" onmouseover="this.stop();" onmouseout="this.start();">
            <span class="breadcrumb-item">
                <?php
                    $qry = mysqli_query($connection, "SELECT * FROM news_and_update where news_type='alert' order by created_date desc");
                    
                    while ($row = mysqli_fetch_assoc($qry)) {
                        $news_title = $row['news_title'];
                ?>
                <a href="#" style="color:#fff;font-size: 18px;"><?php echo $news_title;?>&nbsp; <strong>|</strong> </a>
                <?php }?>
            </span>
        
         
        </marquee>
        <?php
            if($_SESSION['User_type']=='admin')
            {
                    include './includes/admin_dashboard.php';  
            } 
            else {
                include './includes/emp_dashboard.php';   
            }
        ?>      
    </div>
</div>
    <?php include './includes/plugin.php'; ?>  
</div>
    <?php include './includes/admin_footer.php'; ?>
        
<script>
    $(document).ready(function() {
        $('#example').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'pdfHtml5'
            ]
        } );
    } );
</script>