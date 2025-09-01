<?php
include("header.php");
include("../Assets/Connection/Connection.php");
session_start();

if(isset($_GET['accept'])) {
    $leaveId = $_GET['accept'];
    $updateQry = "UPDATE tbl_leave SET leave_status = '1' WHERE leave_id = '$leaveId'";
    if ($conn->query($updateQry) === TRUE) {
        echo "<script>alert('Leave application approved successfully.');
					window.location=
                    'Acceptedleaves.php';
                    </script>";
    } else {
        echo "<script>alert('Error approving leave application: " . $conn->error . "');</script>";
    }
}
if(isset($_GET['reject'])) {
    $leaveId = $_GET['reject'];
    $updateQry = "UPDATE tbl_leave SET leave_status = '2' WHERE leave_id = '$leaveId'";
    if ($conn->query($updateQry) === TRUE) {
        echo "<script>alert('Leave application rejected successfully.');
							window.location='Rejectleaves.php';</script>";
    } else {
        echo "<script>alert('Error rejecting leave application: " . $conn->error . "');</script>";
    }
}
?>


<body class="bg-light">
<div class="container-fluid">
  <div class="card shadow-lg">
    <div class="card-header bg-primary text-center" style="color:white;">
   <h4 class="mb-0" style="color:white !important;">Leave Applications</h4>

    </div>
    <div class="card-body">
      <form method="post" action="">
        <div class="table-responsive">
          <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-dark">
              <tr>
                <th>SL NO</th>
                <th>Title</th>
                <th>Employee Name</th>
                <th>Leave Type</th>
                <th>Reason</th>
                <th>From</th>
                <th>To</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 0;
              $selQry = "SELECT l.*, c.category_name, s.employee_name
           FROM tbl_leave l
           INNER JOIN tbl_category c ON c.category_id = l.category_id
           INNER JOIN tbl_employee s ON s.employee_id = l.employee_id
             AND l.leave_status = '0'
           ORDER BY l.leave_id DESC";

              $result = $conn->query($selQry);

              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                      $i++;
                      ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo htmlspecialchars($row['leave_title']); ?></td>
                        <td><?php echo htmlspecialchars($row['employee_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['category_name']); ?></td>
                        <td class="text-start"><?php echo nl2br(htmlspecialchars($row['leave_content'])); ?></td>
                        <td><?php echo htmlspecialchars($row['leave_fromdate']); ?></td>
                        <td><?php echo htmlspecialchars($row['leave_enddate']); ?></td>
                       
                        <td>
                          <?php
                          if ($row['leave_status'] == '1') {
                              echo "<span class='badge bg-success'>Approved</span>";
                          } elseif ($row['leave_status'] == '2') {
                              echo "<span class='badge bg-danger'>Rejected</span>";
                          } else {
                              echo "<span class='badge bg-warning text-dark'>Pending</span>";
                          }
                          ?>
                        </td>
                        <td>
                          <a href="?accept=<?php echo $row['leave_id']; ?>" 
                             class="btn btn-sm btn-success" >Accept</a>
         
                          <a href="?reject=<?php echo $row['leave_id']; ?>" 
                             class="btn btn-sm btn-danger ms-1">Reject</a>
               </td>
                      </tr>
                      <?php
                  }
              } else {
                  echo "<tr><td colspan='9'><div class='text-center text-muted'>No leave applications found</div></td></tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include("footer.php"); ?>
</body>
</html>
