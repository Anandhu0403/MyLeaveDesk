<?php 
include("header.php");
include("../Assets/Connection/Connection.php");
session_start();

$selqry = "SELECT * FROM tbl_employee WHERE employee_id = '".$_SESSION['eid']."'";
$rowuser = $conn->query($selqry);
$seldata = $rowuser->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Employee Profile - My Leave Desk</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f7fa;
    }

    .profile-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
    }

    .profile-card {
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.12);
        max-width: 700px;
        width: 100%;
        text-align: center;
    }

    .profile-card h1 {
        font-size: 26px;
        color: #004d99;
        margin-bottom: 25px;
    }

    .profile-img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        border: 4px solid #004d99;
        object-fit: cover;
        margin-bottom: 20px;
    }

    .profile-details {
        margin: 20px 0;
        text-align: left;
    }

    .profile-details table {
        width: 100%;
        border-collapse: collapse;
    }

    .profile-details td {
        padding: 12px 10px;
        border-bottom: 1px solid #e0e0e0;
    }

    .profile-details td:first-child {
        font-weight: bold;
        color: #004d99;
        width: 200px;
    }

    .profile-actions {
        margin-top: 25px;
    }

    .btn-custom {
        display: inline-block;
        padding: 10px 20px;
        margin: 0 10px;
        font-size: 15px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 500;
        transition: 0.3s;
    }

    .btn-edit {
        background-color: #004d99;
        color: #fff;
        border: 2px solid #004d99;
    }
    .btn-edit:hover {
        background-color: #003366;
        border-color: #003366;
    }

    .btn-password {
        background-color: transparent;
        color: #d9534f;
        border: 2px solid #d9534f;
    }
    .btn-password:hover {
        background-color: #d9534f;
        color: #fff;
    }
</style>
</head>
<body>
 <div class="container-fluid" style="margin-top:100px;margin-bottom:210px; display:flex; align-items:center; justify-content:center;">
<div class="profile-container">
    <div class="profile-card">
        <h1>My Profile</h1>
        <img src="../Assets/Files/Employee/<?php echo $seldata['photo']?>" class="profile-img" alt="Profile Picture">
        
        <div class="profile-details">
            <table>
                <tr>
                    <td>Name</td>
                    <td><?php echo $seldata['employee_name']?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo $seldata['employee_email']?></td>
                </tr>
                <tr>
                    <td>Contact</td>
                    <td><?php echo $seldata['employee_contact']?></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><?php echo $seldata['employee_address']?></td>
                </tr>
            </table>
        </div>

        <div class="profile-actions">
            <a href="EmployeeEditprofile.php" class="btn-custom btn-edit">Edit Profile</a>
            <a href="EmployeeChangepassword.php" class="btn-custom btn-password">Change Password</a>
        </div>
    </div>
</div>
</div>
<?php include("footer.php"); ?>
