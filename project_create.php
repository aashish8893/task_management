<?php
include './includes/admin_header.php';
include './includes/data_base_save_update.php';
$msg = '';
$AppCodeObj = new databaseSave();

if (isset($_POST['submit'])) {

    $user_id = $_SESSION['user'];
    
    $taskname = $_POST['project_name'];
    $budget = $_POST['budget'];
    $tsdate = $_POST['target_start_date'];
    $tedate = $_POST['target_end_date'];
    $status = $_POST['status'];
    $description = $_POST['description'];
    $query = "INSERT INTO `project_master` (`id`, `name`, `description`, `user_type`, `project_budget`, `target_start_date`, `target_end_date`,  `status`, `created_by`) VALUES (NULL, '$taskname',  '$description', $user_id, $budget, '$tsdate', '$tedate', '$status', $user_id)";
   
    $res = mysqli_query($connection, $query);
    
    if (!$res) {
        die('QUERY FAILD' . mysqli_error($connection));
    } else {       

        echo "<script>location.replace('./../management_system/project_list.php');</script>";
        //header("Location: ./project_list.php");
        //header("Location: https://www.geeksforgeeks.org");
        //exit;
        //echo "<script>alert('Record Save Successfully');</script>";
    }
    header("Location: ./project_list.php");
}
?>
<script
  src="https://code.jquery.com/jquery-3.6.3.js"
  integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
  crossorigin="anonymous"></script>
<!--------------------
START - Breadcrumbs
-------------------->
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="project_list.php">Back</a></li>
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><span>Create Project</span></li>
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
                        <h5 style="color: blue;border-bottom: 1px solid blue;padding: 10px;">Create Project</h5>                                   
                    </div>  
                </div></br></br>
                <form class="container" action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-1">                            
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group"><label for="">Project Name</label>                                
                                <input type="text" id="project_name" name="project_name" class="form-control" />
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group"><label for="">Description</label>                                
                                <input type="text" id="description" name="description" class="form-control" />
                            </div>
                        </div>
                        <div class="col-sm-1">                            
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-1">                            
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group"><label for="">Budget</label>                                
                                <input type="text" id="budget" name="budget" class="form-control" />
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group"><label for="">Target Start Date</label>                                
                            <input class="form-control" name="target_start_date" placeholder="Select Start Date" type="date">
                            </div>
                        </div>
                        
                       
                        <div class="col-sm-1">                            
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-4">
                            <div class="form-group"><label for="">Target End Date</label>                                
                            <input class="form-control" name="target_end_date" placeholder="Select End Date" type="date">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group"><label for="">Status</label>                                
                                <select id="status" name="status" class="form-control">
                                    <option value="">---select status---</option>
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-1"></div>
                    </div>

                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-1">
                            <div class="form-group"><label for=""></label>                                
                            <input class="btn btn-primary" type="submit" name="submit" value="submit" />
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

    $('#project_name').keypress(function (e) {
        var regex = new RegExp("^[a-zA-Z]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }
        else
        {
        e.preventDefault();
        //return false;
        alert('Please Enter Alphabate');
        return false;
        }
    });
</script>

<?php include './includes/Plugin.php'; ?>
<?php include './includes/admin_footer.php'; ?>