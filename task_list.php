<?php
include './includes/admin_header.php';
include './includes/data_base_save_update.php';
include './commonfunction/index.php';
$msg = '';

function strip_tags_content($text) {
    return preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '', $text);    
}


echo strip_tags_content('<script> function myFunction() {alert($(".status").html())}</script>');


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
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><span>Task List</span></li>
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
                        <h5 style="color: blue;border-bottom: 1px solid blue;padding: 10px;">Task List</h5>                                   
                    </div>  
                </div>
                <div class="element-box">
                    <table id="example" style="width: 100%; display: inline-table" class="display table table-bordered table-responsive" style="width:100%">
                        <thead>
                            <tr>
                                <th>S No.</th>
                                <th>Task Name</th>
                                <th>Status</th>
                                <!-- <th>Action</th>    -->
                            </tr>
                        </thead>
                        <tbody>
                                <?php
                                    $qry = mysqli_query($connection, "SELECT * FROM `task_master`");
                                    $count = 0;
                                    while ($row = mysqli_fetch_assoc($qry)) {                                        
                                    $count = $count + 1;
                                    $id = $row['id'];
                                    $status = $row['status'];
                                    
                                    //print_r($row);
                                ?>
                          <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td>
                               
                            <?php 
                            if($row['status'] == 1){ ?>
                             <a href="task_list.php?id=<?php echo $row['id']; ?>&Status=<?php echo $row['status']; ?>" class="<?php //echo $btnClass; ?> " >Active
                                </a>
                            <?php
                                
                               // echo "<a onclick='myFunction($id,$status)'>Active</a>";
                            }else{ ?>
                            <a href="task_list.php?id=<?php echo $row['id']; ?>&Status=<?php echo $row['status']; ?>" class="<?php //echo $btnClass; ?> " >Deactive
                                </a>
                            <?php
                                //echo "<a onclick='myFunction($id,$status)'>Deactive</a>";
                            }
                            ?>
                            </td>
                            <!-- <td>
                                Edit | Delete
                            </td> -->
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

        function myFunction(a,b) {
            
            $.ajax({
                url: "change_status_task.php",
                type: "POST",
                data: {'id' : a,'status': b},
                dataType: 'JSON',
                success: function(result){
                    window.location.href();
                }
            });

        }
</script>