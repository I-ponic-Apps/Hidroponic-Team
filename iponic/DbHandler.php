<?php

class DbHandler
{
    private $conn;
    private $url;

    function __construct()
    {
        require_once '../config/koneksi.php';
        $db = new DbConnection();
        $this->conn = $db->connect();
        $this->url = $db->url();
    }

    public function login($email,$password)
    {
        $sql = "SELECT * FROM user WHERE iponic_email='".$email."' AND iponic_password='".md5($password)."'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            header('Content-Type: application/json');
            $data = array();
            $row = $result->fetch_assoc();

            $temp['id']         = $row['iponic_id'];
            $temp['nama']       = $row['iponic_nama'];
            $temp['kontak']     = $row['iponic_kontak'];
            $temp['email']      = $row['iponic_email'];
            $temp['level']      = $row['iponic_level'];             
            $temp['aktivasi']   = $row['iponic_aktivasi'];             
            $temp['token']      = $row['iponic_token'];             
            $data[]             = $temp;

            echo '{ "message" : "Berhasil" ,"results":'.json_encode($data).'}';
        } else {
            header('Content-Type: application/json');
            echo '{"message" : "Email atau password salah"}';
        }
    }

    public function lupa_password($email)
    {
        $sql = "SELECT * FROM user WHERE iponic_email='".$email."'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            include("../PHPMailer/class.phpmailer.php");
            include("../PHPMailer/class.smtp.php"); // note, this is optional - gets called from main class if not already loaded

            $mail = new PHPMailer();
            $body = "
                <body style='margin: 10px;'>
                <div style='width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;'>
                    Anda baru saja merequest untuk proses lupa password, silahkan klik link berikut, apabila memang Anda menginginkan perseubahan tersebut : <br> 
                        <a href='".$this->url."API/passwordBaru.php?id=".$row['iponic_token']."'> LAKUKAN AKTIVASI </a>
                </div>
                </body>";

            echo $body;

            $mail->IsSMTP();
            $mail->SMTPAuth   = true;                  // enable SMTP authentication
            $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
            $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
            $mail->Port       = 587;                   // set the SMTP port

            $mail->Username   = "";   // GMAIL username
            $mail->Password   = "";  // GMAIL password
            $mail->From       = ""; //GMAIL username
            $mail->FromName   = "Lupa Password";
            $mail->Subject    = "Lupa Password";
            $mail->WordWrap   = 50; // set word wrap

            $mail->MsgHTML($body);
            $mail->AddAddress($row['iponic_email']);
            $mail->IsHTML(true); // send as HTML

            if(!$mail->Send()) {
              echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
                header('Content-Type: application/json');           
                echo '{ "message" : "Cek Email"}';
            }
        } else {
            header('Content-Type: application/json');
            echo '{"message" : "Email salah"}';
        }
    }    
}
?>