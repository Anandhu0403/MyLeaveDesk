<?php 
include("header.php");
include("../Assets/Connection/Connection.php");


if(isset($_POST["btn_submit"]))
{
    $hid = $_POST['txtHidden'];
    $name = $_POST["txt_name"];
    $email = $_POST["txt_email"];
    $contact = $_POST["txt_contact"];
    $password = $_POST["txt_password"];
    
    if($hid=="")
    {
        $insertQuery = "INSERT INTO tbl_hr(hr_name, hr_email, hr_contact, hr_password) 
                        VALUES('$name', '$email', '$contact', '$password')";
        if($conn->query($insertQuery))
        {
            echo "<script>alert('Inserted');window.location='HRregistration.php';</script>";
        }
    }
    else 
    {
        $updateQuery = "UPDATE tbl_hr SET hr_name='$name', hr_email='$email', 
                        hr_contact='$contact', hr_password='$password' 
                        WHERE hr_id='$hid'";
        if($conn->query($updateQuery))
        {
            echo "<script>alert('Updated');window.location='HRregistration.php';</script>";
        }
    }
}

if(isset($_GET['did']))
{
    $delQry = "DELETE FROM tbl_hr WHERE hr_id='{$_GET['did']}'";
    if($conn->query($delQry))
    {
        echo "<script>alert('Deleted');window.location='HRregistration.php';</script>";
    }
}

$hr_id = "";
$hr_name = "";
$hr_email = "";
$hr_contact = "";
$hr_password = "";

if(isset($_GET['eid']))
{
    $selQuery = "SELECT * FROM tbl_hr WHERE hr_id='{$_GET['eid']}'";
    $data = $conn->query($selQuery);
    if($row = $data->fetch_assoc())
    {
        $hr_id = $row['hr_id'];
        $hr_name = $row['hr_name'];
        $hr_email = $row['hr_email'];
        $hr_contact = $row['hr_contact'];
        $hr_password = $row['hr_password'];
    }   
}
?>
<div class="container w-75">
<div class="card p-4 bg-light" >
    <h3 class="mb-4 text-primary"><i class="bi bi-person-plus"></i> HR Registration</h3>
    <form method="post" action="HRregistration.php">
        <input type="hidden" name="txtHidden" value="<?php echo $hr_id; ?>">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="txt_name" class="form-control" value="<?php echo $hr_name; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="txt_email" class="form-control" value="<?php echo $hr_email; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Contact</label>
            <input type="text" name="txt_contact" class="form-control" value="<?php echo $hr_contact; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="text" name="txt_password" class="form-control" value="<?php echo $hr_password; ?>" required>
        </div>
        <button type="submit" name="btn_submit" class="btn btn-primary"><i class="bi bi-save"></i> Submit</button>
    </form>
</div>

<div class="card mt-4 p-4 bg-light">
    <h4 class="mb-3 text-secondary"><i class="bi bi-list"></i> HR List</h4>
    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>SL No</th>
                <th>HR</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Password</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $Selqry = "SELECT * FROM tbl_hr";
            $i = 0;
            $result = $conn->query($Selqry);
            while($row = $result->fetch_assoc())
            {
                $i++;
                echo "<tr>
                        <td>{$i}</td>
                        <td>{$row['hr_name']}</td>
                        <td>{$row['hr_email']}</td>
                        <td>{$row['hr_contact']}</td>
                        <td>{$row['hr_password']}</td>
                        <td>
                            <a href='HRregistration.php?eid={$row['hr_id']}' class='btn btn-sm btn-warning'><i class='bi bi-pencil'></i> Edit</a>
                            <a href='HRregistration.php?did={$row['hr_id']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Are you sure?');\"><i class='bi bi-trash'></i> Delete</a>
                        </td>
                      </tr>";
            }
        ?>
        </tbody>
    </table>
</div>
</div>
<?php
include("footer.php");
?>
