<?php
// include database connection file
include_once("../koneksi.php");
 
// Check if form is submitted for user update, then redirect to homepage after update
if(isset($_POST['update']))
{    
    $id = $_POST['id'];
    
    $anggota = $_POST['anggota'];
    $buku = $_POST['buku'];
    $pinjam = date('Y-m-d', strtotime($_POST['pinjam']));
    $kembali = date('Y-m-d', strtotime($_POST['kembali']));
    $admin  = $_POST['admin'];
        
    // update user data
    $result = mysqli_query($mysqli, "UPDATE peminjaman SET tanggal_pinjam='$pinjam',tanggal_kembali='$kembali',anggota_id='$anggota',petugas_id='$admin' WHERE id_peminjaman=$id");
    if ($result) {
        $detail = mysqli_query($mysqli,"UPDATE peminjaman_detail SET buku_id='$buku' WHERE peminjaman_id ='$id'");
    }
    // Redirect to homepage to display updated user in list
    header("Location: peminjaman.php");
}
?>
<?php
// Display selected user data based on id
// Getting id from url
$id = $_GET['id'];
 
// Fetech user data based on id
$data = mysqli_query($mysqli, "SELECT b.judul,b.id_buku,a.id_anggota,a.nama_anggota,t.id,t.nama_petugas,p.tanggal_pinjam,p.tanggal_kembali,p.id_peminjaman FROM((peminjaman p INNER JOIN anggota a ON p.anggota_id = a.id_anggota) INNER JOIN petugas t ON p.petugas_id = t.id),peminjaman_detail d,buku b WHERE d.buku_id=b.id_buku AND d.peminjaman_id=p.id_peminjaman AND id_peminjaman=$id");
 
while($tampil = mysqli_fetch_array($data))
{
    $anggota = $tampil['id_anggota'];
    $pinjam = $tampil['tanggal_pinjam'];
    $kembali = $tampil['tanggal_kembali'];
    $petugas = $tampil['nama_petugas'];
    $buku = $tampil['id_buku'];
}
?>
<html>
<head>    
    <title>Edit Peminjaman</title>
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
    
    <form name="update_user" method="post" action="edit_peminjaman.php">
            <table width="25%" border="0">
            <tr> 
                <td>Nama Anggota</td>
                <td>
                    <select name="anggota" id="anggota">
                    <option disabled selected>Nama Anggota</option>
                    <?php 
                    $datauser = mysqli_query($mysqli, "SELECT * FROM anggota");
                    while($tampiluser = mysqli_fetch_array($datauser)) {
                    ?>
                    <option <?php if ($tampiluser['id_anggota'] == $anggota) { echo 'selected'; }?> value="<?=$tampiluser['id_anggota']?>"><?=$tampiluser['nama_anggota']?></option> 
                    <?php
                    }
                    ?>
                    </select>
                </td>
            </tr>
            <tr> 
                <td>Judul Buku</td>
                <td><select name="buku" id="buku">
  <option disabled selected>Judul Buku</option>
 <?php 
 $data_user = mysqli_query($mysqli, "SELECT * FROM buku");
 while($tampil_user = mysqli_fetch_array($data_user)) {
 ?>
   <option <?php if ($tampil_user['id_buku'] == $buku) { echo 'selected'; }?> value="<?=$tampil_user['id_buku']?>"><?=$tampil_user['judul']?></option> 
 <?php
  }
 ?>
  </select></td>
            </tr>
            <tr> 
                <td>Tanggal Pinjam</td>
                <td><input type="date" name="pinjam" value="<?php echo $pinjam;?>"></td>
            </tr>
            <tr> 
                <td>Tanggal Kembali</td>
                <td><input type="date" name="kembali" value="<?php echo $kembali;?>"></td>
            </tr>
            <tr> 
                <td>Petugas</td>
                <td><select name="admin" id="admin" readonly>
                <?php echo $petugas['nama_petugas']; ?>
                <option value="<?=$petugas['id']?>" selected><?=$petugas['nama_petugas']?></option> 
  </select></td>
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