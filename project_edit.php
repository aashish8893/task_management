<?php
include './includes/admin_header.php';
include './includes/data_base_save_update.php';
include 'database/index.php';
session_start();
if ($_SESSION['user']) {
} else {
    header('location:index.php');
}
$id = $_GET['id'];
if($_POST['submit'] == 'Update'){
    
    $name = $_POST['project_name'];
    $description = $_POST['description'];
    $budget = $_POST['budget'];
    $target_start_date = $_POST['target_start_date'];
    $target_end_date = $_POST['target_end_date'];
    $status = $_POST['status'];
    $location = $_POST['project_location'];
    $clientName = $_POST['client_name'];
    $query = "UPDATE `project_master` SET
    `name` = '$name',
    `description` = '$description',
    `project_budget` = '$budget',
    `target_start_date` = '$target_start_date',
    `target_end_date` = '$target_end_date',
    `project_location` = '$location',
    `client_name` = '$clientName',
    `status` = '$status'
    WHERE `project_master`.`id` = $id";

    
    $result = $connection->query($query);
    //echo $result; exit();
    // $url = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
    // $new_url = "location: $url";
    // $url = $new_url.'../project_list.php'; 
    echo "<script>window.location.replace('http://localhost/task_management/project_list.php')</script>";
    exit();
}

$query = "SELECT * FROM `project_master` WHERE id = $id";
$result = $connection->query($query);
if($result->num_rows > 0){
    $row = $result->fetch_assoc();   
}
$id = $row['id'];
$name = $row['name'];
$description = $row['description'];
$user_type = $row['user_type'];
$project_budget = $row['project_budget'];
$target_start_date = $row['target_start_date'];
$target_end_date = $row['target_end_date'];
$task_id = $row['task_id'];
$created_by = $row['created_by'];
$updated_by = $row['updated_by'];
$status = $row['status'];
$location = $row['project_location'];
$clientName = $row['client_name'];

?>

<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>

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
                                <input type="text" id="project_name" value="<?php echo $name; ?>" name="project_name" class="form-control" />
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group"><label for="">Description</label>                                
                                <input type="text" id="description" value="<?php echo $description; ?>" name="description" class="form-control" />
                            </div>
                        </div>
                        <div class="col-sm-1">                            
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-1">                            
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group"><label for="">Project Location</label>                                
                                <input type="text" id="project_location" value="<?php echo $location; ?>" name="project_location" class="form-control" />
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group"><label for="">Client Name</label>                                
                                <input type="text" id="client_name" value="<?php echo $clientName; ?>" name="client_name" class="form-control" />
                            </div>
                        </div>
                        <div class="col-sm-1"></div>
                    </div>

                    <div class="row">
                        <div class="col-sm-1">                            
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group"><label for="">Budget</label>                                
                                <input type="text" id="budget" value="<?php echo $project_budget; ?>" name="budget" class="form-control" />
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group"><label for="">Target Start Date</label>                                
                            <input class="form-control" value="<?php echo $target_start_date; ?>" name="target_start_date" placeholder="Select Start Date" type="date">
                            </div>
                        </div>
                        
                       
                        <div class="col-sm-1">                            
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-4">
                            <div class="form-group"><label for="">Target End Date</label>                                
                            <input class="form-control" value="<?php echo $target_end_date; ?>" name="target_end_date" placeholder="Select End Date" type="date">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group"><label for="">Status</label>                                
                                <select id="status" name="status" class="form-control">
                                    <option value="">---select status---</option>
                                    <option value="1" <?php if($status == 1) echo 'selected';?> >Active</option>
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
                            <input class="btn btn-primary" type="submit" value="Update" name="submit" value="submit" />
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
