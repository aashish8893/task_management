<?php
    include './includes/admin_header.php';
    include './includes/data_base_save_update.php';
    $msg = '';
    $AppCodeObj = new databaseSave();
    if (isset($_POST['submit'])) {
    
        $device_file = $_FILES['device_file']['name'];
        $device_file_temp = $_FILES['device_file']['tmp_name'];
        move_uploaded_file($device_file_temp, "invoice_img/$device_file");

        $invoice_file = $_FILES['invoice_file']['name'];
        $invoice_file_temp = $_FILES['invoice_file']['tmp_name'];
        move_uploaded_file($device_file_temp, "invoice_img/$invoice_file");

        $csno = $_POST['csno'];
        $make = $_POST['make'];
        $model = $_POST['model'];
        $mac = $_POST['mac'];
        $pro = $_POST['pro'];
        $ram = $_POST['ram'];
        $rom = $_POST['rom'];
        $hdd = $_POST['hdd'];
        $cdrom = $_POST['cdrom'];
        $query = "INSERT INTO `asset_tb`( `make`, `model`, `mac`,  `pro`, `ram`, `rom`, `hdd`, `cdrom`,   `status`, `delete_status`, `created`)";
        $query .= " VALUES (,'$make','$model','$mac','$sn','$pro','$ram','$rom','$hdd','$cdrom','1','0',now())";
        $insert_data = mysqli_query($connection, $query);
        if (!$insert_data) {
            die('QUERY FAILD change pashword' . mysqli_error($connection));
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
        <li class="breadcrumb-item"><span>Assign Site</span></li>
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
                            <h5 style="color: blue;border-bottom: 1px solid blue;padding: 10px;">Assign Site</h5>                                   
                        </div>  
                    </div>
                    <div class="row">

                        <table class="table table-responsive" style="overflow-x: scroll; display:inline-table;">
                            <tr>
                                <th>S No.</th>
                                <th>Distric ID</th>  
                                <th>Distric Name</th>
                                <th>Site ID </th>
                                <th>Site Address</th>
                                <th>Officer Incharge ID</th>
                                <!-- <th>Officer Name </th> -->
                                <th>Officer Contact No.</th>
                                <th>Officer Email ID</th>
                                <th>IP Address</th> 
                        
                            </tr>
                            <?php
                            if(isset($_GET['aID']))
                            {
                            $aID=$_GET['aID'];
                            $delete_query="UPDATE `asset_tb` SET delete_status='1' where `assetID`='$aID'";
                            mysqli_query($connection, $delete_query);    
                            }                      
                            $qry = mysqli_query($connection, "SELECT * FROM asset_tb where delete_status='0' order by created desc");
                            $count = 0;
                            while ($row = mysqli_fetch_assoc($qry)) {
                                $count = $count + 1;
                                $csno = $row['csno'];
                                $make = $row['make'];
                                $model = $row['model'];
                                $mac = $row['mac'];
                                $pro = $row['pro'];
                                $ram = $row['ram'];
                                $rom = $row['rom'];
                                $hdd = $row['hdd'];
                                $cdrom = $row['cdrom'];
                                                        ?>
                                <tr>
                                    <td><?php echo $count;?></td>
                                <td><?php echo $csno;?></td>    
                                    <td><?php echo $make;?></td>
                                    <td><?php echo $model;?></td>
                                    <td><?php echo $mac;?></td>
                                    
                                    <td><?php echo $ram;?></td>
                                    <td><?php echo $rom;?></td>
                                    <td><?php echo $hdd;?></td>
                                    <td><?php echo $cdrom;?></td>
               
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>



    <?php include './includes/Plugin.php'; ?>
    <?php include './includes/admin_footer.php'; ?>
                                    