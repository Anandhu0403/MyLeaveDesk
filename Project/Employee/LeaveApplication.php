<?php
include("header.php");
include("../Assets/Connection/Connection.php");
session_start();

if (isset($_POST["btn_submit"])) {
    $title = $_POST["txt_title"];
    $type = $_POST["sel_leave_type"];
    $reason = $_POST["txt_reason"];
    $fromdate = $_POST["txt_fromdate"];
    $todate = $_POST["txt_todate"];

    $insertQry = "
        INSERT INTO tbl_leave 
        (leave_title, leave_content, leave_fromdate, leave_enddate, category_id, employee_id) 
        VALUES 
        ('".$title."','".$reason."','".$fromdate."','".$todate."','".$type."','".$_SESSION['eid']."')";

    if ($conn->query($insertQry)) {
        echo "<script>alert('Application Submitted Successfully'); window.location='LeaveApplication.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Leave Application</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f6f9;
        margin: 0;
        padding: 0;
    }
    .form-container {
        max-width: 600px;
        margin: 60px auto;
        background: #fff;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    h2 {
        text-align: center;
        color: #004d99;
        margin-bottom: 20px;
    }
    .form-group {
        margin-bottom: 15px;
    }
    label {
        font-weight: bold;
        display: block;
        margin-bottom: 6px;
        color: #333;
    }
    input[type="text"],
    input[type="date"],
    select,
    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
        transition: border-color 0.3s;
    }
    input:focus, select:focus, textarea:focus {
        border-color: #004d99;
        outline: none;
    }
    textarea {
        resize: vertical;
    }
    .row {
        display: flex;
        gap: 15px;
    }
    .col {
        flex: 1;
    }
    .btn-group {
        text-align: center;
        margin-top: 20px;
    }
    .btn {
        padding: 10px 25px;
        border: none;
        border-radius: 6px;
        font-size: 15px;
        cursor: pointer;
        margin: 0 10px;
        transition: background 0.3s;
    }
    .btn-submit {
        background: black;
        color: #fff;
    }
    .btn-submit:hover {
        background: #218838;
    }
    .btn-reset {
        background: #6c757d;
        color: #fff;
    }
    .btn-reset:hover {
        background: red;
    }
</style>
</head>
<body>

<div class="form-container" style="margin-top:100px;">
    <h2>Leave Application</h2>
    <form action="" method="post">
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="txt_title" required>
        </div>

        <div class="form-group">
            <label>Leave Type</label>
            <select name="sel_leave_type" required>
                <option value="">-- Select Leave Type --</option>
                <?php
                    $result = $conn->query("SELECT * FROM tbl_category");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='".$row['category_id']."'>".$row['category_name']."</option>";
                    }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label>Reason for Leave</label>
            <textarea name="txt_reason" rows="3" required></textarea>
        </div>

        <div class="row">
            <div class="form-group col">
                <label>From Date</label>
                <input type="date" name="txt_fromdate" required>
            </div>
            <div class="form-group col">
                <label>To Date</label>
                <input type="date" name="txt_todate" required>
            </div>
        </div>

        <div class="btn-group" style="display:flex; align-items:center; justify-content:center; margin-top:20px; gap:9px;">
            <button type="submit" name="btn_submit" class="btn btn-submit">Submit Application</button>
            <button type="reset" class="btn btn-reset">Reset</button>
        </div>
    </form>
</div>

<?php
include("footer.php");
?>
</body>
</html>
