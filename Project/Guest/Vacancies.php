<?php
include("header.php");
include("../Assets/Connection/Connection.php");
?>

<div class="container-fluid" style="margin-top:120px; margin-bottom:120px;">
    <h2 class="text-center mb-5 fw-bold text-dark">Vacancy List</h2>

    <div class="table-responsive">
        <table class="table table-hover align-middle shadow-sm" 
               style="border-radius:12px; overflow:hidden;">
            <thead style="background:#243b55; color:#fff;">
                <tr>
                    <th style="width:5%">S.I</th>
                    <th style="width:15%">Role</th>
                    <th style="width:30%">Description</th>
                    <th style="width:15%">Department</th>
                    <th style="width:15%">Posted Date</th>
                    <th style="width:15%">Last Date</th>
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
                <tr style="transition: all 0.2s ease;">
                    <td><?php echo $i ?></td>
                    <td class="fw-semibold text-dark"><?php echo $row['vancancy_role'] ?></td>
                    <td class="text-muted text-start"><?php echo $row['vacancy_description'] ?></td>
                    <td><?php echo $row['department_name'] ?></td>
                    <td><span class="badge bg-success-subtle text-success border border-success px-3 py-2">
                        <?php echo $row['posted_date'] ?></span>
                    </td>
                    <td><span class="badge bg-danger-subtle text-danger border border-danger px-3 py-2">
                        <?php echo $row['last_date'] ?></span>
                    </td>
                </tr>
            <?php
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center text-muted py-4'>No vacancies found</td></tr>";
                }
            ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include("footer.php");
?>
