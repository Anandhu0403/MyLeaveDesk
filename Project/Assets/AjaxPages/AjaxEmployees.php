
<?php
include("../Connection/Connection.php");

?>

<option value="">---select---</option>

<?php

$sel="select * from tbl_employee where department_ID='".$_GET["did"]."'";
$re=$conn->query($sel);
		while($row=$re->fetch_assoc())
		{
			?>
            <option value="<?php echo $row["employee_id"];?>"><?php echo $row["employee_name"];?></option>
            <?php
		}
	



?>