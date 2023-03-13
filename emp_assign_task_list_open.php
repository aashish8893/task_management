<?php
include './includes/admin_header.php';
include './includes/data_base_save_update.php';
include './commonfunction/index.php';
$app_code_obj=new getData();
$msg = '';
$AppCodeObj = new databaseSave();
if (isset($_POST['submit'])) {
    // $msg = $AppCodeObj->Insert_pan_data("pan_mst");
    // $userID = $_SESSION['user'];
    // $NewPSWD = $_POST['NewPSWD'];
    // $oldPSWD = $_POST['oldPSWD'];
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
    $id=  $_SESSION['user'];
  
    $qry = mysqli_query($connection, "SELECT * FROM assign_task where emp_id='$id' and status='1' order by work_assign_date desc");
    
    
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
        $projectid  = $row['project_id'];
        $projectpId  = $row['project_phase_id'];
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
                </a> <br><?php //echo $remark;?>
            </td>
            <td>
                <a style="width: 100%;" class="btn btn-danger" href="emp_change_status.php?task_id=<?php echo $task_id;?>">Status</a>
                <br>
                <br>
                <a style="width: 100%;" class="btn btn-danger" href="assign_task_transfer.php?task_id=<?php echo $task_id;?>">Assign Task</a>
            </td>
        </tr>
<?php }?>
        </tbody>   </table>
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