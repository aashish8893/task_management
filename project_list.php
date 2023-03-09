<?php
    include './includes/admin_header.php';
    include './includes/data_base_save_update.php';
    include './commonfunction/index.php';
    $app_code_obj=new getData();
    $msg = '';
    $AppCodeObj = new databaseSave();
    if (isset($_GET['id']) && isset($_GET['Status'])) {   
        $userID = $_GET['id'];
        $Inactive = $_GET['Status']; 
        $msg = $Inactive;
        if ($Inactive == '1') {
            $query = "UPDATE `task_master` SET `status`='0' WHERE id='$userID'";
            $Active_User = mysqli_query($connection, $query);
            if(!$Active_User)
            {
                die('QUERY FAILD' . mysqli_error($connection));
            }
        } else if ($Inactive == '0'){
            $query = "UPDATE `task_master` SET `status`='1' WHERE id='$userID'";
            $deactive_User = mysqli_query($connection, $query);
            if(!$deactive_User)
            {
                die('QUERY FAILD' . mysqli_error($connection));
            }
        }
    // header("location:./admin/retailer_account_list.php");
    }
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!--------------------
START - Breadcrumbs
-------------------->
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="Dashboard.php">Back</a></li>    
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><span>Project List</span></li>
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
                        <h5 style="color: blue;border-bottom: 1px solid blue;padding: 10px;">Project List</h5>    
                    </div>  
                    <div class="col-md-10">                                                               
                        </div>
                        <div class="col-md-2"><form action="project_create.php"><button class="btn btn-primary" style="padding: 12px; margin: 0 0 0 29px;">Create Project</button></form> </div> 
                </div>
                <div class="element-box">
                    <table id="example" style="width: 100%; display: inline-table" class="display table table-bordered table-responsive" style="width:100%">
                        <thead>
                            <tr>
                                <th>S No.</th>
                                <th>Project Name</th>
                                <th>Description</th>
                                <th>Budget</th>
                                <th>Start Target</th>
                                <th>End Target</th>
                                <th>Status</th>
                                <th>Created By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $qry = mysqli_query($connection, "SELECT * FROM `project_master` where status != 3");
                               
                                    $count = 0;
                                    while ($row = mysqli_fetch_assoc($qry)) {                                        
                                    $count = $count + 1;
                                    $id = $row['id'];
                                    $status = $row['status'];
                                
                            ?>
                          <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['description'] ?></td>
                            <td><?php echo $row['project_budget'] ?></td>
                            <td><?php echo $row['target_start_date'] ?></td>
                            <td><?php echo $row['target_end_date'] ?></td>                           
                            <td>                               
                                <?php 
                                if($row['status'] == 1){ ?>
                                    <a href="project_status.php?id=<?php echo $row['id']; ?>&status=<?php echo $row['status']; ?>" class="<?php //echo $btnClass; ?> " >Active
                                    </a>
                                <?php
                                    
                                // echo "<a onclick='myFunction($id,$status)'>Active</a>";
                                }elseif($row['status'] == 2){ ?>
                                    <a href="project_status.php?id=<?php echo $row['id']; ?>&status=<?php echo $row['status']; ?>" class="<?php //echo $btnClass; ?> " >Deactive
                                        </a>
                                <?php }
                                else{ ?>
                                    <a href="project_status.php?id=<?php echo $row['id']; ?>&status=<?php echo $row['status']; ?>" class="<?php //echo $btnClass; ?> " >Delete
                                        </a>
                               <?php 
                                    //echo "<a onclick='myFunction($id,$status)'>Deactive</a>";
                                }
                                ?>
                            </td>

                            <td>
                                <?php 
                                $res = mysqli_query($connection,$app_code_obj->userIdbyUserName());
                                $res = mysqli_fetch_assoc($res);
                                print_r(ucfirst($res['emp_name']));
                                ?>
                            </td>
                            <td>
                                <a href="project_edit.php?id=<?php echo $row['id']; ?>">Edit</a> | <a href="project_status.php?id=<?php echo $row['id']; ?>&status=delete">Delete</a>
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