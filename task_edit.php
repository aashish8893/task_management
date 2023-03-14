<?php
include './includes/admin_header.php';
include './includes/data_base_save_update.php';
$msg = '';
$AppCodeObj = new databaseSave();

if (isset($_POST['update'])) {   
    $id = $_GET['id'];
    $taskName = $_POST['task_name'];
    $taskTime = $_POST['task_time'];
    $status = $_POST['status'];

    $query = "UPDATE `task_master` SET
    `name` = '$taskName',
    `task_time` = '$taskTime',
    `status` = '$status'
    WHERE `task_master`.`id` = $id";
    $result = $connection->query($query);
    echo "<script>window.location.replace('http://localhost/task_management/task_list.php')</script>";
    echo "<script>alert('Record Save Successfully');</script>";
    exit();
   
}

if($_GET['id']){
    $id = $_GET['id'];
    $query = "SELECT * FROM `task_master` where id = $id";
    $res = mysqli_query($connection, $query);    
    if($res->num_rows > 0){
        $row = $res->fetch_assoc(); 
    }
    $status = $row['status']; 
    
}
?>

<!--------------------
START - Breadcrumbs
-------------------->
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><span>Create Task</span></li>
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
                        <h5 style="color: blue;border-bottom: 1px solid blue;padding: 10px;">Create Task</h5>                                   
                    </div>  
                </div>
                <form class="container" action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">
                            <div class="form-group"><label for="">Task Name:</label>                                
                                <input type="text" value="<?php echo $row['name']; ?>" id="task_name" name="task_name" class="form-control" />
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group"><label for="">No of Resources Required:</label>                                
                                <input type="text" value="<?php echo $row['task_time']; ?>" id="task_time" name="task_time" class="form-control" />
                            </div>
                            <!-- <div class="form-group"><label for="">Task Hour </label> 
                                <label for="appt">Select a time:</label>
                                <input type="time" id="appt" name="appt">
  
                            </div> -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">
                            <div class="form-group"><label for="">Status:</label>                                
                                <select id="status"  name="status" class="form-control">
                                    <option value="">---select status---</option>
                                    <option value="1" <?php if($status == 1) echo 'selected';?>>Active</option>
                                    <option value="0" <?php if($status == 0) echo 'selected';?>>Deactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-1"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-1">
                            <div class="form-group"><label for=""></label>                                
                            <input class="btn btn-primary" type="submit" name="update" value="submit" />
                            </div>
                        </div> 
                        <div class="col-sm-3"></div>
                    </div>
                </form>
                
                
            </div>
        </div>
    </div>
</div>
<script>
	// $('#manage-project').submit(function(e){
	// 	e.preventDefault()
	// 	start_load()
       
	// 	$.ajax({
	// 		url:'ajax.php?action=save_project',
	// 		data: new FormData($(this)[0]),
	// 	    cache: false,
	// 	    contentType: false,
	// 	    processData: false,
	// 	    method: 'POST',
	// 	    type: 'POST',
	// 		success:function(resp){
	// 			if(resp == 1){
	// 				alert_toast('Data successfully saved',"success");
	// 				setTimeout(function(){
	// 					location.href = 'index.php?page=project_list'
	// 				},2000)
	// 			}
	// 		}
	// 	})
	// })
</script>

<?php include './includes/Plugin.php'; ?>
<?php include './includes/admin_footer.php'; ?>