<?php
include("../Assets/Connection/Connection.php");
include("header.php");
session_start();

if (isset($_POST["btn_submit"])) {
    $oldpswd = $_POST["txt_opassword"];
    $newpswd = $_POST["txt_npassword"];
    $repswd = $_POST["txt_repassword"];

    $seluser = "SELECT * FROM tbl_admin WHERE admin_id='".$_SESSION['aid']."'";
    $rowuser = $conn->query($seluser);
    $seldata = $rowuser->fetch_assoc();

    $dbpassword = $seldata['admin_password'];

    if ($dbpassword == $oldpswd) {
        if ($newpswd == $repswd) {
            $updateQry = "UPDATE tbl_admin SET admin_password ='" . $newpswd . "' WHERE admin_id='" . $_SESSION['aid'] . "'";
            if ($conn->query($updateQry)) {
                echo "<script>alert('Password Updated'); window.location='AdminProfile.php';</script>";
            }
        } else {
            echo "<script>alert('Password does not match'); window.location='AdminChangepassword.php';</script>";
        }
    } else {
        echo "<script>alert('Your current password is incorrect'); window.location='AdminChangepassword.php';</script>";
    }
}
?>




<!-- Change Password Form -->
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-shield-lock me-2"></i> Change Password</h4>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="mb-3">
                            <label for="txt_opassword" class="form-label">Old Password</label>
                            <input type="password" class="form-control" id="txt_opassword" name="txt_opassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="txt_npassword" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="txt_npassword" name="txt_npassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="txt_repassword" class="form-label">Re-Type New Password</label>
                            <input type="password" class="form-control" id="txt_repassword" name="txt_repassword" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" name="btn_submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Change Password
                            </button>
                            <a href="AdminProfile.php" class="btn btn-secondary">
                                <i class="bi bi-x-circle"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include("footer.php");
    ?>