<?php
include './includes/admin_header.php';
include './includes/data_base_save_update.php';
$msg = '';
$AppCodeObj = new databaseSave();
if (isset($_POST['submit'])) {

    // echo "<pre>";
    // print_r($_POST);
    // exit();
  //  $msg = $AppCodeObj->Insert_pan_data("pan_mst");
//    $userID = $_SESSION['user'];
//    $NewPSWD = $_POST['NewPSWD'];
//    $oldPSWD = $_POST['oldPSWD'];
    $project = $_POST['project'];
    $task_doc = $_FILES['file_attachment']['name'];
    $task_doc_temp = $_FILES['file_attachment']['tmp_name'];
    move_uploaded_file($task_doc_temp, "task_doc/$task_doc");
    
    $employee_id = $_POST['empid'];
    $task  = $_POST['task'];
    $start_date  = $_POST['start_date'];
    $end_date  = $_POST['end_date'];
    //  = $_POST['file_attachment'];
    $query = "INSERT INTO `assign_task`( `emp_id`, `task`, `assignby`, `task_doc`, `work_assign_date`, `work_com_date`,`project_id`,`status`)";
     $query .= " VALUES ('$employee_id','$task','Admin','$task_doc','$start_date','$end_date','$project','Open')";
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
                                    <h5 style="color: blue;border-bottom: 1px solid blue;padding: 10px;">Assign Task</h5>                                   
                                </div>  
                            </div>
                                  <form class="container" action="#" method="post" enctype="multipart/form-data">


                            <div class="row">

                            <!--                          
                                <fieldset class="col-md-12">
                                    <legend>Company Details
                                        <hr></legend>
                                </fieldset>-->

                                <div class="col-sm-3">
                                    <div class="form-group"><label for="">Employee</label>
                                        <select id="emp_id" name="empid" class="form-control">
                                            <option>--select employee</option>
                                            <?php
                                                $qry = mysqli_query($connection, "SELECT * FROM emp_login where user_role='employee' and status='1'");
                                                $count = 0;
                                                while ($row = mysqli_fetch_assoc($qry)) {
                                                    $count = $count + 1;

                                                    $id = $row['id'];
                                                    $emp_code = $row['emp_code'];
                                                    $emp_name = $row['emp_name'];

                                                    echo "<option value=".$id.">".$emp_code."/".$emp_name."</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group"><label for="">Project</label>
                                        <select id="project" name="project" class="form-control">
                                            <option>--select project</option>
                                            <?php
                                                $qry = mysqli_query($connection, "SELECT t1.name, t1.id FROM `project_master` as t1 where status IN ('1','2')");
                                                $count = 0;
                                                while ($row = mysqli_fetch_assoc($qry)) {
                                                    $count = $count + 1;

                                                    $id = $row['id'];
                                                    $emp_code = $row['name'];

                                                    echo "<option class='project' value=".$id.">".$emp_code."</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="col-sm-3">
                                    <div class="form-group"><label for="">Site Id</label>
                                        <input class="form-control" name="task" placeholder="Enter Task" type="text">
                                    </div>
                                </div>disabled -->
                                    <div class="form-group"><label for="">Task</label>
                                        <select id="status" name="task" class="form-control">
                                            <option value="">---select Task---</option>           
                                            <?php
                                                $qry = mysqli_query($connection, "SELECT * FROM `task_master`");
                                                $count = 0;
                                                while ($row = mysqli_fetch_assoc($qry)) {
                                                    $count = $count + 1;
                                                    //echo $row['name'];
                                                    echo "<option value=".$row['name'].">".$row['name']."</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
			<div class="col-md-6">
            <div class="form-group">
              <label for="" class="control-label">Start Date</label>
              <input type="date" class="form-control form-control-sm" autocomplete="off" name="start_date" value="<?php echo isset($start_date) ? date("Y-m-d",strtotime($start_date)) : '' ?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="" class="control-label">End Date</label>
              <input type="date" class="form-control form-control-sm" autocomplete="off" name="end_date" value="<?php echo isset($end_date) ? date("Y-m-d",strtotime($end_date)) : '' ?>">
            </div>
          </div>
		</div>
  <div class="col-sm-3">
                                    <div class="form-group"><label for="">File Attachment</label>
                                        <input name="file_attachment" type="file">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <br>
                                         <input class="btn btn-primary" type="submit" value="Assign Task" name="submit">
                                        <!--<label for="">Conform Password</label>-->
                                        <!--<input class="form-control" name="CPSWD" placeholder="Conform Password" type="password">-->
                                    </div>
                                </div>




<!--                                <div class="form-buttons-w text-right">
                                    <input class="btn btn-primary" type="submit" value="Change Password" name="submit">
                                </div>-->
                            </div>
                        </form>
                            </div>
           
            </div>
        </div>
    </div>
</div>
<script
  src="https://code.jquery.com/jquery-3.6.4.js"
  integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
  crossorigin="anonymous"></script>
<script>
	$('#manage-project').submit(function(e){
		e.preventDefault()
		start_load()
       
		$.ajax({
			url:'ajax.php?action=save_project',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Data successfully saved',"success");
					setTimeout(function(){
						location.href = 'index.php?page=project_list'
					},2000)
				}
			}
		})
	})


    // $('body').on('click', '.project', function(){
    //     alert("hi");
    // })
 
</script>
                                
                                
<?php include './includes/Plugin.php'; ?>
        <?php include './includes/admin_footer.php'; ?>
                                