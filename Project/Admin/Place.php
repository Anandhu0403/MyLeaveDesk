<?php 
include("header.php");
include("../Assets/Connection/Connection.php");

if(isset($_POST["btn_submit"])) {
    $hid = $_POST['txtHidden'];
    $place = $_POST["txt_place"];
    $district = $_POST["txt_district"];

    if($hid=="") {
        $insertQuery = "INSERT INTO tbl_place(place_name,district_id) VALUES('".$place."','".$district."')";
        if($conn->query($insertQuery)) {
            echo "<script>alert('Inserted'); window.location='Place.php';</script>";
        }
    } else {
        $updateQuery = "UPDATE tbl_place SET place_name='".$place."', district_id='".$district."' WHERE place_id='".$hid."'";
        if($conn->query($updateQuery)) {
            echo "<script>alert('Updated'); window.location='Place.php';</script>";
        }
    }
}

if(isset($_GET['did'])) {
    $delQry = "DELETE FROM tbl_place WHERE place_id='".$_GET['did']."'";
    if($conn->query($delQry)) {
        echo "<script>alert('Deleted'); window.location='Place.php';</script>";
    }
}

$place_id="";
$place_name="";
if(isset($_GET['eid'])) {
    $selQuery="SELECT * FROM tbl_place WHERE place_id='".$_GET['eid']."'";
    $data=$conn->query($selQuery);
    if($row=$data->fetch_assoc()) {
        $place_id=$row['place_id'];
        $place_name=$row['place_name'];
    }   
}
?>



<body class="bg-light">

<div class="container mt-5 w-75">
   

    <!-- Form Section -->
    <div class="card shadow-lg mb-4">
        <div class="card-header bg-dark text-white">
            Add / Edit Place
        </div>
        <div class="card-body">
            <form method="post" action="Place.php">
                <div class="mb-3">
                    <label for="txt_district" class="form-label">District</label>
                    <select name="txt_district" id="txt_district" class="form-select" required>
                        <option value="">-- Select --</option>
                        <?php
                        $Selqry = "SELECT * FROM tbl_district";
                        $result = $conn->query($Selqry);
                        while($row=$result->fetch_assoc()) {
                            $selected = ($row['district_id'] == ($_POST['txt_district'] ?? '')) ? "selected" : "";
                            echo "<option value='".$row['district_id']."' $selected>".$row['district_name']."</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="txt_place" class="form-label">Place</label>
                    <input type="text" name="txt_place" id="txt_place" class="form-control" 
                           value="<?php echo $place_name ?>" required>
                    <input type="hidden" name="txtHidden" id="txtHidden" value="<?php echo $place_id ?>">
                </div>

                <div class="d-flex justify-content-center gap-2">
                    <button type="submit" name="btn_submit" class="btn btn-success">Submit</button>
                    <button type="reset" class="btn btn-secondary">Clear</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Table Section -->
    <div class="card shadow-lg">
        <div class="card-header bg-secondary text-white">
            Places List
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>SL No</th>
                        <th>District</th>
                        <th>Place</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $Selqry = "SELECT * FROM tbl_place p INNER JOIN tbl_district d ON p.district_id=d.district_id";
                $i=0;
                $result = $conn->query($Selqry);
                while($row=$result->fetch_assoc()) {
                    $i++;
                    echo "<tr>
                            <td>$i</td>
                            <td>".$row['district_name']."</td>
                            <td>".$row['place_name']."</td>
                            <td>
                                <a href='Place.php?eid=".$row['place_id']."' class='btn btn-sm btn-warning'>Edit</a>
                                <a href='Place.php?did=".$row['place_id']."' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                            </td>
                          </tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<?php include("footer.php"); ?>
