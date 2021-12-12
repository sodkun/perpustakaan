<?php
// include database connection file
include_once("../koneksi.php");
 
// Check if form is submitted for user update, then redirect to homepage after update
if(isset($_POST['update']))
{    
    $id = $_POST['id'];
    
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    // update user data
    $result = mysqli_query($mysqli, "UPDATE pengarang SET nama_pengarang='$nama',alamat_pengarang='$alamat',telp_pengarang='$telp' WHERE id_pengarang=$id");
    
    // Redirect to homepage to display updated user in list
    header("Location: pengarang.php");
}
?>
<?php
// Display selected user data based on id
// Getting id from url
$id = $_GET['id'];
 
// Fetech user data based on id
$data = mysqli_query($mysqli, "SELECT * FROM pengarang WHERE id_pengarang=$id");
 
while($tampil = mysqli_fetch_array($data))
{
    $nama = $tampil['nama_pengarang'];
    $alamat = $tampil['alamat_pengarang'];
    $telp = $tampil['telp_pengarang'];
}
?>
<html>
<head>    
    <title>Edit Data Pengarang</title>
    </head>
 <!-- cek apakah sudah login -->
 <?php 
        include("../koneksi.php");
        session_start();
        if($_SESSION['status']!="login"){
            header("location:../index.php?pesan=belum_login");
        }
        $user = $_SESSION['username'];
        $data = mysqli_query($mysqli, "SELECT * FROM petugas WHERE username = '$user'");
        $tampil = mysqli_fetch_array($data);
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
 <li><?php echo $tampil['nama_petugas']; ?></li>
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
    <a href="pengarang.php">kembali</a>
    <br/><br/>
    
    <form name="update_user" method="post" action="edit_pengarang.php">
            <table width="25%" border="0">
            <tr> 
                <td>Nama</td>
                <td><input type="text" name="nama" value='<?php echo $nama;?>'></td>
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