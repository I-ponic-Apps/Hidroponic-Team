<!DOCTYPE html>
<html>
<head>
  <title>Login | Iponic</title>
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
      <form name="form" method="post" action="../proses/aksiLogin.php"> 
        <?php
          if(isset($_GET['pesan']) && ($_GET['pesan']== "gagal")){
            echo "<p><font color='red'>Email atau Password Salah!!!</font></p><hr>";
          }
        ?>
          <h2> LOGIN </h2>
          <hr size="2" color="#000">  
          <table align="center" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF"> 
            <tr align="left"> 
              <td>Email</td> <td width="6">:</td> 
              <td><input name="email" type="text" placeholder="Email..."></td>
              <br> 
            </tr> 
            <tr align="left"> 
              <td>Password</td> <td>:</td> 
              <td><input name="password" type="password" placeholder="Password..."></td> 
            </tr> 
            <tr colspan="3" align="center">
              <td colspan="3">
              <hr size="2" color="#000">
                <input type="submit" name="login" value="Login">
                <input type="reset" name="reset" value="Reset">
              <hr size="2" color="#000">
              </td> 
            </tr>
            <tr colspan="3" align="center">
              <td colspan="3">
                Lupa Password...? <a href="lupaPassword.php">Klik Disini...</a>
              </td> 
            </tr>  
          </table> 
      </form>
  </div> 
</body>
</html>