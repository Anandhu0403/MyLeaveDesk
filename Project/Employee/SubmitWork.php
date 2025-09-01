<?php
include("header.php");
include("../Assets/Connection/Connection.php");

if (isset($_POST['btn_submit'])) {
    $photo = $_FILES["file_work"]["name"];
    $temp = $_FILES["file_work"]["tmp_name"];
    move_uploaded_file($temp, '../Assets/Files/Works/' . $photo);

    $updateQuery = "UPDATE tbl_work SET work_file='" . $photo . "', work_status=1 WHERE work_id='" . $_GET['wid'] . "'";
    if ($conn->query($updateQuery)) {
        ?>
        <script>
            alert("Work Submitted");
            window.location = "AssignedWork.php";
        </script>
        <?php
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Submit Work</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }

        .form-container {
            max-width: 450px;
            margin: 80px auto;
            background: #fff;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 12px;
            font-size: 15px;
            color: #444;
        }

        input[type="file"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .btn-group {
            text-align: center;
            padding-top: 15px;
        }

        input[type="submit"],
        input[type="reset"] {
            padding: 10px 18px;
            font-size: 14px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin: 0 8px;
            transition: background 0.3s;
        }

        input[type="submit"] {
             background: black;
            color: white;
        }

        input[type="submit"]:hover {
            background: #218838;
        }

        input[type="reset"] {
            background: #dc3545;
            color: white;
        }

        input[type="reset"]:hover {
            background: #c82333;
        }
    </style>
</head>
<body>
    <div class="form-container"  style="margin-top:210px">
        <h2>Submit Work</h2>
        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
            <table>
                <tr>
                    <td>Upload File:</td>
                    <td><input type="file" name="file_work" id="file_work" required /></td>
                </tr>
            </table>
            <div class="btn-group" style="display:flex; align-items:center; justify-content:center; margin-top:20px; gap:9px;">
                <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
                <input type="reset" name="btn_reset" id="btn_reset" value="Reset" />
            </div>
        </form>
    </div>
</body>
</html>

<?php
include("footer.php");
?>
