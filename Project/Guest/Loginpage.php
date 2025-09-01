<?php
session_start();
include("header.php");
include("../Assets/Connection/Connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["btn_submit"])) {
    $email = trim($_POST["txt_email"]);
    $password = trim($_POST["txt_password"]);

    if (empty($email) || empty($password)) {
        echo "<script>alert('Both Email and Password are required');</script>";
    } else {
        $email = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn, $password);

        // HR Login
        $selHR = "SELECT * FROM tbl_hr WHERE hr_email='$email' AND hr_password='$password'";
        $HRdata = $conn->query($selHR);

        // Employee Login
        $selEmployee = "SELECT * FROM tbl_employee WHERE employee_email='$email' AND employee_password='$password'";
        $Employeedata = $conn->query($selEmployee);

        // Admin Login
        $selAdmin = "SELECT * FROM tbl_admin WHERE admin_email='$email' AND admin_password='$password'";
        $Admindata = $conn->query($selAdmin);

        if ($Employeerow = $Employeedata->fetch_assoc()) {
            $_SESSION['eid'] = $Employeerow['employee_id'];
            $_SESSION['ename'] = $Employeerow['employee_name'];
            header("Location: ../Employee/EmployeeHomePage.php");
            exit();
        } elseif ($Adminrow = $Admindata->fetch_assoc()) {
            $_SESSION['aid'] = $Adminrow['admin_id'];
            $_SESSION['aname'] = $Adminrow['admin_name'];
            header("Location: ../Admin/AdminHomepage.php");
            exit();
        } elseif ($HRrow = $HRdata->fetch_assoc()) {
            $_SESSION['hid'] = $HRrow['hr_id'];
            $_SESSION['hname'] = $HRrow['hr_name'];
            header("Location: ../HR/HRHomepage.php");
            exit();
        } else {
            echo "<script>alert('Invalid Email or Password');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - My Leave Desk</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
       
        .login-card {
            background: #fff;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            max-width: 400px;
            width: 100%;
        }
        .login-card h3 {
            font-weight: bold;
            margin-bottom: 1rem;
            text-align: center;
            color: #243b55;
        }
        .form-control {
            border-radius: 8px;
        }
        .btn-primary {
            background-color: #4f73d9;
            border: none;
            border-radius: 8px;
        }
        .btn-primary:hover {
            background-color: #3e5fc3;
        }
        .signup-link {
            text-align: center;
            margin-top: 1rem;
        }
        .signup-link a {
            color: #4f73d9;
            text-decoration: none;
        }
        .signup-link a:hover {
            text-decoration: underline;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const emailInput = document.getElementById("txt_email");
            const passwordInput = document.getElementById("txt_password");
            passwordInput.disabled = true;

            emailInput.addEventListener("input", function () {
                const emailVal = emailInput.value.trim();
                const emailPattern = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
                passwordInput.disabled = !emailPattern.test(emailVal);
                if (!emailPattern.test(emailVal)) passwordInput.value = "";
            });
        });
    </script>
</head>
<body>
  <div class="container-fluid" style="margin-top:200px;margin-bottom:210px; display:flex; align-items:center; justify-content:center;">
<div class="login-card">
    <h3><i class="bi bi-box-arrow-in-right"></i> Login</h3>
    <form method="post">
        <div class="mb-3">
            <label for="txt_email" class="form-label">Email</label>
            <input type="email" class="form-control" id="txt_email" name="txt_email" required>
        </div>
        <div class="mb-3">
            <label for="txt_password" class="form-label">Password</label>
            <input type="password" class="form-control" id="txt_password" name="txt_password" required>
        </div>
        <div class="d-grid gap-2" style="display:flex; align-items:center; justify-content:center; margin-top:20px; gap:9px;">
            <button type="submit" name="btn_submit" class="btn btn-primary">Login</button>
            <button type="reset" class="btn btn-outline-secondary">Clear</button>
        </div>
    </form>
    
</div>
</div>
<?php
include("footer.php");
?>