<?php 
include("header.php");
include("../Assets/Connection/Connection.php");

if(isset($_POST["btn_submit"]))
{
    $hid = $_POST['txtHidden'];
    $district = $_POST["txt_district"];  

    if($hid == "")
    {
        $insertQuery = "INSERT INTO tbl_district(district_name) VALUES('".$district."')";
        if($conn->query($insertQuery))
        {
            echo "<script>alert('Inserted'); window.location='District.php';</script>";
        }
    }
    else
    {
        $updateQuery = "UPDATE tbl_district SET district_name='".$district."' WHERE district_id='".$hid."'";
        if($conn->query($updateQuery))
        {
            echo "<script>alert('Updated'); window.location='District.php';</script>";
        }
    }
}

if(isset($_GET['did']))
{
    $delQry = "DELETE FROM tbl_district WHERE district_id='".$_GET['did']."'";
    if($conn->query($delQry))
    {
        echo "<script>alert('Deleted'); window.location='District.php';</script>";
    } 
}

$district_id = "";
$district_name = "";
if(isset($_GET['eid']))
{
    $selQuery = "SELECT * FROM tbl_district WHERE district_id='".$_GET['eid']."'";
    $data = $conn->query($selQuery);
    if($row = $data->fetch_assoc())
    {
        $district_id = $row['district_id'];
        $district_name = $row['district_name'];
    }   
}    
?>

<div class="container mt-4 w-75">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">District</h4>
        </div>
        <div class="card-body">
            <form action="District.php" method="POST">
                <input type="hidden" name="txtHidden" value="<?php echo $district_id ?>" />
                
                <div class="mb-3">
                    
                    <label for="txt_district" class="form-label">District Name</label>
                    <div class="border rounded">
                    <input type="text" name="txt_district" id="txt_district" class="form-control" value="<?php echo $district_name ?>" required />
                    </div>
                </div>
                
                <button type="submit" name="btn_submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>

    <div class="card shadow-sm mt-4">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">District List</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>SL No</th>
                        <th>District</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $Selqry = "SELECT * FROM tbl_district";
                        $i = 0;
                        $result = $conn->query($Selqry);
                        while($row = $result->fetch_assoc())
                        {
                            $i++;
                            echo "<tr>
                                    <td>{$i}</td>
                                    <td>{$row['district_name']}</td>
                                    <td>
                                        <a href='District.php?eid={$row['district_id']}' class='btn btn-warning btn-sm me-1'>Edit</a>
                                        <a href='District.php?did={$row['district_id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure?');\">Delete</a>
                                    </td>
                                  </tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include("footer.php");
?>
