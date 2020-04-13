<!DOCTYPE html>
<html>
<head>
  <title>Password Baru | Iponic</title>
  <style>
    div {
      width:350px;
      height: auto;
      border: 2px solid black;
      text-align:center;
      margin:0 auto;
    }
</style>
</head>
<body>

<br><br><br><br>
  <div>
   <?php
      require_once '../config/koneksi.php';
      $db   = new DbConnection();
      $conn = $db->connect();
      $sql="SELECT * FROM user WHERE iponic_token='".$_GET['id']."'";
      $result = $conn->query($sql);
      
      if(isset($_GET['pesan']) && ($_GET['pesan']== "gagal")){
        echo "<p><font color='red'>Password Baru dan Ulangi Password Tidak Sama</font></p><hr>";
      }           
      ?>
      <h2> PASSWORD BARU </h2>
      <hr size="2" color="#000">
      <form name='form' method='post' action='<?php echo "../proses/aksiLupaPassword.php?id=".$_GET['id'];?>'> 
          <table align="center" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF"> 
            <?php
            if(isset($_GET['pesan']) && ($_GET['pesan']== "sukses")){
              echo "<tr align='center'>
                      <td><p>Password telah diperbaharui<br> <a href='login.php'>LOGIN</a></p><td>
                    </tr>";
            }elseif((isset($_GET['id'])) && ($result->num_rows==0)){
              echo "<tr align='center'>
                      <td><p>Password telah diperbaharui sebelumnya</p><td>
                    </tr>";
            }elseif((isset($_GET['id'])) && ($result->num_rows>0)){
           ?>
 
            <tr align="left"> 
              <td>Password Baru</td> <td width="6">:</td> 
              <td><input name="password_baru" type="password" placeholder="Password Baru..."></td>
              <br> 
            </tr> 
            <tr align="left"> 
              <td>Ulangi Password</td> <td>:</td> 
              <td><input name="password_ulang" type="password" placeholder="Ulangi Password..."></td> 
            </tr> 
            <tr colspan="3" align="center">
              <td colspan="3">
              <hr size="2" color="#000">
                <input type="submit" name="login" value="OK">
                <input type="reset" name="reset" value="Reset">
              </td> 
            </tr>
            <?php 
              }else{
                  header("location: ../index.php");
              } 
            ?>
          </table> 
      </form>
  </div> 
</body>
</html>