<?php
include("header.php");
include("../Assets/Connection/Connection.php");
session_start();

if(isset($_GET['did'])){
    $delQuery="DELETE FROM tbl_employee WHERE employee_id='".$_GET['did']."'";
    if($conn->query($delQuery)){
        ?>
        <script>
            alert("Employee Deleted");
            window.location="Employeedetails.php";
        </script>
        <?php
    }
}
?>

<div class="container-fluid">
    <div class="container mt-4">
        <h2 class="text-center mb-4">Employee Details</h2>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>SL NO</th>
                        <th>Employee Name</th>
                        <th>Photo</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Salary</th>
                        <th>Department</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php
                    $Selqry = "SELECT s.*, dept.department_name
                               FROM tbl_employee s 
                               INNER JOIN tbl_department dept 
                               ON s.department_ID = dept.department_ID";

                    $i=0;
                    $result = $conn->query($Selqry);

                    if($result && $result->num_rows > 0){
                        while($row=$result->fetch_assoc()) {
                            $i++;
                            echo "<tr>
                                <td>{$i}</td>
                                <td>{$row['employee_name']}</td>
                                <td><img src='../Assets/Files/Employee/{$row['photo']}' class='img-thumbnail' style='width:100px;height:100px;object-fit:cover;'/></td>
                                <td>{$row['employee_email']}</td>
                                <td>{$row['employee_password']}</td>
                                <td>{$row['employee_contact']}</td>
                                <td>{$row['employee_address']}</td>
                                <td>{$row['employee_salary']}</td>
                                <td>{$row['department_name']}</td>
                                <td>
                                    <a href='EditEmployee.php?id={$row['employee_id']}' class='btn btn-sm btn-warning me-2'>Edit</a>
                                    <a href='Employeedetails.php?did={$row['employee_id']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Are you sure you want to delete this employee?')\">Delete</a>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10'>
                                <div class='alert alert-info mb-0 text-center'>
                                    No employees found
                                </div>
                              </td></tr>";
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
