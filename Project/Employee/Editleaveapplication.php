<?php
include("header.php");
include("../Assets/Connection/Connection.php");
session_start();

if (!isset($_GET['id'])) {
    echo "<script>alert('No leave selected'); window.location='SubmittedLeaveApplication.php';</script>";
    exit;
}

$leave_id = intval($_GET['id']);

$selQry = "SELECT * FROM tbl_leave WHERE leave_id = '$leave_id' AND employee_id = '{$_SESSION['eid']}'";
$result = $conn->query($selQry);

if ($result->num_rows == 0) {
    echo "<script>alert('Leave application not found'); window.location='SubmittedLeaveApplication.php';</script>";
    exit;
}

$row = $result->fetch_assoc();

if (isset($_POST["btn_update"])) {
    $title = $_POST["txt_title"];
    $reason = $_POST["txt_reason"];
    $fromdate = $_POST["txt_fromdate"];
    $todate = $_POST["txt_todate"];

    $updateQry = "
        UPDATE tbl_leave 
        SET leave_title = '$title', 
            leave_content = '$reason', 
            leave_fromdate = '$fromdate', 
            leave_enddate = '$todate' 
        WHERE leave_id = '$leave_id' AND employee_id = '{$_SESSION['eid']}'
    ";

    if ($conn->query($updateQry)) {
        echo "<script>alert('Leave application updated successfully'); window.location='SubmittedLeaveApplication.php';</script>";
        exit;
    } else {
        echo "<script>alert('Error updating leave application: " . $conn->error . "');</script>";
    }
}
?>

<style>
    
    .form-container {
        max-width: 600px;
        margin: 60px auto;
        padding: 30px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .form-container h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #333;
    }
    .form-group {
        margin-bottom: 18px;
    }
    label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: #444;
    }
    input[type="text"],
    input[type="date"],
    textarea {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 15px;
        transition: 0.2s;
        background: #fafafa;
    }
    input:focus,
    textarea:focus {
        border-color: #4CAF50;
        outline: none;
        background: #fff;
        box-shadow: 0 0 5px rgba(76,175,80,0.3);
    }
    textarea {
        resize: none;
    }
    .form-row {
        display: flex;
        gap: 15px;
    }
    .form-row .form-group {
        flex: 1;
    }
    .form-actions {
        text-align: center;
        margin-top: 20px;
    }
    .btn {
        padding: 10px 20px;
        border-radius: 8px;
        border: none;
        font-size: 15px;
        cursor: pointer;
        transition: 0.3s;
    }
    .btn-success {
        background: black;
        color: #fff;
    }
    .btn-success:hover {
        background: #43a047;
    }
    .btn-secondary {
        background: #777;
        color: #fff;
        margin-left: 10px;
    }
    .btn-secondary:hover {
        background: #555;
    }
</style>

<div class="form-container" style="margin-top:150px;">
    <h2 style="  color: #004d99;">Edit Leave Application</h2>

    <form action="" method="post">
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="txt_title" value="<?php echo htmlspecialchars($row['leave_title']); ?>" required />
        </div>

        <div class="form-group">
            <label>Reason for Leave</label>
            <textarea name="txt_reason" rows="3" required><?php echo htmlspecialchars($row['leave_content']); ?></textarea>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>From Date</label>
                <input type="date" name="txt_fromdate" value="<?php echo $row['leave_fromdate']; ?>" required />
            </div>
            <div class="form-group">
                <label>To Date</label>
                <input type="date" name="txt_todate" value="<?php echo $row['leave_enddate']; ?>" required />
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" name="btn_update" class="btn btn-success">Update Application</button>
            <a href="SubmittedLeaveApplication.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<?php
include("footer.php");
?>
