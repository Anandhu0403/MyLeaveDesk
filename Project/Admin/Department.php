<?php 
include("header.php");
include("../Assets/Connection/Connection.php");

if (isset($_POST["btn_submit"])) {
    $department = $_POST["txt_dept"];
    $hid = $_POST["txtHidden"];

    if ($hid == "") {
        $insertQuery = "INSERT INTO tbl_department(department_name) VALUES ('".$department."')";
        if ($conn->query($insertQuery)) {
            echo "<script>alert('Inserted'); window.location='Department.php';</script>";
        }
    } else {
        $updateQuery = "UPDATE tbl_department SET department_name='".$department."' WHERE department_ID='".$hid."'";
        if ($conn->query($updateQuery)) {
            echo "<script>alert('Updated'); window.location='Department.php';</script>";
        }
    }
}

if (isset($_GET['did'])) {
    $delQuery = "DELETE FROM tbl_department WHERE department_ID='".$_GET['did']."'";
    if ($conn->query($delQuery)) {
        echo "<script>alert('Deleted'); window.location='Department.php';</script>";
    }
}

$department_ID = "";
$department_name = "";

if (isset($_GET['eid'])) {
    $selQuery = "SELECT * FROM tbl_department WHERE department_ID='".$_GET['eid']."'";
    $data = $conn->query($selQuery);
    if ($row = $data->fetch_assoc()) {
        $department_ID = $row['department_ID'];
        $department_name = $row['department_name'];
    }
}
?>

<div class="container mt-4 w-75">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Manage Departments</h4>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="txt_dept" class="form-label">Department Name</label>
                    <div class="border rounded">
                    <input type="text" class="form-control" name="txt_dept" id="txt_dept" 
                           value="<?php echo $department_name ?>" required>
                    <input type="hidden" name="txtHidden" value="<?php echo $department_ID ?>">
                    </div>
                </div>
                <button type="submit" name="btn_submit" class="btn btn-success">
                    <i class="bi bi-save"></i> Submit
                </button>
            </form>
        </div>
    </div>

    <div class="card shadow-sm mt-4">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Department List</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>S.I No</th>
                        <th>Department Name</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 0;  
                    $selQuery = "SELECT * FROM tbl_department";
                    $data = $conn->query($selQuery);
                    while ($row = $data->fetch_assoc()) {
                        $i++;
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $row['department_name'] ?></td>
                        <td>
                            <a href="Department.php?eid=<?php echo $row['department_ID']?>" 
                               class="btn btn-warning btn-sm me-1">
                               <i class="bi bi-pencil"></i> Update
                            </a>
                            <a href="Department.php?did=<?php echo $row['department_ID']?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Are you sure you want to delete this department?');">
                               <i class="bi bi-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php 
include("footer.php");
?>
