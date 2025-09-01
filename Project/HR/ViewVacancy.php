<?php
include("header.php");
include("../Assets/Connection/Connection.php");

if(isset($_GET['did'])){
    $delQuery="DELETE FROM tbl_vacancy WHERE vacancy_id='".$_GET['did']."'";
    if($conn->query($delQuery)){
        ?>
        <script>
            alert("Vacancy Deleted");
            window.location="ViewVacancy.php";
        </script>
        <?php
    }
}
?>

<div class="container-fluid">
    <h2 class="text-center mb-4">Vacancy List</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>S.I</th>
                    <th>Role</th>
                    <th>Description</th>
                    <th>Department</th>
                    <th>Posted Date</th>
                    <th>Last Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $i=0;
                $sel="SELECT * FROM tbl_vacancy v 
                      INNER JOIN tbl_department d 
                      ON d.department_ID = v.dept_id";
                $data=$conn->query($sel);

                if($data->num_rows > 0){
                    while($row=$data->fetch_assoc()){
                        $i++;
            ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row['vancancy_role'] ?></td>
                    <td><?php echo $row['vacancy_description'] ?></td>
                    <td><?php echo $row['department_name'] ?></td>
                    <td><?php echo $row['posted_date'] ?></td>
                    <td><?php echo $row['last_date'] ?></td>
                    <td>
                        <a href="ViewVacancy.php?did=<?php echo $row['vacancy_id'] ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Are you sure you want to delete this vacancy?');">
                           Delete
                        </a>
                    </td>
                </tr>
            <?php
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-muted'>No vacancies found</td></tr>";
                }
            ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include("footer.php");
?>
