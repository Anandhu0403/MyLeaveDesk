<?php
include("header.php");
include("../Assets/Connection/Connection.php");
if(isset($_GET['did'])){
    $delQuery="delete from tbl_work where work_id='".$_GET['did']."'";
    if($conn->query($delQuery)){
        ?>
        <script>
            alert("Work Deleted");
            window.location="ViewAssignedWorks.php";
        </script>
        <?php
    }
}
?>

<div class="container-fluid">
  <div class="card shadow">
    <div class="card-header bg-primary text-white text-center" >
      <h4 class="mb-0"  style="color:white !important;">Assigned Works</h4>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
          <thead class="table-dark">
            <tr>
              <th>SI</th>
              <th>Name</th>
              <th>Description</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Work</th>
              <th>Department</th>
              <th>Employee Name</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i=0;
            $selquery="select * from tbl_work w 
                        inner join tbl_employee e on e.employee_id=w.employee_id 
                        inner join tbl_department d on d.department_ID=e.department_ID ";
            $data=$conn->query($selquery);
            while($row=$data->fetch_assoc()){
                $i++;
            ?>
            <tr>
              <td><?php echo $i ?></td>
              <td><?php echo $row['work_name'] ?></td>
              <td><?php echo $row['work_description'] ?></td>
              <td><?php echo $row['work_startdate'] ?></td>
              <td><?php echo $row['work_enddate'] ?></td>
              <td>
              <img src="../Assets/Files/Works/<?php echo $row['work_file'] ?> " width="150px" height="150px"/>

              </td>
              <td><?php echo $row['department_name'] ?></td>
              <td><?php echo $row['employee_name'] ?></td>
              <td>
                <?php
                if($row['work_status']==0){
                    echo "<span class='badge bg-warning text-dark'>Pending</span>";
                }
                else if($row['work_status']==1){
                    echo "<span class='badge bg-success'>Completed</span>";
                }
                ?>
              </td>
              <td>
                <?php if($row['work_status']==0){ ?>
                  <a href='ViewAssignedWorks.php?did=<?php echo $row['work_id'] ?>' 
                     class="btn btn-sm btn-danger" 
                     onclick="return confirm('Are you sure you want to delete this work?');">
                     Delete
                  </a>
                <?php }
                else{
                    echo "<span class='badge bg-danger'>Disabled</span>";

                }
                ?>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php
include("footer.php");
?>