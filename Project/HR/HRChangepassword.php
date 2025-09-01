<?php
include("header.php");
include("../Assets/Connection/Connection.php");
session_start();

if (isset($_POST["btn_submit"])) {
    $oldpswd = $_POST["txt_opassword"];
    $newpswd = $_POST["txt_npassword"];
    $repswd = $_POST["txt_repassword"];

    $seluser = "SELECT * FROM tbl_hr WHERE hr_id='" . $_SESSION['hid'] . "'";
    $rowuser = $conn->query($seluser);
    $seldata = $rowuser->fetch_assoc();

    $dbpassword = $seldata['hr_password'];

    if ($dbpassword == $oldpswd) {
        if ($newpswd == $repswd) {
            $updateQry = "UPDATE tbl_hr SET hr_password ='" . $newpswd . "' WHERE hr_id='" . $_SESSION['hid'] . "'";
            if ($conn->query($updateQry)) {
                echo "<script>alert('Password Updated'); window.location='HRChangePassword.php';</script>";
            }
        } else {
            echo "<script>alert('Password does not match'); window.location='HRChangePassword.php';</script>";
        }
    } else {
        echo "<script>alert('Your current password is incorrect'); window.location='HRChangePassword.php';</script>";
    }
}
?>

<div class="container-fluid">
    <div class="container my-1">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="text-center mb-4">Change Password</h4>
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
                                    <i class="bi bi-shield-lock me-1"></i> Change Password
                                </button>
                                <a href="AdminProfile.php" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include("footer.php");
?>
