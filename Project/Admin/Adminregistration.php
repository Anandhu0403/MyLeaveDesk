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
        $insertQuery = "INSERT INTO tbl_admin(admin_name, admin_email, admin_contact, admin_password) 
                        VALUES('".$name."', '".$email."', '".$contact."', '".$password."')";
        if($conn->query($insertQuery))
        {
            echo "<script>alert('Inserted');window.location='Adminregistration.php';</script>";
        }
    }
    else 
    {
        $updateQuery = "UPDATE tbl_admin SET admin_name='".$name."', admin_email='".$email."', 
                        admin_contact='".$contact."', admin_password='".$password."' 
                        WHERE admin_id='".$hid."'";
        if($conn->query($updateQuery))
        {
            echo "<script>alert('Updated');window.location='Adminregistration.php';</script>";
        }
    }
}

if(isset($_GET['did']))
{
    $delQry = "DELETE FROM tbl_admin WHERE admin_id='".$_GET['did']."'";
    if($conn->query($delQry))
    {
        echo "<script>alert('Deleted');window.location='Adminregistration.php';</script>";
    }
}

$admin_id = "";
$admin_name = "";
$admin_email = "";
$admin_contact = "";
$admin_password = "";

if(isset($_GET['eid']))
{
    $selQuery = "SELECT * FROM tbl_admin WHERE admin_id='".$_GET['eid']."'";
    $data = $conn->query($selQuery);
    if($row = $data->fetch_assoc())
    {
        $admin_id = $row['admin_id'];
        $admin_name = $row['admin_name'];
        $admin_email = $row['admin_email'];
        $admin_contact = $row['admin_contact'];
        $admin_password = $row['admin_password'];
    }   
}
?>



<div class="container my-5 w-75">

    <h2 class="mb-4">Admin Registration</h2>

    <form method="post" action="Adminregistration.php" class="border p-4 rounded bg-light shadow-sm">
        <input type="hidden" name="txtHidden" value="<?php echo $admin_id; ?>">

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="txt_name" class="form-control" value="<?php echo $admin_name; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="txt_email" class="form-control" value="<?php echo $admin_email; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Contact</label>
            <input type="text" name="txt_contact" class="form-control" value="<?php echo $admin_contact; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="text" name="txt_password" class="form-control" value="<?php echo $admin_password; ?>" required>
        </div>

        <button type="submit" name="btn_submit" class="btn btn-primary">Submit</button>
    </form>

    <h3 class="mt-5">Admin List</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-hover mt-3">
            <thead class="table-dark">
                <tr>
                    <th>SL No</th>
                    <th>Admin</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Password</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $Selqry = "SELECT * FROM tbl_admin";
                    $i = 0;
                    $result = $conn->query($Selqry);
                    while($row = $result->fetch_assoc())
                    {
                        $i++;
                        echo "<tr>
                                <td>{$i}</td>
                                <td>{$row['admin_name']}</td>
                                <td>{$row['admin_email']}</td>
                                <td>{$row['admin_contact']}</td>
                                <td>{$row['admin_password']}</td>
                                <td>
                                    <a href='Adminregistration.php?eid={$row['admin_id']}' class='btn btn-sm btn-warning'>Edit</a>
                                    <a href='Adminregistration.php?did={$row['admin_id']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Are you sure?');\">Delete</a>
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
