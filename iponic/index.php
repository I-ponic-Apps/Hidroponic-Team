<?php
	session_start();
	
	if (isset($_SESSION['email'])) {
		header("location:veiw/beranda.php");
		die();
	}else{
		header("location:view/login.php");
		die();
	}

?>