<?php 
	session_start();
	
    require_once '../config/koneksi.php';
    $db 	= new DbConnection();
    $conn 	= $db->connect();

	$email 		= $_POST['email'];
	$password 	= $_POST['password'];
    $sql 		= "SELECT * FROM user 
    			   WHERE iponic_email='".$email."' AND iponic_password='".md5($password)."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if($result->num_rows > 0){
        $_SESSION['email'] = $row['iponic_email']; 
		$_SESSION['level'] = $row['iponic_level']; 
    	header("location:../view/beranda.php");
    	die();
    }else{
    	header("location:../view/login.php?pesan=gagal");
        die();
    }
?>