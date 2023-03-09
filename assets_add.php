<?php
include './includes/admin_header.php';
include './includes/data_base_save_update.php';
$msg = '';
if (isset($_POST['submit'])) {   
    print_r($_POST);
    
    $device_file = $_FILES['device_file']['name'];
    $device_file_temp = $_FILES['device_file']['tmp_name'];
    move_uploaded_file($device_file_temp, "invoice_img/$device_file");

    $invoice_file = $_FILES['invoice_file']['name'];
    $invoice_file_temp = $_FILES['invoice_file']['tmp_name'];
    move_uploaded_file($device_file_temp, "invoice_img/$invoice_file");

    $asset_tp = $_POST['asset_tp'];
    $CP_nm = "PIIT";
    $asset_count = 1;
    $asset_tp_count = 1;

    $getID = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM asset_tb where delete_status='0' order by created desc"));
    $asserID = $getID['assetID'];

    if($asserID !='')
    {
        $qry1 = mysqli_query($connection, "SELECT * FROM asset_tb where delete_status='0' order by created desc");
        while ($row = mysqli_fetch_assoc($qry1)) {
            $asset_count = $asset_count + 1;
        }
    }
    else {
        $asset_count=1;
    }
            
    $get_at_ID = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM asset_tb where delete_status='0' and  asset_tp='$asset_tp' order by created desc"));
    $asser_tp_ID = $get_at_ID['assetID'];    
    //$asserID = $getID['assetID'];
    if($asser_tp_ID !='')
    {
        $qry2 = mysqli_query($connection, "SELECT * FROM asset_tb where asset_tp='$asset_tp' order by created desc");
        while ($row = mysqli_fetch_assoc($qry2)) {
            $asset_tp_count = $asset_tp_count + 1;
        }
    }
    else {
        $asset_tp_count=1;
    }
    $asset_code = $CP_nm . "/" . $asset_count . "/" . $asset_tp . "/" . $asset_tp_count;
    $csno = $_POST['csno'];
    $make = $_POST['make'];
    $model = $_POST['model'];
    $mac = $_POST['mac'];
    $sn = $_POST['sn'];
    $pro = $_POST['pro'];
    $ram = $_POST['ram'];
    $rom = $_POST['rom'];
    $hdd = $_POST['hdd'];
    $cdrom = $_POST['cdrom'];
    $os = $_POST['os'];
    $vendor = $_POST['vendor'];
    $invoice = $_POST['invoice'];
    $size = $_POST['size'];
    $invoice_date = $_POST['invoice_date'];
    $price = $_POST['price'];
    $guty_warty = $_POST['guty_warty'];
    $guty_warty_yr = $_POST['guty_warty_yr'];
    $ProDis = $_POST['ProDis'];
    $query = "INSERT INTO `asset_tb`(`csno`, `make`, `model`, `mac`, `sn`, `pro`, `ram`, `rom`, `hdd`, `cdrom`, `size`, `os`, `vendor`, `invoice`, `invoice_date`, `price`, `gur_warty`, `gur_warty_yr`, `pro_dis`, `device_img`, `invoice_img`, `status`, `delete_status`, `created`,asset_tp)";
    $query .= " VALUES ('$csno','$make','$model','$mac','$sn','$pro','$ram','$rom','$hdd','$cdrom','$size','$os','$vendor','$invoice','$invoice_date','$price','$guty_warty','$guty_warty_yr','$ProDis','$device_file','$invoice_file','1','0',now(),'$asset_tp')";
    $insert_data = mysqli_query($connection, $query);
    if (!$insert_data) {
        die('QUERY FAILD change pashword' . mysqli_error($connection));
    } else {
        $msg="Record Save Successfully. Company serial number is ".$asset_code;
        echo "<script>alert('".$msg."');</script>";
    }
}

?>
<!--------------------
START - Breadcrumbs
-------------------->
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><span>Add Site</span></li>
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
                        <h5 style="color: blue;border-bottom: 1px solid blue;padding: 10px;">Add Site</h5>                                   
                    </div>  
                </div>
                <form class="container" action="#" method="post" enctype="multipart/form-data">
                    <div class="row">                     
                        <div class="col-sm-3">
                            <div class="form-group"><label for="">Distric ID</label>
                                <input class="form-control" name="csno" placeholder="" type="text">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group"><label for="">Distric Name</label>
                                <input class="form-control" name="make" placeholder="" type="text">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group"><label for="">Site ID</label>
                                <input class="form-control" name="model" placeholder="" type="text">
                            </div>   
                        </div>
                        <div class="col-sm-3">
                         <div class="form-group"><label for="">Site Address</label>
                                        <input class="form-control" name="mac" placeholder="" type="text">
                            </div>
                        </div>
                                           
                        <div class="col-sm-3">
                            <div class="form-group"><label for="">Officer Incharge ID</label>
                                <input class="form-control" name="pro" placeholder="" type="text">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group"><label for="">Officer Name</label>
                                <input class="form-control" name="ram" placeholder="" type="text">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group"><label for="">Officer Contact No.</label>
                                <input class="form-control" name="rom" placeholder="" type="text">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group"><label for="">Officer Email ID</label>
                                <input class="form-control" name="hdd" placeholder="" type="text">
                            </div>
                       </div> 
                        <div class="col-sm-3">
                            <div class="form-group"><label for="">IP Address</label>
                                <input class="form-control" name="cdrom" placeholder="" type="text">
                            </div>
                        </div>
                       
                        <div class="col-sm-3">
                            <div class="form-group">
                                <br>
                                <input class="btn btn-primary" type="submit" value="Add Site" name="submit">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php include './includes/Plugin.php'; ?>
<?php include './includes/admin_footer.php'; ?>
                                