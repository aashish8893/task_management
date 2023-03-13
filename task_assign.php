<?php
include './includes/admin_header.php';
include './includes/data_base_save_update.php';
$msg = '';
$AppCodeObj = new databaseSave();
if (isset($_POST['submit'])) {
    $project = $_POST['project'];
    $projectp = $_POST['project_phase'];
    $task_doc = $_FILES['file_attachment']['name'];
    $task_doc_temp = $_FILES['file_attachment']['tmp_name'];
    move_uploaded_file($task_doc_temp, "task_doc/$task_doc");    
    $employee_id = $_POST['empid'];
    $task  = $_POST['task'];
    $start_date  = $_POST['start_date'];
    $end_date  = $_POST['end_date'];
    //  = $_POST['file_attachment'];   
        $query = "INSERT INTO `assign_task`( `emp_id`, `task`, `assignby`, `task_doc`, `work_assign_date`, `work_com_date`,`project_id`, `project_phase_id`,`status`)";
        $query .= " VALUES ('$employee_id','$task','Admin','$task_doc','$start_date','$end_date','$project', '$projectp','1')";
        $update_password = mysqli_query($connection, $query);
        if (!$update_password) {
            die('QUERY FAILD change pashword' . mysqli_error($connection));
        } else {        
            if($_POST['project'] AND $_POST['task']){
                echo "<script>location.replace('./../task_management/task_assign_list.php');</script>";
                ///echo "<script>alert('Record Save Successfully');</script>";
            }            
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
</br>
                                    <div class="row">
                                        <div class="col-sm-1"></div>

                                            <!--                          
                                            <fieldset class="col-md-12">
                                            <legend>Company Details
                                            <hr></legend>
                                            </fieldset>-->

                                        <div class="col-sm-3">
                                            <div class="form-group"><label for="">Employee</label>
                                                <select id="emp_id" name="empid" class="form-control">
                                                    <option value="">--select employee</option>
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
                                                    <option value="">--select project</option>
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
                                        <div class="col-sm-1"></div>
                                    </div>
                                <div class="row">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-3">
                                        <div class="form-group"><label for="">Project Phase</label>
                                            <select id="project_phase" name="project_phase" class="form-control">
                                                <option value="">--select project</option>
                                                <?php
                                                    $qry = mysqli_query($connection, "SELECT * FROM `project_phase_master` WHERE status =1");
                                                    $count = 0;
                                                    while ($row = mysqli_fetch_assoc($qry)) {
                                                        $count = $count + 1;

                                                        $id = $row['id'];
                                                        $emp_code = ucfirst($row['name']);

                                                        echo "<option class='project_phase' value=".$id.">".$emp_code."</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
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
                                    <div class="col-sm-1"></div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-3">
                                        <div class="form-group"><label for="">Start Date</label>
                                            <input name="start_date" autocomplete="off" type="date" value="<?php echo isset($start_date) ? date("Y-m-d",strtotime($start_date)) : '' ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group"><label for="">End Date</label>
                                            <input name="end_date" autocomplete="off" type="date" value="<?php echo isset($end_date) ? date("Y-m-d",strtotime($end_date)) : '' ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-1"></div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-3">
                                        <div class="form-group"><label for="">File Attachment</label>
                                            <input name="file_attachment" type="file">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        
                                    </div>
                                    <div class="col-sm-1"></div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-1"></div>
                                        <div class="col-sm-3">
                                        <div class="form-group">
                                                <br>
                                                <input class="btn btn-primary" type="submit" value="submit" name="submit">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            
                                        </div>
                                    </div>
                                </div> 
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
                                