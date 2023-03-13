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
if(isset($_GET['delete']))
{
    $id=$_GET['delete'];
    $query="delete from assign_task where task_id='$id'";
     $delete_data = mysqli_query($connection, $query);
      if (!$delete_data) {
        die('QUERY FAILD change pashword' . mysqli_error($connection));
    } else {
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
<div class="content-panel-toggler"><i class="os-icon os-icon-grid-squares-22"></i><span>Sidebar</span>
</div>
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
                    <table id="example" style="width: 100%; display: inline-table" class="display table table-bordered table-responsive" style="width:100%">
                        <thead>
                            <tr>
                            <th>S No.</th>
                            <th>Employee Details</th>
                            <th>Project Name</th>
                            <th>Task</th>
                            <th>Assign By</th>
                            <th>Download File</th>
                            <th>Assign Work Date</th>
                            <th>Work Complete Date</th>
                            <th>Status</th>  
                            </tr>
                        </thead>
                        <tbody>
                                <?php
                                    $qry = mysqli_query($connection, "SELECT t2.*, t1.emp_name FROM `assign_task` as t2 JOIN emp_login as t1 ON t1.id = t2.emp_id order by work_assign_date desc");
                                    $count = 0;
                                    while ($row = mysqli_fetch_assoc($qry)) {                                        
                                    $count = $count + 1;
                                ?>
                            <tr>
                                <td><?php echo $count;?></td>
                                <td> <?php echo ucfirst($row['emp_name']);?></td>
                                <td>
                                    <?php 
                                        $res = mysqli_query($connection, $app_code_obj->projectIdbyProjectName($row['project_id']));
                                        $res = mysqli_fetch_assoc($res);
                                        print_r($res['name']);
                                    ?>
                                </td>
                               
                                <td><?php echo $row['task'];?></td>
                                <td><?php echo $row['assignby'];?></td>
                                <td>
                                    <?php if($row['task_doc'] !='')
                                    {?>
                                    <a href="task_doc/<?php echo $task_doc;?>" class="btn btn-primary">Download</a>  
                                    <?php } ?>
                                </td>
                                <td><?php echo $row['work_assign_date'];?></td> 
                                <td><?php echo $row['work_com_date'];?></td>
                                <td><a href="#" class="btn btn-success">
                                    <?php
                                    if($row['status'] == 1){
                                        echo "Open";
                                    }elseif($row['status'] == 2){
                                        echo "Close";
                                    }elseif($row['status'] == 3){
                                        echo "WIP";
                                    }else{
                                        echo "Cancel";
                                    }                             
                                    ?></a> <br><?php //echo $remark;?>
                                </td> 
                            </tr>

                            <?php }  ?>
                            
                        </tbody>
                    </table>
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
        });
        });
</script>