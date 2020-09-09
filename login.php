<?php
	session_start();
	if (!isset($_POST['txtUser'])){
        die('');
    }
	include 'C:\xampp\htdocs\anatea\connect.php';
	$conn = connect();


    $result = mysqli_query($conn,"SELECT * FROM taikhoan WHERE tendn='" . $_POST["txtUser"] . "' and matkhau = '". $_POST["txtPassword"]."'");

    $row  = mysqli_fetch_array($result);
    if(is_array($row)) 
    {
        $_SESSION["taikhoan"] = $row['TenDN'];
    } 
    if(isset($_SESSION["taikhoan"]))
    {
        if($_POST["txtUser"] == $_SESSION["taikhoan"] && $row['LoaiTK'] == 0)
        {
            $_SESSION['type'] = "staff";
            header("Location:\anatea\staff_view.php");
        }
        elseif($_POST["txtUser"] == $_SESSION["taikhoan"] && $row['LoaiTK'] == 1)
        {
            $_SESSION['type'] = "admin";
            header("Location:\anatea\admin\index.php");
        }
        else
            header("Location:\anatea\index.php");
    }

	mysqli_close($conn);

?>