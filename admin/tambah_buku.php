<?php
// include database connection file
include("../koneksi.php");
?>
<html>
<head>
    <title>Tambah Buku</title>
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
    <title>Tambah Buku</title>
</head>
 
<body>
    <a href="buku.php">kembali</a>
    <br/><br/>
 
    <form action="tambah_buku.php" method="post" name="form1">
        <table width="25%" border="0">
            <tr> 
                <td>Judul</td>
                <td><input type="text" name="judul"></td>
            </tr>
            <tr> 
                <td>Tahun Terbit</td>
                <td><input type="text" name="tahun_terbit"></td>
            </tr>
            <tr> 
                <td>Jumlah</td>
                <td><input type="text" name="jumlah"></td>
            </tr>
            <tr> 
                <td>ISBN</td>
                <td><input type="text" name="isbn"></td>
            </tr>
            <tr> 
            <td>Pengarang</td>
            <td><select name="pengarang_id" id="pengarang_id">
  <option disabled selected>Nama Pengarang</option>
 <?php 
 $data = mysqli_query($mysqli, "SELECT * FROM pengarang");
 while($tampil = mysqli_fetch_array($data)) {
 ?>
   <option value="<?=$tampil['id_pengarang']?>"><?=$tampil['nama_pengarang']?></option> 
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
 $data = mysqli_query($mysqli, "SELECT * FROM penerbit");
 while($tampil = mysqli_fetch_array($data)) {
 ?>
   <option value="<?=$tampil['id_penerbit']?>"><?=$tampil['nama_penerbit']?></option> 
 <?php
  }
 ?>
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
        $judul = $_POST['judul'];
        $tahun = $_POST['tahun_terbit'];
        $jumlah = $_POST['jumlah'];
        $isbn = $_POST['isbn'];
        $pengarang = $_POST['pengarang_id'];
        $penerbit = $_POST['penerbit_id'];
                
        // Insert user data into table
        $result = mysqli_query($mysqli, "INSERT INTO buku(judul,tahun_terbit,jumlah,isbn,pengarang_id,penerbit_id) VALUES('$judul','$tahun','$jumlah','$isbn','$pengarang','$penerbit')");
        
        // Show message when user added
        echo "Sukses Menambah Buku. <a href='buku.php'>Lihat Buku</a>";
    }
    ?>
</body>
</html>