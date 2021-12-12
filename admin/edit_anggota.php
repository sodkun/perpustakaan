<?php
// include database connection file
include_once("../koneksi.php");
 
// Check if form is submitted for user update, then redirect to homepage after update
if(isset($_POST['update']))
{    
    $id = $_POST['id'];
    
    $nama = $_POST['nama'];
    $jekel = $_POST['jenis_kelamin'];
    $status = $_POST['status'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    // update user data
    $result = mysqli_query($mysqli, "UPDATE anggota SET nama_anggota='$nama',jenis_kelamin='$jekel',status='$status',alamat_anggota='$alamat',telp_anggota='$telp' WHERE id_anggota=$id");
    
    // Redirect to homepage to display updated user in list
    header("Location: anggota.php");
}
?>
<?php
// Display selected user data based on id
// Getting id from url
$id = $_GET['id'];
 
// Fetech user data based on id
$data = mysqli_query($mysqli, "SELECT * FROM anggota WHERE id_anggota=$id");
 
while($tampil = mysqli_fetch_array($data))
{
    $nama = $tampil['nama_anggota'];
    $jekel = $tampil['jenis_kelamin'];
    $status = $tampil['status'];
    $alamat = $tampil['alamat_anggota'];
    $telp = $tampil['telp_anggota'];
}
?>
<html>
<head>    
    <title>Edit Data Anggota</title>
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
    <a href="anggota.php">kembali</a>
    <br/><br/>
    
    <form name="update_user" method="post" action="edit_anggota.php">
            <table width="50%" border="0">
            <tr> 
                <td>Nama</td>
                <td><input type="text" name="nama" value='<?php echo $nama;?>'></td>
            </tr>
            <tr> 
                <td>Jenis Kelamin</td>
                <td><input type="radio" name="jenis_kelamin" <?php if ($jekel=="P") { echo 'checked'; }?> value="P">Perempuan</td>
                <td><input type="radio" name="jenis_kelamin" <?php if ($jekel=="L") { echo 'checked'; }?> value="L">Laki-Laki</td>
            </tr>
            <tr> 
                <td>Status</td>
                <td>
                    <select name="status" id="status">
                        <option disabled selected>Status</option>
                        <option <?php if ($status=="Mahasiswa") { echo 'selected'; }?> value="Mahasiswa">Mahasiswa</option>
                        <option <?php if ($status=="Masyarakat Umum") { echo 'selected'; }?> value="Masyarakat Umum">Masyarakat Umum</option>
                    </select>
                </td>
            </tr>
            <tr> 
                <td>Alamat</td>
                <td><textarea name="alamat"><?php echo $alamat;?></textarea></td>
            </tr>
            <tr> 
                <td>Telepon</td>
                <td><input type="text" name="telp" value='<?php echo $telp;?>'></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
                <td><input type="submit" name="update" value="update"></td>
            </tr>
        </table>
    </form>
    </div>
</body>
</html>