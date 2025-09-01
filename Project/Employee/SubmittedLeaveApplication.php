<?php
include("header.php");
include("../Assets/Connection/Connection.php");
session_start();

// ✅ DELETE leave application
if (isset($_GET['id'])) {
    $leaveId = intval($_GET['id']); // prevent SQL injection

    // Delete from database
    $delQry = "DELETE FROM tbl_leave WHERE leave_id = '$leaveId' AND employee_id = '{$_SESSION['eid']}'";
    if ($conn->query($delQry)) {
        echo "<script>alert('Leave application deleted successfully.'); window.location='SubmittedLeaveApplication.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error deleting leave application: " . $conn->error . "');</script>";
    }
}
?>

<style>
/* ====== Page Layout ====== */


/* ====== Heading ====== */
.container h2 {
    text-align: center;
    margin-bottom: 25px;
    font-size: 26px;
    color: #333;
}

/* ====== Table Styling ====== */
.table-wrapper {
    overflow-x: auto;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

table {
    width: 100%;
    border-collapse: collapse;
    font-size: 15px;
}

thead {
    background: #2c3e50;
    color: #fff;
}

thead th {
    padding: 12px;
    text-align: center;
    font-weight: 600;
    letter-spacing: 0.5px;
}

tbody tr {
    transition: background 0.2s ease-in-out;
}

tbody tr:nth-child(even) {
    background: #f9f9f9;
}

tbody tr:hover {
    background: #f1f1f1;
}

tbody td {
    padding: 12px;
    text-align: center;
    color: #444;
}

/* ====== Badges ====== */
.badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: bold;
    display: inline-block;
}

.badge.success {
    background: #27ae60;
    color: white;
}

.badge.danger {
    background: #c0392b;
    color: white;
}

.badge.warning {
    background: #f39c12;
    color: #222;
}

/* ====== Buttons ====== */
.btn {
    padding: 6px 14px;
    border: none;
    border-radius: 5px;
    font-size: 13px;
    cursor: pointer;
    text-decoration: none;
    transition: background 0.2s ease-in-out;
    margin: 2px;
    display: inline-block;
}

.btn.primary {
    background: #2980b9;
    color: #fff;
}

.btn.primary:hover {
    background: #1f6391;
}

.btn.danger {
    background: #e74c3c;
    color: #fff;
}

.btn.danger:hover {
    background: #c0392b;
}

.text-muted {
    color: #999;
}
</style>


<div class="container" style="margin-top:210px">
    <h2>📄 Submitted Leave Applications</h2>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>SL NO</th>
                    <th>Title</th>
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
            $selQry = "
                SELECT l.*, c.category_name 
                FROM tbl_leave l 
                INNER JOIN tbl_category c ON l.category_id = c.category_id
                WHERE l.employee_id = '" . $_SESSION['eid'] . "'
                ORDER BY l.leave_id DESC
            ";
            $result = $conn->query($selQry);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo htmlspecialchars($row['leave_title']); ?></td>
                        <td><?php echo htmlspecialchars($row['category_name']); ?></td>
                        <td><?php echo nl2br(htmlspecialchars($row['leave_content'])); ?></td>
                        <td><?php echo htmlspecialchars($row['leave_fromdate']); ?></td>
                        <td><?php echo htmlspecialchars($row['leave_enddate']); ?></td>
                        <td>
                            <?php
                            if ($row['leave_status'] == '1') {
                                echo "<span class='badge success'>Approved</span>";
                            } elseif ($row['leave_status'] == '2') {
                                echo "<span class='badge danger'>Rejected</span>";
                            } else {
                                echo "<span class='badge warning'>Pending</span>";
                            }
                            ?>
                        </td>
                        <td>
                             <?php
                            if ($row['leave_status'] == '1') {
                                  echo "<span class='badge success'>Approved</span>";
                            }
                            else{
                                ?>
                                 <a href="Editleaveapplication.php?id=<?php echo $row['leave_id']; ?>" class="btn primary">Edit</a>
                            <a href="?id=<?php echo $row['leave_id']; ?>" 
                               onclick="return confirm('Are you sure you want to delete this leave application?');" 
                               class="btn danger">Delete</a>
                                <?php
                            }
                           ?>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='8' class='text-muted'>No leave applications found</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include("footer.php");
?>
