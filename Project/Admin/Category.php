<?php 
include("header.php");
include("../Assets/Connection/Connection.php");

if (isset($_POST["btn_submit"])) {
    $hid = $_POST['txtHidden'];
    $category = $_POST["txt_category"];

    if ($hid == "") {
        $insertQuery = "INSERT INTO tbl_category(category_name) VALUES ('".$category."')";
        if ($conn->query($insertQuery)) {
            echo "<script>alert('Inserted'); window.location='Category.php';</script>";
        }
    } else {
        $updateQuery = "UPDATE tbl_category SET category_name='".$category."' WHERE category_id ='".$hid."'";
        if ($conn->query($updateQuery)) {
            echo "<script>alert('Updated'); window.location='Category.php';</script>";
        }
    }
}

if (isset($_GET['did'])) {
    $delQry = "DELETE FROM tbl_category WHERE category_id='".$_GET['did']."'";
    if ($conn->query($delQry)) {
        echo "<script>alert('Deleted'); window.location='Category.php';</script>";
    }
}

$category_id = "";
$category_name = "";

if (isset($_GET['eid'])) {
    $selQuery = "SELECT * FROM tbl_category WHERE category_id='".$_GET['eid']."'";
    $data = $conn->query($selQuery);
    if ($row = $data->fetch_assoc()) {
        $category_id = $row['category_id'];
        $category_name = $row['category_name'];
    }
}
?>

<div class="container my-4 w-75">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Manage Categories</h4>
        </div>
        <div class="card-body">
            <form method="post" action="Category.php">
                <div class="mb-3 ">
                    <label for="txt_category" class="form-label">Category Name</label>
                    <div class="border rounded">
                    <input type="text" class="form-control" name="txt_category" id="txt_category" 
                           value="<?php echo $category_name; ?>" required>
                    <input type="hidden" name="txtHidden" id="txtHidden" value="<?php echo $category_id; ?>">
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
            <h5 class="mb-0">Category List</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>SL No</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $Selqry = "SELECT * FROM tbl_category";
                    $i = 0;
                    $result = $conn->query($Selqry);
                    while ($row = $result->fetch_assoc()) {
                        $i++;
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['category_name']; ?></td>
                            <td>
                                <a href="Category.php?eid=<?php echo $row['category_id']; ?>" 
                                   class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <a href="Category.php?did=<?php echo $row['category_id']; ?>" 
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Are you sure you want to delete this category?');">
                                    <i class="bi bi-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                        <?php
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
