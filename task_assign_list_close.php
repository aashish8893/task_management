<?php
include './includes/admin_header.php';
include './includes/data_base_save_update.php';
include './commonfunction/index.php';
$app_code_obj=new getData();
$msg = '';

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
                                <th>Task</th>
                                <th>Assign By</th>
                                <th>Download File</th>
                                <th>Assign Work Date</th>
                                <th>Work Complete Date</th>
                                <th>Status</th>
                                <th>Change Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $qry = mysqli_query($connection, "SELECT t1.*, t2.emp_name FROM assign_task as t1
                                JOIN emp_login as t2 ON t2.id = t1.emp_id
                                where t1.status=2 order by t1.work_assign_date desc");
                                $count = 0;
                                while ($row = mysqli_fetch_assoc($qry)) {
                                $count = $count + 1;
                                $task_id = $row['task_id'];
                                $emp_id = $row['emp_id']; 
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
                                <td> <?php echo ucfirst($row['emp_name'])?></td>
                                <td>
                                    <?php 
                                        $res = mysqli_query($connection, $app_code_obj->projectIdbyProjectName($row['project_id']));
                                        $res = mysqli_fetch_assoc($res);
                                        print_r($res['name']);
                                    ?>
                                </td>
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
                                <td><a href="#" class="btn btn-success">Close</a> <br><?php //echo $remark;?></td> 
                              
                                <td><a class="btn btn-danger" href="emp_change_status.php?task_id=<?php echo $task_id;?>">Change Status</a></td>
                            </tr>
                            <?php }?>
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
        } );
    } );
</script>                   