<?php
include("header.php");
session_start();
include("../Assets/Connection/Connection.php");
?>

<style>
/* Table container */
.table-container {
    width: 90%;
    margin: 30px auto;
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

/* Table styles */
.table-custom {
    width: 100%;
    border-collapse: collapse;
    font-family: Arial, sans-serif;
}

.table-custom th, 
.table-custom td {
    border: 1px solid #ddd;
    padding: 12px 15px;
    text-align: center;
}

.table-custom th {
    background: #2c3e50;
    color: white;
    font-weight: bold;
    text-transform: uppercase;
}

.table-custom tr:nth-child(even) {
    background-color: #f9f9f9;
}

.table-custom tr:hover {
    background-color: #f1f1f1;
    transition: 0.3s;
}

/* Badge styles */
.badge {
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 13px;
    color: white;
    font-weight: bold;
}

.badge.success {
    background-color: #28a745;
}

.badge.danger {
    background-color: #dc3545;
}

/* Action link */
.action-link {
    text-decoration: none;
    color: #007bff;
    font-weight: bold;
}

.action-link:hover {
    color: #0056b3;
    text-decoration: underline;
}
</style>


<div class="container" style="margin-top:210px">
    <h2 style="text-align:center; margin-bottom:20px;">Work Details</h2>
    <form id="form1" name="form1" method="post" action="">
        <table class="table-custom">
            <tr>
                <th>S.I</th>
                <th>Name</th>
                <th>Description</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            <?php
                $i=0;
                $sel="select * from tbl_work where employee_id='".$_SESSION['eid']."'";
                $data=$conn->query($sel);
                while($row=$data->fetch_assoc()){
                    $i++;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row['work_name']?></td>
                <td><?php echo $row['work_description']?></td>
                <td><?php echo $row['work_startdate']?></td>
                <td><?php echo $row['work_enddate']?></td>
                <td>
                    <?php
                        if ($row['work_status'] == '1') {
                            echo "<span class='badge success'>Submitted</span>";
                        } else {
                            echo "<span class='badge danger'>Pending</span>";
                        }
                    ?>
                </td>
                <td>
                    <?php
                     if ($row['work_status'] == '1') {
                            echo "<span class='badge danger'>Disabled</span>";
                        } else {
                            ?>
<a href="SubmitWork.php?wid=<?php echo $row['work_id']?>" class="action-link">Submit Work</a>
<?php
                        }
                    ?>
                </td>
            </tr>
            <?php
                }
            ?>
        </table>
    </form>
</div>

<?php
include("footer.php");
?>
