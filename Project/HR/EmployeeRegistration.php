<?php 
include("header.php");
include("../Assets/Connection/Connection.php");
session_start();

if(isset($_POST["btn_submit"]))
{
    $name = $_POST["txt_name"];
    $email = $_POST["txt_email"];
    $password = $_POST["txt_password"];
    $contact = $_POST["txt_contact"];
    $address = $_POST["txt_address"];
    $salary = $_POST["txt_salary"];
    $dept = $_POST["sel_dept"];
    $photo = $_FILES["photo"]["name"];
    $temp = $_FILES["photo"]["tmp_name"];
    move_uploaded_file($temp,'../Assets/Files/Employee/'.$photo);

    $insertQuery = "INSERT INTO tbl_employee(
        employee_name,
        employee_email,
        employee_password,
        employee_contact,
        employee_address,
        employee_salary,
        photo,
        department_ID
    ) VALUES (
        '$name',
        '$email',
        '$password',
        '$contact',
        '$address',
        '$salary',
        '$photo',
        '$dept'
    )";

    if($conn -> query($insertQuery))
    {
        echo "<script>alert('Inserted');window.location='EmployeeRegistration.php';</script>";
    }
}
?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="mb-4 text-center">Employee Registration</h4>
                    
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="txt_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="txt_email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="txt_password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contact</label>
                            <input type="text" name="txt_contact" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea name="txt_address" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Salary</label>
                            <input type="text" name="txt_salary" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Department</label>
                            <select name="sel_dept" class="form-select" onchange="getProgram(this.value)" required>
                                <option value="">--select--</option>
                                <?php
                                    $Selqry = "SELECT * FROM tbl_department";
                                    $result = $conn->query($Selqry);
                                    while($row=$result->fetch_assoc()) {
                                        echo "<option value='{$row['department_ID']}'>{$row['department_name']}</option>";
                                    }
                                ?> 
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Photo</label>
                            <input type="file" name="photo" class="form-control">
                        </div>
                        <div class="d-grid">
                            <button type="submit" name="btn_submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Submit
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="../Assets/JQ/jQuery.js"></script>
<script>
function getProgram(did) {
    $.ajax({
        url:"../Assets/Ajaxpages/Ajaxdept.php?did="+did,
        success: function(html){
            $("#sel_prgm").html(html);
        }
    });
}
</script>

<?php
include("footer.php");
?>
