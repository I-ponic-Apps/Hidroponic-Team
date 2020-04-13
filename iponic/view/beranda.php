<?php 
  session_start();

  if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];

    require_once '../config/koneksi.php';
    $db   = new DbConnection();
    $conn   = $db->connect();

    $sql    = "SELECT * FROM user WHERE iponic_email='".$email."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html>
<head>
  <title>Beranda | Iponic</title>
  <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<div class="header">
  <center>
    <h1>Selamat Datang di Website!!!</h1>
  </center>
</div>

<div class="nav">
  <a href="beranda.php">Home</a>
  <a href="profil.php">Profil</a>    
  <a href="logout.php">Logot</a>  
</div>

 <div class="row">
    <div class="card">
      <div class="tengah">
      <?php
    if(($row['iponic_aktivasi']=="T") && (isset($_GET['pesan']) && $_GET['pesan']=="terkirim")){
      echo "<h4>Cek email anda...</h4><hr>";
    }elseif($row['iponic_aktivasi']=="T"){
      echo "<h4><font color='red'>EMAIL ANDA BELUM TERVERTIFIKASI </font><br><a href='../proses/aktivasi.php'>Lakukan Aktivasi</a></h4> <hr>";
    }else{
  ?>
      <?php 
        if (isset($_GET['pesan'])) {
          switch ($_GET['pesan']) {
            case 'sukses':
              echo "<h4><font color='green'>Email Anda TERVERTIFIKASI</font></h4><hr>
                <h2>Data user</h2>";
              break;

            case 'terhapus':
              echo "<h2>Data user</h2>
              <h4><font color='green'>Berhasil Dihapus</font></h4>";
              break;

            case 'hapusgagal':
              echo "<h2>Data user</h2>
              <h4><font color='red'>Gagal Menghapus</font></h4>";
              break;
            default:
              break;
          }
        }else{
         echo "<h2>Data user</h2>";
        }
      ?>

      <?php if ($row['iponic_level']!="user")?>
      <br>
     <table align="center" border="1" width="100%" cellpadding="3" cellspacing="1" bgcolor="#FFF"> 
            <tr>
              <form method="GET" action="">
                <?php if ($row['iponic_level']!="user"){
                	echo '<td colspan="10" align="right">';
                }else{
                  echo '<td colspan="9" align="right">';
                } ?>
              		<input type="text" name="cari" placeholder="cari berdasarkan nama..."></input>
              	</td>
              	<td>
              		<input type="submit" value="Cari"></input>
              	</td>
              </form>
            </tr>
            <tr align="center"> 
              <th>No</th> 
              <th>Nama</th>
              <th>Kontak</th>
              <th>Email</th>
              <th>Level</th>
              <th>Aktivasi</th>
              <?php if ($row['iponic_level']!="user") {
                echo '<th>Aksi</th>';
              } ?>
              <br> 
            </tr>
            <?php
              if (isset($_GET['cari'])) {
                $query    = "SELECT * FROM user WHERE iponic_email!='".$email."'  AND iponic_nama LIKE '%".$_GET['cari']."%'";
              }else{
                $query    = "SELECT * FROM iponic WHERE iponic_email!='".$email."'";
              }
			        $sql = $conn->query($query);
			    
			    if ($sql->num_rows>0) {
			      $no = 1;
			      while($data = $sql->fetch_assoc()){
			     ?>   
            
            <tr align="left">
              <td><?php echo $no ?></td> 
              <td><?php echo $data['iponic_nama'] ?></td> 
              <td><?php echo $data['iponic_kontak'] ?></td> 
              <td><?php echo $data['iponic_email'] ?></td> 
              <td><?php echo $data['iponic_level'] ?></td> 
              <td><?php echo $data['iponic_aktivasi'] ?></td>
              <?php if ($row['iponic_level']!="user"):?>
              <?php endif ?>
            </tr> 
             <?php
             		$no++;  
             	}
             }else{
             	echo "<tr><td colspan='11'>Data user Tidak Ditemukan</td></tr>";
             }
              }
             ?> 
          </table>
          </div> 
    </div>    
</div>
 
<div class="row">
	<div class="footer">
  		<p>&copy; Copyright <?php echo date("Y") ?></p>  		
	</div>
</div>
 <?php 
    }else{
      header("location:../index.php");;
    }
 ?>
</body>
</html>