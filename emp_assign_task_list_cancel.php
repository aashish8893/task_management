<?php
include './includes/admin_header.php';
include './includes/data_base_save_update.php';
include './commonfunction/index.php';
$app_code_obj=new getData();
$msg = '';
$AppCodeObj = new databaseSave();
if (isset($_POST['submit'])) {
  //  $msg = $AppCodeObj->Insert_pan_data("pan_mst");
//    $userID = $_SESSION['user'];
//    $NewPSWD = $_POST['NewPSWD'];
//    $oldPSWD = $_POST['oldPSWD'];
    $task_doc = $_FILES['file_attachment']['name'];
    $task_doc_temp = $_FILES['file_attachment']['tmp_name'];
    move_uploaded_file($task_doc_temp, "task_doc/$task_doc");
    
    $employee_id = $_POST['empid'];
           $task  = $_POST['task'];
           //  = $_POST['file_attachment'];
    $query = "INSERT INTO `assign_task`( `emp_id`, `task`, `assignby`, `task_doc`, `work_assign_date`, `status`)";
     $query .= " VALUES ('$employee_id','$task','Admin','$task_doc',now(),'Open')";
    $update_password = mysqli_query($connection, $query);
    if (!$update_password) {
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
    <li class="breadcrumb-item"><span>Assign Task</span></li>
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
                                    <h5 style="color: blue;border-bottom: 1px solid blue;padding: 10px;">Assign Task List</h5>                                   
                                </div>  
                            </div>
                                <div class="element-box">
  <table id="example" style="width: 100%;" class="display table table-bordered table-responsive" style="width:100%">
        <thead>
            <tr>
                <th>S No.</th>
                <th>Employee Name</th>
                <th>Project Name</th>
                <th>Project Phase</th>
                <th>Task</th>
                <th>Assign By</th>
                <th>Download File</th>
                <th>Assign Work Date</th>
                <th>Work Complete Date</th>
                <th>Status</th>
                <th>Status/Assign Task</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $emp_id=  $_SESSION['user'];
            $qry = mysqli_query($connection, "SELECT * FROM assign_task where emp_id='$emp_id' and status='4' order by work_assign_date desc");
            $count = 0;
            while ($row = mysqli_fetch_assoc($qry)) {
                $count = $count + 1;
                $task_id = $row['task_id'];
                $emp_id1 = $row['emp_id']; 
                $task = $row['task'];
                $assignby = $row['assignby'];
                $task_doc = $row['task_doc'];
                $work_assign_date = $row['work_assign_date'];
                $work_com_date = $row['work_com_date'];
                $status  = $row['status'];
                $remark  = $row['remark'];
        ?>
    <tr>
        <td><?php echo $count;?></td>
        <td> <?php            
            $query = $app_code_obj->userIdbyUserName($emp_id1);
            $res = mysqli_query($connection, $query);
            $res = mysqli_fetch_assoc($res);
            print_r($res['emp_name']);            
            ?></td>
            <td> <?php            
            $query = $app_code_obj->projectIdbyProjectName($emp_id1);
            $res = mysqli_query($connection, $query);
            $res = mysqli_fetch_assoc($res);
            print_r($res['name']);            
            ?></td>
            <td> <?php            
            $query = $app_code_obj->projectpIdbyProjectName($emp_id1);
            $res = mysqli_query($connection, $query);
            $res = mysqli_fetch_assoc($res);
            print_r($res['name']);            
            ?></td>
        <td><?php echo $task;?></td>
        <td><?php echo $assignby;?></td> 
        <td>
        <?php if($task_doc !='')
        {?>
        <a href="task_doc/<?php echo $task_doc;?>" class="btn btn-primary">Download</a>  
        <?php }?>
        </td> 
        <td><?php echo $work_assign_date;?></td> 
        <td><?php echo $work_com_date;?></td> 
        <td><a href="#" class="btn btn-success"> 
                <?php
                    if($status == 1){
                    echo "Open";
                    }elseif($status == 2){
                    echo "Close";
                    }elseif($status == 3){
                    echo "WIP";
                    }else{
                    echo "Cancel";
                    }
                ?>
                </a> <br><?php echo $remark;?></td> 

        <td>
        <a style="width: 100%;" class="btn btn-danger" href="emp_change_status.php?task_id=<?php echo $task_id;?>"> Status</a>
        <br>
        <br>
        <a style="width: 100%;" class="btn btn-danger" href="tran_assign_task.php?task_id=<?php echo $task_id;?>">Assign Task</a>
        </td>
    </tr>
<?php }?>
        </tbody> </table>
   </div>
                            </div>
           
            </div>
        </div>
    </div>
</div>

                                
                                
<?php include './includes/Plugin.php'; ?>
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









        /////////////////////////////////////////////////////////








        <?php
include './includes/admin_header.php';
include './includes/data_base_save_update.php';
$msg = '';
$AppCodeObj = new databaseSave();
if (isset($_POST['submit'])) {
//    $task_doc = $_FILES['file_attachment']['name'];
//    $task_doc_temp = $_FILES['file_attachment']['tmp_name'];
//    move_uploaded_file($task_doc_temp, "task_doc/$task_doc");
//    $emp_id = $_SESSION['user'];
//    $employee_id = $emp_id; //$_POST['empid'];
//    $task = $_POST['task'];
    //  = $_POST['file_attachment'];
//    $query = "INSERT INTO `assign_task`( `emp_id`, `task`, `assignby`, `task_doc`, `work_assign_date`, `status`)";
//    $query .= " VALUES ('$employee_id','$task','Employee','$task_doc',now(),'Open')";
//    $update_password = mysqli_query($connection, $query);
    $device_file = $_FILES['device_file']['name'];
    $device_file_temp = $_FILES['device_file']['tmp_name'];
    move_uploaded_file($device_file_temp, "invoice_img/$device_file");

    $invoice_file = $_FILES['invoice_file']['name'];
    $invoice_file_temp = $_FILES['invoice_file']['tmp_name'];
    move_uploaded_file($device_file_temp, "invoice_img/$invoice_file");

    $csno = $_POST['csno'];
    $make = $_POST['make'];
    $model = $_POST['model'];
    $mac = $_POST['mac'];
//    $sn = $_POST['sn'];
    $pro = $_POST['pro'];
    $ram = $_POST['ram'];
    $rom = $_POST['rom'];
    $hdd = $_POST['hdd'];
   $cdrom = $_POST['cdrom'];
   // $os = $_POST['os'];
 //   $vendor = $_POST['vendor'];
  //  $invoice = $_POST['invoice'];
  //  $invoice_date = $_POST['invoice_date'];
  //  $price = $_POST['price'];
  //  $guty_warty = $_POST['guty_warty'];
  //  $guty_warty_yr = $_POST['guty_warty_yr'];
    //$ProDis = $_POST['ProDis'];
  //  $device_file = $_POST['device_file'];
   // $invoice_file = $_POST['invoice_file'];
    $query = "INSERT INTO `asset_tb`( `make`, `model`, `mac`,  `pro`, `ram`, `rom`, `hdd`, `cdrom`,   `status`, `delete_status`, `created`)";
    $query .= " VALUES (,'$make','$model','$mac','$sn','$pro','$ram','$rom','$hdd','$cdrom','1','0',now())";
    $insert_data = mysqli_query($connection, $query);
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
    <li class="breadcrumb-item"><span>Assign Site</span></li>
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
                <div class="row">

                    <table class="table table-responsive" style="overflow-x: scroll;">
                        <tr>
                            <th>S No.</th>
                           <th>Distric ID</th>  
                            <th>Distric Name</th>
                            <th>Site ID </th>
                            <th>Site Address</th>
                    <!--        <th>S.N.</th> -->
                            <th>Officer Incharge ID</th>
                            <th>Officer Name </th>
                            <th>Officer Contact No.</th>
                            <th>Officer Email ID</th>
                           <th>IP Address</th> 
                     <!--        <th>SIZE</th>
                            <th>OS</th>
                            <th>Vendor</th>
                            <th>Invoice</th>
                            <th>Invoice Date</th>
<!--                             <th>Price</th>
                            <th>Guarantee/Warranty</th>
                            <th>Guarantee/Warranty Year</th>
                            <th>Product Description</th>
                            <th>Device Image</th>
                            <th>Invoice</th>   
                            <th>Edit</th>
                            <th>Delete</th> -->
                        </tr>
                        <?php
                        if(isset($_GET['aID']))
                        {
                        $aID=$_GET['aID'];
                        $delete_query="UPDATE `asset_tb` SET delete_status='1' where `assetID`='$aID'";
                        mysqli_query($connection, $delete_query);    
                        }                      
                        $qry = mysqli_query($connection, "SELECT * FROM asset_tb where delete_status='0' order by created desc") or die("select query fail" . mysqli_error());
                        $count = 0;
                        while ($row = mysqli_fetch_assoc($qry)) {
                            $count = $count + 1;

//                            $task_id = $row['task_id'];
//                            $emp_id = $row['emp_id'];
//                            $task = $row['task'];
//                            $assignby = $row['assignby'];
//                            $task_doc = $row['task_doc'];
//                            $work_assign_date = $row['work_assign_date'];
//                            $work_com_date = $row['work_com_date'];
//                            $status = $row['status'];
//                            $remark = $row['remark'];
                //            $assetID = $row['assetID'];
                            $csno = $row['csno'];
                            $make = $row['make'];
                            $model = $row['model'];
                            $mac = $row['mac'];
                 //           $sn = $row['sn'];
                            $pro = $row['pro'];
                            $ram = $row['ram'];
                            $rom = $row['rom'];
                            $hdd = $row['hdd'];
                           $cdrom = $row['cdrom'];
                     //       $size = $row['size'];
                    //        $os = $row['os'];
                      //      $vendor = $row['vendor'];
                        //    $invoice = $row['invoice'];
                          //  $invoice_date = $row['invoice_date'];
        //                    $price = $row['price'];
          //                  $gur_warty = $row['gur_warty'];
            //                $gur_warty_yr = $row['gur_warty_yr'];
              //              $pro_dis = $row['pro_dis'];
                      //      $device_img = $row['device_img'];
                  //          $invoice_img = $row['invoice_img'];
                 //           $status = $row['status'];
                  //          $delete_status = $row['delete_status'];
                   //         $created = $row['created'];
                            ?>
                            <tr>
                                <td><?php echo $count;?></td>
                            <td><?php echo $csno;?></td>    
                                <td><?php echo $make;?></td>
                                <td><?php echo $model;?></td>
                                <td><?php echo $mac;?></td>
                                 <!--<td><?php echo $sn;?></td> -->
                                <td><?php echo $pro;?></td>
                                <td><?php echo $ram;?></td>
                                <td><?php echo $rom;?></td>
                                <td><?php echo $hdd;?></td>
                              <td><?php echo $cdrom;?></td>  
               <!--                  
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
</div>



<?php include './includes/Plugin.php'; ?>
<?php include './includes/admin_footer.php'; ?>
                                