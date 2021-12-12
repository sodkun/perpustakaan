<?php
// include database connection file
include_once("../koneksi.php");
 
// Check if form is submitted for user update, then redirect to homepage after update
if(isset($_POST['update']))
{    
    $id = $_POST['id'];
    
    $judul = $_POST['judul'];
    $tahun = $_POST['tahun_terbit'];
    $jumlah = $_POST['jumlah'];
    $isbn = $_POST['isbn'];
    $pengarang = $_POST['pengarang_id'];
    $penerbit = $_POST['penerbit_id'];
        
    // update user data
    $result = mysqli_query($mysqli, "UPDATE buku SET judul='$judul',tahun_terbit='$tahun',jumlah='$jumlah',isbn='$isbn',pengarang_id='$pengarang',penerbit_id='$penerbit' WHERE id_buku=$id");
    
    // Redirect to homepage to display updated user in list
    header("Location: buku.php");
}
?>
<?php
// Display selected user data based on id
// Getting id from url
$id = $_GET['id'];
 
// Fetech user data based on id
$data = mysqli_query($mysqli, "SELECT * FROM buku WHERE id_buku=$id");
 
while($tampil = mysqli_fetch_array($data))
{
    $judul = $tampil['judul'];
    $tahun = $tampil['tahun_terbit'];
    $jumlah = $tampil['jumlah'];
    $isbn = $tampil['isbn'];
    $pengarang = $tampil['pengarang_id'];
    $penerbit = $tampil['penerbit_id'];
}
?>
<html>
<head>    
    <title>Edit Data Buku</title>
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
    <a href="buku.php">kembali</a>
    <br/><br/>
    
    <form name="update_user" method="post" action="edit_buku.php">
            <table width="50%" border="0">
            <tr> 
                <td>Judul</td>
                <td><input type="text" name="judul" value='<?php echo $judul;?>'></td>
            </tr>
            <tr> 
                <td>Tahun Terbit</td>
                <td><input type="text" name="tahun_terbit" value='<?php echo $tahun;?>'></td>
            </tr>
            <tr> 
                <td>Jumlah</td>
                <td><input type="text" name="jumlah" value='<?php echo $jumlah;?>'></td>
            </tr>
            <tr> 
                <td>ISBN</td>
                <td><input type="text" name="isbn" value='<?php echo $isbn;?>'></td>
            </tr>
            <tr> 
            <td>Pengarang</td>
            <td><select name="pengarang_id" id="pengarang_id">
  <option disabled selected>Nama Pengarang</option>
 <?php 
 $data_user = mysqli_query($mysqli, "SELECT * FROM pengarang");
 while($tampil_user = mysqli_fetch_array($data_user)) {
 ?>
   <option <?php if ($tampil_user['id_pengarang'] == $pengarang) { echo 'selected'; }?> value="<?=$tampil_user['id_pengarang']?>"><?=$tampil_user['nama_pengarang']?></option> 
 <?php
  }
 ?>
  </select></td>
            </tr>
            <tr> 
                <td>Penerbit</td>
                <td><select name="penerbit_id" id="penerbit_id">
  <option disabled selected>Nama Penerbit</option>
 <?php 
 $data_user = mysqli_query($mysqli, "SELECT * FROM penerbit");
 while($tampil_user = mysqli_fetch_array($data_user)) {
 ?>
   <option <?php if ($tampil_user['id_penerbit'] == $penerbit) { echo 'selected'; }?> value="<?=$tampil_user['id_penerbit']?>"><?=$tampil_user['nama_penerbit']?></option>
 <?php
  }
 ?>
  </select>
            <tr>
                <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
                <td><input type="submit" name="update" value="update"></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>