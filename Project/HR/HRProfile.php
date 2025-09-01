<?php 
include("header.php");
include("../Assets/Connection/Connection.php");
session_start();

$selqry = "SELECT * FROM tbl_hr WHERE hr_id = '".$_SESSION['hid']."'";
$rowuser = $conn->query($selqry);
$seldata = $rowuser->fetch_assoc();
?>

<div class="container-fluid">
    <div class="row">

        <!-- Main Content -->
        <div class="col-md-12 content-container d-flex justify-content-center align-items-center ">
            <div class="card p-4 shadow " style="width: 600px;">
                <h1 class="text-center mb-4">My Profile</h1>
                
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">Name</th>
                        <td><?php echo $seldata['hr_name']?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo $seldata['hr_email']?></td>
                    </tr>
                    <tr>
                        <th>Contact</th>
                        <td><?php echo $seldata['hr_contact']?></td>
                    </tr>
                </table>

                <!-- Buttons -->
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <a href="HREditprofile.php" class="btn btn-primary">
                        <i class="bi bi-pencil-square"></i> Edit Profile
                    </a>
                    <a href="HRChangepassword.php" class="btn btn-warning">
                        <i class="bi bi-key"></i> Change Password
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>
