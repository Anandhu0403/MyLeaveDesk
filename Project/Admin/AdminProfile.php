<?php 
session_start(); // ✅ Start the session first

include("header.php");
include("../Assets/Connection/Connection.php");

if (!isset($_SESSION['aid'])) {
    // Redirect to login if not logged in
    header("Location: ../Guest/Loginpage.php");
    exit();
}

$selqry = "SELECT * FROM tbl_admin WHERE admin_id = '".$_SESSION['aid']."'";
$rowuser = $conn->query($selqry);
$seldata = $rowuser->fetch_assoc();
?>

<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0"><i class="bi bi-person-circle me-2"></i>My Profile</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <td><?php echo $seldata['admin_name']; ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo $seldata['admin_email']; ?></td>
                        </tr>
                        <tr>
                            <th>Contact</th>
                            <td><?php echo $seldata['admin_contact']; ?></td>
                        </tr>
                    </table>

                    <div class="mt-3 d-flex gap-2">
                        <a href="AdminChangePassword.php" class="btn btn-danger">
                            <i class="bi bi-key-fill"></i> Change Password
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include("footer.php");
?>
