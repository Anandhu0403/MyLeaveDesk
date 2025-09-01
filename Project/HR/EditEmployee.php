<?php 
include("header.php");
include("../Assets/Connection/Connection.php");
session_start();

$emp_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$employee = null;

// Fetch employee data
if ($emp_id > 0) {
    $qry = "SELECT * FROM tbl_employee WHERE employee_id = $emp_id";
    $res = $conn->query($qry);
    if ($res && $res->num_rows > 0) {
        $employee = $res->fetch_assoc();
    } else {
        echo "<script>alert('Employee not found');window.location='Employeedetails.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Invalid request');window.location='Employeedetails.php';</script>";
    exit;
}

if(isset($_POST["btn_submit"]))
{
    $name = $_POST["txt_name"];
    $email = $_POST["txt_email"];
    $contact = $_POST["txt_contact"];
    $address = $_POST["txt_address"];
    $salary = $_POST["txt_salary"];
    $dept = $_POST["sel_dept"];
    $photo = $employee['photo'];

    if(isset($_FILES["photo"]["name"]) && $_FILES["photo"]["name"] != "") {
        $photo = $_FILES["photo"]["name"];
        $temp = $_FILES["photo"]["tmp_name"];
        move_uploaded_file($temp,'../Assets/Files/Employee/'.$photo);
    }

    $updateQuery = "UPDATE tbl_employee SET
        employee_name = '$name',
        employee_email = '$email',
        employee_contact = '$contact',
        employee_address = '$address',
        employee_salary = '$salary',
        photo = '$photo',
        department_ID = '$dept'
        WHERE employee_id = $emp_id";

    if($conn -> query($updateQuery))
    {
        echo "<script>alert('Updated');window.location='Employeedetails.php';</script>";
    }
}
?>

<div class="container-fluid">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="mb-4 text-center">Edit Employee</h4>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="txt_name" class="form-control" required value="<?php echo htmlspecialchars($employee['employee_name']); ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="txt_email" class="form-control" required value="<?php echo htmlspecialchars($employee['employee_email']); ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Contact</label>
                                <input type="text" name="txt_contact" class="form-control" required value="<?php echo htmlspecialchars($employee['employee_contact']); ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <textarea name="txt_address" class="form-control" rows="3" required><?php echo htmlspecialchars($employee['employee_address']); ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Salary</label>
                                <input type="text" name="txt_salary" class="form-control" required value="<?php echo htmlspecialchars($employee['employee_salary']); ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Department</label>
                                <select name="sel_dept" class="form-select" required>
                                    <option value="">--select--</option>
                                    <?php
                                        $Selqry = "SELECT * FROM tbl_department";
                                        $result = $conn->query($Selqry);
                                        while($row=$result->fetch_assoc()) {
                                            $selected = ($row['department_ID'] == $employee['department_ID']) ? "selected" : "";
                                            echo "<option value='{$row['department_ID']}' $selected>{$row['department_name']}</option>";
                                        }
                                    ?> 
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Photo</label>
                                <?php if($employee['photo']) { ?>
                                    <div class="mb-2">
                                        <img src="../Assets/Files/Employee/<?php echo htmlspecialchars($employee['photo']); ?>" 
                                             class="img-thumbnail" style="width:100px;height:100px;object-fit:cover;" alt="Current Photo">
                                        <small class="d-block text-muted">Current photo. Upload to change.</small>
                                    </div>
                                <?php } ?>
                                <input type="file" name="photo" class="form-control">
                            </div>
                            <div class="d-grid">
                                <button type="submit" name="btn_submit" class="btn btn-primary">
                                    <i class="bi bi-save me-1"></i> Update
                                </button>
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
