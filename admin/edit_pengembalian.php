<?php
// include database connection file
include_once("../koneksi.php");
 
// Check if form is submitted for user update, then redirect to homepage after update
if(isset($_POST['update']))
{    
    $id = $_POST['id'];
    
    $peminjaman = $_POST['peminjaman'];
    $pengembalian = date('Y-m-d', strtotime($_POST['pengembalian']));
    $admin  = $_POST['admin'];
        
    // update user data
    $result = mysqli_query($mysqli, "UPDATE pengembalian SET tanggal_pengembalian='$pengembalian',petugas_id='$admin' WHERE id_pengembalian=$id");
    // Redirect to homepage to display updated user in list
    header("Location: pengembalian.php");
}
?>
<?php
// Display selected user data based on id
// Getting id from url
$id = $_GET['id'];
 
// Fetech user data based on id
$data = mysqli_query($mysqli, "SELECT b.judul,b.id_buku,a.id_anggota,a.nama_anggota,t.id,t.nama_petugas,p.tanggal_kembali,p.id_peminjaman,k.tanggal_pengembalian, k.denda, k.id_pengembalian FROM(((pengembalian k INNER JOIN anggota a ON k.anggota_id = a.id_anggota) INNER JOIN petugas t ON k.petugas_id = t.id) INNER JOIN peminjaman p ON k.peminjaman_id = p.id_peminjaman),pengembalian_detail d,buku b WHERE d.buku_id=b.id_buku AND d.pengembalian_id=k.id_pengembalian AND id_pengembalian=$id");
 
while($tampil = mysqli_fetch_array($data))
{
    $peminjaman = $tampil['id_peminjaman'];
    $pengembalian = $tampil['tanggal_pengembalian'];
    $petugas = $tampil['nama_petugas'];
}
?>
<html>
<head>    
    <title>Edit Pengembalian</title>
</head>
 <!-- cek apakah sudah login -->
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
    <a href="peminjaman.php">kembali</a>
    <br/><br/>
    
    <form name="update_user" method="post" action="edit_pengembalian.php">
            <table width="50%" border="0">
            <tr> 
                <td>Data Peminjam</td>
                <td><select name="peminjaman" id="peminjaman">
  <option disabled selected>Data Peminjam</option>
 <?php
 $data = mysqli_query($mysqli, "SELECT b.judul,a.nama_anggota,p.tanggal_pinjam,p.tanggal_kembali,p.id_peminjaman FROM((peminjaman p INNER JOIN anggota a ON p.anggota_id = a.id_anggota) INNER JOIN petugas t ON p.petugas_id = t.id),peminjaman_detail d,buku b WHERE d.buku_id=b.id_buku AND d.peminjaman_id=p.id_peminjaman;");
 while($tampil = mysqli_fetch_array($data)) { 
 ?>
  <option <?php if ($tampil['id_peminjaman'] == $peminjaman) { echo 'selected'; }?> value="<?=$tampil['id_peminjaman']?>"><?=$tampil['nama_anggota']?> | <?=$tampil['judul']?> | <?=$tampil['tanggal_pinjam']?> | <?=$tampil['tanggal_kembali']?></option> 
 <?php
  }
 ?>
  </select></td>
            </tr>    
            </tr>
                <td>Tanggal Pengembalian</td>
                <td><input type="date" name="pengembalian" value="<?php echo $pengembalian;?>"></td>
            </tr>
            <tr> 
                <td>Petugas</td>
                <td><select name="admin" id="admin" readonly>
                <?php echo $petugas['nama_petugas']; ?>
                <option value="<?=$petugas['id']?>" selected><?=$petugas['nama_petugas']?></option> 
  </select></td>
            </tr>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
                <td><input type="submit" name="update" value="update"></td>
            </tr>
        </table>
    </form>
</body>
</html>