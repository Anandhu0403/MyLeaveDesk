<?php
include("header.php");
include("../Assets/Connection/Connection.php");
session_start();

// Fetch current hr details
$selqry = "SELECT * FROM tbl_hr WHERE hr_id = '" . $_SESSION['hid'] . "'";
$rowuser = $conn->query($selqry);
$seldata = $rowuser->fetch_assoc();

// Update profile
if (isset($_POST['btn_update'])) {
    $name = $_POST['txt_name'];
    $email = $_POST['txt_email'];
    $contact = $_POST['txt_contact'];
    

    $upQry = "UPDATE tbl_hr SET 
                hr_name = '$name',
                hr_email = '$email',
                hr_contact = '$contact'
              WHERE hr_id = '".$_SESSION['hid'] ."'";

    if ($conn->query($upQry)) {
        echo "<script>
                alert('Profile Updated');
                window.location='HRProfile.php';
              </script>";
    }
}
?>


<div class="container-fluid">
<!-- Centered Form -->
        <div class="col-md-12 content-container d-flex justify-content-center align-items-center ">
    <div class="card shadow p-4" style="max-width: 600px; width: 100%;">
        <h3 class="text-center mb-4">Edit Profile</h3>
        <form method="post">
            <div class="mb-3">
                <label for="txt_name" class="form-label">Name</label>
                <input type="text" name="txt_name" id="txt_name" class="form-control" 
                       value="<?php echo $seldata['hr_name']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="txt_email" class="form-label">Email</label>
                <input type="email" name="txt_email" id="txt_email" class="form-control" 
                       value="<?php echo $seldata['hr_email']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="txt_contact" class="form-label">Contact</label>
                <input type="text" name="txt_contact" id="txt_contact" class="form-control" 
                       value="<?php echo $seldata['hr_contact']; ?>" required>
            </div>

           

            <div class="d-flex justify-content-between">
                <button type="submit" name="btn_update" class="btn btn-primary">
                    <i class="bi bi-save2"></i> Update
                </button>
                <a href="hrProfile.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
</div>

<?php include("footer.php"); ?>
