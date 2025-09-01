<?php
include("header.php");
include("../Assets/Connection/Connection.php");
session_start();

if (isset($_POST["btn_submit"])) {
    $oldpswd = $_POST["txt_opassword"];
    $newpswd = $_POST["txt_npassword"];
    $repswd = $_POST["txt_repassword"];

    $seluser = "SELECT * FROM tbl_employee WHERE employee_id='" . $_SESSION['eid'] . "'";
    $rowuser = $conn->query($seluser);
    $seldata = $rowuser->fetch_assoc();

    $dbpassword = $seldata['employee_password'];

    if ($dbpassword == $oldpswd) {
        if ($newpswd == $repswd) {
            $updateQry = "UPDATE tbl_employee SET employee_password ='" . $newpswd . "' WHERE employee_id='" . $_SESSION['eid'] . "'";
            if ($conn->query($updateQry)) {
                echo "<script>alert('Password Updated'); window.location='EmployeeChangepassword.php';</script>";
            }
        } else {
            echo "<script>alert('Password does not match'); window.location='EmployeeChangepassword.php';</script>";
        }
    } else {
        echo "<script>alert('Your current password is incorrect'); window.location='EmployeeChangepassword.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Change Password - Employee</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
    body {
        background: #f4f7fb;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .password-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 90vh;
    }
    .password-card {
        width: 100%;
        max-width: 420px;
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.12);
        animation: fadeIn 0.6s ease-in-out;
    }
    .password-card h3 {
        text-align: center;
        margin-bottom: 25px;
        font-weight: 600;
        color: #004080;
    }
    .form-label {
        font-weight: 500;
        color: #333;
        margin-bottom: 6px;
    }
    .form-control {
        border-radius: 8px;
        padding: 10px;
        border: 1px solid #ccc;
    }
    .form-control:focus {
        border-color: #004080;
        box-shadow: 0 0 0 0.15rem rgba(0,64,128,0.25);
    }
    .btn-primary {
        background-color: #004080;
        border-color: #004080;
        border-radius: 30px;
        padding: 10px 22px;
        font-weight: 500;
        transition: 0.2s;
    }
    .btn-primary:hover {
        background-color: #002d59;
        border-color: #002d59;
    }
    .btn-secondary {
        border-radius: 30px;
        background-color: #004080;
        padding: 10px 22px;
        font-weight: 500;
    }
    .d-flex {
        gap: 10px;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
</head>
<body>

<div class="password-wrapper">
    <div class="password-card">
        <h3>🔒 Change Password</h3>
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
            <div class="d-flex justify-content-between" style="display:flex; align-items:center; justify-content:center; margin-top:20px; gap:9px;">
                <button type="submit" name="btn_submit" class="btn btn-primary">Change</button>
            
            </div>
        </form>
    </div>
</div>

<?php include("footer.php"); ?>
</body>
</html>
