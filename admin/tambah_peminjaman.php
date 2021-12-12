<?php
// include database connection file
include("../koneksi.php");
?>
<html>
<head>
    <title>Tambah Peminjam</title>
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
  <?php
// include database connection file
include("../koneksi.php");
?>
<html>
<head>
    <title>Tambah Peminjam</title>
</head>
 
<body>
<div class= "tabel">
    <a href="peminjaman.php">kembali</a>
    <br/><br/>
 
    <form action="tambah_peminjaman.php" method="post" name="form1">
        <table width="25%" border="0">
            <tr> 
                <td>Nama Anggota</td>
                <td><select name="anggota" id="anggota">
  <option disabled selected>Nama Anggota</option>
 <?php 
 $data = mysqli_query($mysqli, "SELECT * FROM anggota");
 while($tampil = mysqli_fetch_array($data)) {
 ?>
   <option value="<?=$tampil['id_anggota']?>"><?=$tampil['nama_anggota']?></option> 
 <?php
  }
 ?>
  </select></td>
            </tr>
            <tr> 
                <td>Judul Buku</td>
                <td><select name="buku" id="buku">
  <option disabled selected>Judul Buku</option>
 <?php 
 $data = mysqli_query($mysqli, "SELECT * FROM buku");
 while($tampil = mysqli_fetch_array($data)) {
 ?>
   <option value="<?=$tampil['id_buku']?>"><?=$tampil['judul']?></option> 
 <?php
  }
 ?>
  </select></td>
            </tr>
            <tr> 
                <td>Tanggal Pinjam</td>
                <td><input type="date" name="pinjam"></td>
            </tr>
            <tr> 
                <td>Tanggal Kembali</td>
                <td><input type="date" name="kembali"></td>
            </tr>
            <tr> 
                <td>Petugas</td>
                <td><select name="admin" id="admin" readonly>
                <?php echo $petugas['nama_petugas']; ?>
                <option value="<?=$petugas['id']?>" selected><?=$petugas['nama_petugas']?></option> 
  </select></td>
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
        $anggota = $_POST['anggota'];
        $buku = $_POST['buku'];
        $pinjam = date('Y-m-d', strtotime($_POST['pinjam']));
        $kembali = date('Y-m-d', strtotime($_POST['kembali']));
        $admin  = $_POST['admin'];
        // Insert user data into table
        $pinjaman = mysqli_query($mysqli,"INSERT INTO peminjaman (tanggal_pinjam,tanggal_kembali,anggota_id,petugas_id) VALUES('$pinjam','$kembali','$anggota','$admin')") or die(mysqli_eror($mysqli));
        if ($pinjaman) {
            $last_id = mysqli_insert_id($mysqli);
            $detail = mysqli_query($mysqli,"INSERT INTO peminjaman_detail(peminjaman_id,buku_id) VALUES ('$last_id','$buku')");
            if ($detail) {
                $tangkap = mysqli_query($mysqli, "SELECT * FROM buku WHERE id_buku=$buku");
                $show = mysqli_fetch_array($tangkap);
                $jumlah =  $show['jumlah'] - 1;
                $update = mysqli_query($mysqli,"UPDATE buku SET jumlah='$jumlah' WHERE id_buku=$buku");
            }
        }
        // Show message when user added
        echo "Sukses Menambah peminjam. <a href='peminjaman.php'>Lihat Peminjam</a>";
    }
    ?>
</body>
</html>