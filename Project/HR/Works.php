<?php
include("header.php");
include("../Assets/Connection/Connection.php");

if(isset($_POST['btn_submit'])){
    $name=$_POST['txt_name'];
    $desc=$_POST['txt_description'];
    $start_date=$_POST['txt_startdate'];
    $enddate=$_POST['txt_enddate'];
    $department=$_POST['sel_dept'];
    $employee=$_POST['sel_employee'];
    $insertQry="insert into tbl_work(work_name,work_description,work_startdate,work_enddate,department_id,hr_id,employee_id) VALUES('".$name."','".$desc."','".$start_date."','".$enddate."','".$department."','".$_SESSION['hid']."','".$employee."')";
    if($conn->query($insertQry)){
        ?>
        <script>
            alert("Assigned Work");
            window.location="Works.php";
        </script>
        <?php
    }
}
?>

<div class="container-fluid">
            <div class="col-md-12 content-container d-flex justify-content-center align-items-center ">
    <div class="card shadow-lg p-4 w-50">
        <h3 class="text-center mb-4">Assign Work</h3>
        <form method="post" action="">
            <div class="mb-3">
                <label for="txt_name" class="form-label">Work Name</label>
                <input type="text" class="form-control" name="txt_name" id="txt_name" required>
            </div>
            
            <div class="mb-3">
                <label for="txt_description" class="form-label">Description</label>
                <textarea class="form-control" name="txt_description" id="txt_description" rows="4" required></textarea>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="txt_startdate" class="form-label">Start Date</label>
                    <input type="date" class="form-control" name="txt_startdate" id="txt_startdate" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="txt_enddate" class="form-label">End Date</label>
                    <input type="date" class="form-control" name="txt_enddate" id="txt_enddate" required>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="sel_dept" class="form-label">Department</label>
                <select class="form-select" name="sel_dept" id="sel_dept" onchange="getEmployees(this.value)" required>
                    <option value="">-- Select Department --</option>
                    <?php
                        $sel="select * from tbl_department";
                        $data=$conn->query($sel);
                        while($row=$data->fetch_assoc()){
                            ?>
                            <option value="<?php echo $row['department_ID']?>"><?php echo $row['department_name']?></option>
                            <?php	
                        }
                    ?>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="sel_employee" class="form-label">Employee</label>
                <select class="form-select" name="sel_employee" id="sel_employee" required>
                    <option value="">-- Select Employee --</option>
                </select>
            </div>
            
            <div class="d-flex justify-content-between">
                <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary">Submit</button>
                <button type="reset" name="btn_reset" id="btn_reset" class="btn btn-secondary">Reset</button>
            </div>
        </form>
    </div>
</div>
</div>

<script src="../Assets/JQ/jQuery.js"></script>
<script>
function getEmployees(did) {
    $.ajax({
        url:"../Assets/Ajaxpages/AjaxEmployees.php?did="+did,
        success: function(html){
            $("#sel_employee").html(html);
        }
    });
}
</script>

<?php
include("footer.php");
?>
