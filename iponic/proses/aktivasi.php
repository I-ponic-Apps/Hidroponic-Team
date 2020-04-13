<?php
  require_once '../config/koneksi.php';
  $db 	= new DbConnection();
  $conn = $db->connect();
  $url = $db->url();


  if(!isset($_GET['id']) || empty($_GET['id'])){  
	session_start();
	$email = $_SESSION['email'];
	$sql    = "SELECT * FROM user WHERE iponic_email='".$email."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        include("../PHPMailer/class.phpmailer.php");
        include("../PHPMailer/class.smtp.php"); // note, this is optional - gets called from main class if not already loaded
        $mail             = new PHPMailer();
        $body             = 
            "<body style='margin: 10px;'>
                <div style='width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;'>klik link : <a href='".$url."/proses/aktivasi.php?id=".$row['pegawai_token']."'> LAKUKAN AKTIVASI </a> untuk melakukan proses aktivasi
                </div>
            </body>";
 

            $mail->IsSMTP();
            $mail->SMTPAuth   = true;                  // enable SMTP authentication
            $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
            $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
            $mail->Port       = 587;                   // set the SMTP port

            $mail->Username   = "";   // GMAIL username
            $mail->Password   = "";  // GMAIL password
            $mail->From       = ""; // GMAIL username
            $mail->FromName   = "Aktivasi";
            $mail->Subject    = "Aktivasi";
            $mail->WordWrap   = 50; // set word wrap

            $mail->MsgHTML($body);
            $mail->AddAddress($row['user_email']);
            $mail->IsHTML(true); // send as HTML

            if(!$mail->Send()) {
              echo "Mailer Error: " . $mail->ErrorInfo;
            } else {     
              header("location:../view/beranda.php?pesan=terkirim");
            }
   	} 
 }else{
    //token baru
    $acak="1933FAasdsk25kwBjakjDlff1988"; $panjang='8'; $len=strlen($acak);
	$start=$len-$panjang; $xx=rand('0',$start);
	$yy=str_shuffle($acak);
	$token=substr($yy, $xx, $panjang);
	
	$sql="SELECT * FROM user WHERE iponic_token='".$_GET['id']."'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
			$sql = "UPDATE pegawai 
            SET iponic_aktivasi  = 'Y',
            	iponic_token = '".md5($token)."'
            WHERE iponic_token='".$_GET['id']."'";
			$conn->query($sql);

    	header("location:../view/beranda.php?pesan=sukses");
    } else {
        header("location:../view/beranda.php");
    }
 }
?>