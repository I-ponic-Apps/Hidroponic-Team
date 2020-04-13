<?php
  require_once '../config/koneksi.php';
  $db 	= new DbConnection();
  $conn = $db->connect();
  $url = $db->url();

  if((isset($_POST['email'])) && (!isset($_GET['id']))){  
  	$email = $_POST['email'];
  	$sql    = "SELECT * FROM user WHERE iponic_email='".$email."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        include("../PHPMailer/class.phpmailer.php");
        include("../PHPMailer/class.smtp.php"); 
        $mail             = new PHPMailer();
        $body             = 
        	"<body style='margin: 10px;'>
        		<div style='width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;'>Anda baru saja merequest untuk proses lupa password, silahkan klik link berikut, apabila memang Anda menginginkan perseubahan tersebut : <br>
               <a href='".$url."view/passwordBaru.php?id=".$row['iponic_token']."'> LUPA PASSWORD </a>
        		</div>
        	</body>";
            $mail->IsSMTP();
            $mail->SMTPAuth   = true;                  // enable SMTP authentication
            $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
            $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
            $mail->Port       = 587;                   // set the SMTP port

            $mail->Username   = "";    // GMAIL username
            $mail->Password   = "";   // GMAIL password
            $mail->From       = "";  // GMAIL username
            $mail->FromName   = "Lupa Password";
            $mail->Subject    = "Lupa Password";
            $mail->WordWrap   = 50; // set word wrap

            $mail->MsgHTML($body);
            $mail->AddAddress($email);
            $mail->IsHTML(true); // send as HTML

            if(!$mail->Send()) {
              echo "Mailer Error: " . $mail->ErrorInfo;
            } else {     
              header("location:../view/lupaPassword.php?pesan=terkirim");
            }
    }else{
    	 header("location:../view/lupaPassword.php?pesan=gagal");
    }
  }elseif(!isset($_POST['email']) && isset($_GET['id'])){
   		//Ambil POST
   		$passwordBaru = $_POST['password_baru'];
   		$ulangPassword = $_POST['password_ulang'];

   		if($passwordBaru == $ulangPassword){
	   		//token baru
		    $acak="1933FAasdsk25kwBjakjDlff1988"; $panjang='8'; $len=strlen($acak);
			$start=$len-$panjang; $xx=rand('0',$start);
			$yy=str_shuffle($acak);
			$token=substr($yy, $xx, $panjang);
			
	 		$sql="SELECT * FROM user WHERE iponic_token='".$_GET['id']."'";
			$result = $conn->query($sql);
			$sql = "UPDATE user 
		            	SET iponic_password  = '".md5($passwordBaru)."',
		            		iponic_token     = '".md5($token)."'
		            	WHERE iponic_token   ='".$_GET['id']."'";
			$conn->query($sql);
		  header("location:../view/passwordBaru.php?pesan=sukses&id=0");  
		}else{
				header("location:../view/passwordBaru.php?pesan=gagal&id=".$_GET['id']); //if tidak password tidak sama
		}
  }else{
   	header("location:../view/lupaPassword.php"); //if tidak ada email dan id
  } 
 
?>