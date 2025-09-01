<?php
include("header.php");
include("../Assets/Connection/Connection.php");

if (isset($_POST['btn_submit'])) {
    $name = $_POST['txt_role'];
    $description = $_POST['txt_description'];
    $department = $_POST['sel_dept'];
    $lastdate = $_POST['txt_lastdate'];

    $insertQuery = "INSERT INTO tbl_vacancy(vancancy_role,vacancy_description,dept_id,posted_date,last_date) 
                    VALUES('" . $name . "','" . $description . "','" . $department . "',CURDATE(),'" . $lastdate . "')";
    if ($conn->query($insertQuery)) {
        ?>
        <script>
            alert("Job Posted");
            window.location = "PostVacancy.php";
        </script>
        <?php
    }
}
?>

<div class="container-fluid">
            <div class="col-md-12 content-container d-flex justify-content-center align-items-center ">
    <div class="card shadow-lg p-4 w-50">
        <h3 class="text-center mb-4">Post a New Vacancy</h3>
        <form method="post">
            
            <!-- Role -->
            <div class="mb-3">
                <label for="txt_role" class="form-label">Role</label>
                <input type="text" class="form-control" name="txt_role" id="txt_role" required>
            </div>
            
            <!-- Description -->
            <div class="mb-3">
                <label for="txt_description" class="form-label">Description</label>
                <textarea class="form-control" name="txt_description" id="txt_description" rows="4" required></textarea>
            </div>
            
            <!-- Department -->
            <div class="mb-3">
                <label for="sel_dept" class="form-label">Department</label>
                <select class="form-select" name="sel_dept" id="sel_dept" required>
                    <option value="">-- Select Department --</option>
                    <?php
                    $sel = "SELECT * FROM tbl_department";
                    $data = $conn->query($sel);
                    while ($row = $data->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $row['department_ID'] ?>">
                            <?php echo $row['department_name'] ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            
            <!-- Last Date -->
            <div class="mb-3">
                <label for="txt_lastdate" class="form-label">Last Date</label>
                <input type="date" class="form-control" name="txt_lastdate" id="txt_lastdate" required>
            </div>
            
            <!-- Buttons -->
            <div class="d-flex justify-content-between">
                <button type="submit" name="btn_submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Submit
                </button>
                <button type="reset" name="btn_reset" class="btn btn-secondary">
                    <i class="bi bi-arrow-counterclockwise"></i> Reset
                </button>
            </div>
        </form>
    </div>
</div>
</div>

<?php
include("footer.php");
?>
