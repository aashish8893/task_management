<?php
    include './includes/admin_header.php';
    include './includes/data_base_save_update.php';
    $msg = '';
    $AppCodeObj = new databaseSave();
    if (isset($_POST['submit'])) {
        $asset_tp=$_POST['asset_tp'];
        $csno=$_POST['csno'];
        $emp_id=$_POST['emp_id'];
        $issue_date= $_POST['issue_date'];
        $Issue_Dis=  $_POST['Issue_Dis'];
        $query="INSERT INTO `emp_assets`(`asset_id`, `emp_id`, `issue_date`, `des`, `status`, `created_date`) VALUES ('$csno','$emp_id','$issue_date','$Issue_Dis','1',now())";
        $insert_data= mysqli_query($connection, $query);
        $query_update="UPDATE `asset_tb` SET `status`='0' WHERE `assetID`='$csno'";
        $q_update= mysqli_query($connection, $query_update);   
        if (!$insert_data) {
            die('QUERY FAILD change pashword' . mysqli_error($connection));
        } else {
            echo "<script>alert('Record Save Successfully');</script>";
            // return 'pass';
        }
    }
?>
<!--------------------
START - Breadcrumbs
-------------------->
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><span>Assign Site </span></li>
</ul>
<!--------------------
END - Breadcrumbs
-------------------->
<div class="content-panel-toggler"><i class="os-icon os-icon-grid-squares-22"></i><span>Sidebar</span></div>
<div class="content-i">
    <div class="content-box">
        <div class="element-wrapper">
            <div class="element-box">

                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: blue;border-bottom: 1px solid blue;padding: 10px;">Assign Site</h5>                                   
                    </div>  
                </div>
                <form class="container" action="#" method="post" enctype="multipart/form-data">
                    <div class="row"> 
                        
                        <div class="col-sm-3">
                            <div class="form-group"><label for="">Site ID</label>
                               <!-- <input class="form-control" name="csno" placeholder="" type="text"> -->
                                <select name="emp_id" class="form-control">
                                    <option>--Select--</option>
                                    <?php                                     
                                    $qry1 = mysqli_query($connection, "SELECT * FROM asset_tb where delete_status='0' and status !='0'  order by created desc");
                                    while ($row = mysqli_fetch_assoc($qry1)) {
                                    $asset_count = $asset_count + 1;
                                    $csno=$row['csno'];
                                    $assetID=$row['assetID'];
                                    ?>
                                    <option value="<?php echo $assetID;?>"><?php echo $csno;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>                            

                            <div class="col-sm-3">
                                <div class="form-group"><label for="">Employee Name</label>
                                    <!--<input class="form-control" name="csno" placeholder="CSNO" type="text">-->
                                    <select name="emp_id" class="form-control">
                                        <option>--Select--</option>
                                        <?php                                     
                                        $qry1 = mysqli_query($connection, "SELECT * FROM emp_login where status='1' order by emp_name asc");
                                        while ($row = mysqli_fetch_assoc($qry1)) {
                                        $asset_count = $asset_count + 1;
                                        $emp_name=$row['emp_name'];
                                        $id=$row['id'];
                                        ?>
                                        <option value="<?php echo $id;?>"><?php echo $emp_name;?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        <div class="col-sm-3">
                            <div class="form-group"><label for="">Issue Date</label>
                                <input class="form-control" name="issue_date" placeholder="Select Issue Date" type="date">
                            </div>
                        </div>
                       
                        <div class="col-sm-3">
                            <div class="form-group"><label for="">Remark</label>
                           <textarea class="form-control" name="Issue_Dis"></textarea> <!--<input class="form-control" name="task" placeholder="Enter Task" type="date">-->
                            </div>
                        </div>
                       
                        <div class="col-sm-3">
                            <div class="form-group">
                                <br>
                                <input class="btn btn-primary" type="submit" value="Assign Now" name="submit">
                            </div>
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
</div>
<?php include './includes/Plugin.php'; ?>
<?php include './includes/admin_footer.php'; ?>
                                