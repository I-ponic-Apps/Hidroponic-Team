<!DOCTYPE html>
<html>
<head>
  <title>Lupa Password | Iponic</title>
  <style>
    div {
      width:300px;
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
      <form name="form" method="post" action="../proses/aksiLupaPassword.php"> 
          <?php
          if (isset($_GET['pesan'])) {
            switch ($_GET['pesan']) {
              case 'terkirim':
                echo "<p><font color='green'>Email Terkirim</font></p><hr>";
                break;
              case 'gagal':
                echo "<p><font color='red'> Ketik Email Anda Kembali</font></p><hr>";
                break;
              default:
                break;
            }
          }
          ?>
          <h2> LUPA PASSWORD </h2>
          <hr size="2" color="#000">
          <table align="center" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF"> 
            <tr align="left"> 
              <td>Email</td> <td width="6">:</td> 
              <td><input name="email" type="text" placeholder="Email..."></td>
              <br> 
            </tr> 
            <tr colspan="3" align="center">
              <td colspan="3">
              <hr size="2" color="#000">
                <input type="submit" name="kirim" value="Kirim">
                <input type="reset" name="reset" value="Reset">
              <hr size="2" color="#000">
              </td> 
            </tr>
            <tr colspan="3" align="center">
              <td colspan="3">

                Login...? <a href="login.php">Klik Disini...</a>
              </td> 
            </tr>  
          </table> 
      </form>
  </div> 
</body>
</html>