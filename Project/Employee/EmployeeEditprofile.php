<?php
include("header.php");
include("../Assets/Connection/Connection.php");
session_start();

$selqry = "SELECT * FROM tbl_employee WHERE employee_id = '" . $_SESSION['eid'] . "'";
$rowuser = $conn->query($selqry);
$seldata = $rowuser->fetch_assoc();

// Update profile
if (isset($_POST['btn_update'])) {
    $name = $_POST['txt_name'];
    $email = $_POST['txt_email'];
    $contact = $_POST['txt_contact'];
    $address = $_POST['txt_address'];

    $upQry = "UPDATE tbl_employee SET 
                employee_name = '$name',
                employee_email = '$email',
                employee_contact = '$contact',
                employee_address = '$address'
              WHERE employee_id = '" . $_SESSION['eid'] . "'";

    if ($conn->query($upQry)) {
        echo "<script>
                alert('Profile Updated');
                window.location='EmployeeProfile.php';
              </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile - My Leave Desk</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            background: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .profile-edit-card {
            max-width: 600px;
            margin: 80px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.1);
            overflow: hidden;
            animation: fadeIn 0.6s ease-in-out;
        }

        .card-header {
            background: linear-gradient(135deg, #004d99, #0073e6);
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .card-header h3 {
            margin: 0;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .card-body {
            padding: 25px;
        }

        .form-label {
            font-weight: 500;
            color: #333;
            margin-bottom: 6px;
            display: inline-block;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ccc;
            padding: 10px;
            transition: 0.3s;
        }
        .form-control:focus {
            border-color: #004d99;
            box-shadow: 0 0 6px rgba(0,77,153,0.2);
        }

        .action-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 15px;
        }

        .btn-primary {
            background: #004d99;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 500;
            cursor: pointer;
            transition: 0.3s;
            color: #fff;
        }
        .btn-primary:hover {
            background: #003366;
        }

        .btn-secondary {
            background: #e0e0e0;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 500;
            cursor: pointer;
            transition: 0.3s;
            color: #333;
        }
        .btn-secondary:hover {
            background: #c9c9c9;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="profile-edit-card" style="margin-top:150px;">
    <div class="card-header">
        <h3>Edit Profile</h3>
    </div>
    <div class="card-body">
        <form method="post">
            <div class="mb-3">
                <label for="txt_name" class="form-label">Name</label>
                <input type="text" name="txt_name" id="txt_name" class="form-control" 
                       value="<?php echo $seldata['employee_name']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="txt_email" class="form-label">Email</label>
                <input type="email" name="txt_email" id="txt_email" class="form-control" 
                       value="<?php echo $seldata['employee_email']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="txt_contact" class="form-label">Contact</label>
                <input type="text" name="txt_contact" id="txt_contact" class="form-control" 
                       value="<?php echo $seldata['employee_contact']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="txt_address" class="form-label">Address</label>
                <textarea name="txt_address" id="txt_address" class="form-control" rows="3" required><?php echo $seldata['employee_address']; ?></textarea>
            </div>

            <div class="action-buttons">
                <button type="submit" name="btn_update" class="btn-primary">Update</button>
                <a href="EmployeeProfile.php" class="btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?php include("footer.php"); ?>
