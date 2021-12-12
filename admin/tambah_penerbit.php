<?php
// include database connection file
include("../koneksi.php");
?>
<html>
<head>
    <title>Tambah Penerbit</title>
    </head>
 
 <body>
 <?php 
         session_start();
         if($_SESSION['status']!="login"){
             header("location:../index.php?pesan=belum_login");
         }
         $user = $_SESSION['username'];
         $datapetugas = mysqli_query($mysqli, "SELECT * FROM petugas WHERE username = '$user'");
         $petugas = mysqli_fetch_array($datapetugas);
 ?>
 <body>
     <style>
     .menu{
     border:1px solid #ccc;
     border-width:1px 0;
     list-style:none;
     margin:0;
     padding:0;
     text-align:right;
     }
     .menu li{
     display:inline;
     }
     .menu a{
     display:inline-block;
     padding:10px;
     color:black;
     }   
     .sidebar {
     margin:0;
     padding:0;
     height: 100vh;
     width: 15%;
     list-style: none;
     float: left;
     }
     .sidebar li a {
     display: block;
     padding: 25px;
     text-decoration: none;
     color: black;
     font-weight: bold;
     text-transform: uppercase;
     border: 1px solid #ccc;
     }
     .tabel{
         width: 85%;
         float: right;
     }
     </style>
 <ul class="menu">
  <li><?php echo $petugas['nama_petugas']; ?></li>
   <li><a href="../logout.php">Logout</a></li>
 </ul>
 <ul class="sidebar">
     <li><a href="index.php">Beranda</a></li>
     <li><a href="anggota.php">Anggota</a></li>
     <li><a href="buku.php">Buku</a></li>
     <li><a href="pengarang.php">Pengarang</a></li>
     <li><a href="penerbit.php">Penerbit</a></li>
     <li><a href="peminjaman.php">Peminjaman</a></li>
     <li><a href="pengembalian.php">Pengembalian</a></li>
   </ul>
 <div class= "tabel">
    <a href="penerbit.php">kembali</a>
    <br/><br/>
 
    <form action="tambah_penerbit.php" method="post" name="form1">
        <table width="25%" border="0">
            <tr> 
                <td>Nama</td>
                <td><input type="text" name="nama"></td>
            </tr>
            <tr> 
                <td>Alamat</td>
                <td><textarea name="alamat"></textarea></td>
            </tr>
            <tr> 
                <td>Telepon</td>
                <td><input type="text" name="telp"></td>
            </tr>
            <tr> 
                <td></td>
                <td><input type="submit" name="Submit" value="Add"></td>
            </tr>
        </table>
    </form>
    
    <?php
 
    // Check If form submitted, insert form data into users table.
    if(isset($_POST['Submit'])) {
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $telp = $_POST['telp'];
                
        // Insert user data into table
        $result = mysqli_query($mysqli, "INSERT INTO penerbit(nama_penerbit,alamat_penerbit,telp_penerbit) VALUES('$nama','$alamat','$telp')");
        
        // Show message when user added
        echo "Sukses Menambah penerbit. <a href='penerbit.php'>Lihat penerbit</a>";
    }
    ?>
</div>
</body>
</html>