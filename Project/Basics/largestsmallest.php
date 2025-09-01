<?php
$largest="";
$smallest="";
if(isset($_POST['btn_submit']))
{
   $num1=$_POST['txt_number1'];
   $num2=$_POST['txt_number2'];
   if($num1>$num2)
   {
	   $num1=$largest;
	   $num2=$smallest;
   }
   else
   {
	   $num1=$smallest;
	   $num2=$largest;
   }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>Number 1</td>
      <td><label for="txt_number2"></label>
      <input type="text" name="txt_number1" id="txt_number1" /></td>
    </tr>
    <tr>
      <td>Number 2</td>
      <td><label for="txt_number3"></label>
      <input type="text" name="txt_number2" id="txt_number2" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></td>
      
    </tr>
    <tr>
      <td>Largest</td>
      <td><?php echo $largest?></td>
    </tr>
    <tr>
      <td>Smallest</td>
      <td><?php echo $smallest ?></td>
    </tr>
  </table>
</form>
</body>
</html>