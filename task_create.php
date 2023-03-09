<?php
include './includes/admin_header.php';
include './includes/data_base_save_update.php';
$msg = '';
$AppCodeObj = new databaseSave();

if (isset($_POST['submit'])) {
    $taskname = $_POST['task_name'];
    $status = $_POST['status'];
    $query = "INSERT INTO `task_master` (`id`, `name`, `status`) VALUES (NULL, '$taskname', '$status')";
   
    $res = mysqli_query($connection, $query);
    
    if (!$res) {
        die('QUERY FAILD' . mysqli_error($connection));
    } else {
        echo "<script>alert('Record Save Successfully');</script>";
    }
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
                        <div class="col-sm-4">
                            <div class="form-group"><label for="">Task Name</label>                                
                                <input type="text" id="task_name" name="task_name" class="form-control" />
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
                    </div>
                    <div class="row">
                        <div class="col-sm-0"></div>
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
</script>

<?php include './includes/Plugin.php'; ?>
<?php include './includes/admin_footer.php'; ?>