<?php
// include database connection file
include("../koneksi.php");
?>
<html>
<head>
    <title>Tambah Pengembalian</title>
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
    <a href="pengembalian.php">kembali</a>
    <br/><br/>
 
    <form action="tambah_pengembalian.php" method="post" name="form1">
        <table width="50%" border="0">
        <tr> 
                <td>Data Peminjam</td>
                <td><select name="peminjaman" id="peminjaman">
  <option disabled selected>Data Peminjam</option>
 <?php
 $data = mysqli_query($mysqli, "SELECT b.judul,a.nama_anggota,p.tanggal_pinjam,p.tanggal_kembali,p.id_peminjaman FROM((peminjaman p INNER JOIN anggota a ON p.anggota_id = a.id_anggota) INNER JOIN petugas t ON p.petugas_id = t.id),peminjaman_detail d,buku b WHERE d.buku_id=b.id_buku AND d.peminjaman_id=p.id_peminjaman;");
 while($tampil = mysqli_fetch_array($data)) { 
 ?>
  <option value="<?=$tampil['id_peminjaman']?>"><?=$tampil['nama_anggota']?> | <?=$tampil['judul']?> | <?=$tampil['tanggal_pinjam']?> | <?=$tampil['tanggal_kembali']?></option> 
 <?php
  }
 ?>
  </select></td>
            </tr>    
            </tr>
                <td>Tanggal Pengembalian</td>
                <td><input type="date" name="pengembalian"></td>
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
        $peminjaman = $_POST['peminjaman'];
        $ambil = mysqli_query($mysqli, "SELECT b.id_buku,a.id_anggota,p.tanggal_kembali FROM((peminjaman p INNER JOIN anggota a ON p.anggota_id = a.id_anggota) INNER JOIN petugas t ON p.petugas_id = t.id),peminjaman_detail d,buku b WHERE d.buku_id=b.id_buku AND d.peminjaman_id=p.id_peminjaman AND id_peminjaman=$peminjaman");
        while($pinjam = mysqli_fetch_array($ambil))
        {
        $anggota = $pinjam['id_anggota'];
        $kembali = $pinjam['tanggal_kembali'];
        $buku = $pinjam['id_buku'];
        }
        $pengembalian = date('Y-m-d', strtotime($_POST['pengembalian']));
        $admin  = $_POST['admin'];
        $datetime1 = new DateTime($pengembalian);
        $datetime2 = new DateTime($kembali);
        if ($datetime1>$datetime2) {
            $difference = $datetime1->diff($datetime2);
            $telat = $difference->d;
            $denda = $telat * 500;
        } else {
            $denda=0;
        }
        

        // Insert user data into table
        $pinjaman = mysqli_query($mysqli,"INSERT INTO pengembalian (tanggal_pengembalian,denda,peminjaman_id,anggota_id,petugas_id) VALUES('$pengembalian','$denda','$peminjaman','$anggota','$admin')") or die(mysqli_eror($mysqli));
        if ($pinjaman) {
            $last_id = mysqli_insert_id($mysqli);
            $detail = mysqli_query($mysqli,"INSERT INTO pengembalian_detail(pengembalian_id,buku_id) VALUES ('$last_id','$buku')");
            if ($detail) {
                $tangkap = mysqli_query($mysqli, "SELECT * FROM buku WHERE id_buku=$buku");
                $show = mysqli_fetch_array($tangkap);
                $jumlah =  $show['jumlah'] + 1;
                $update = mysqli_query($mysqli,"UPDATE buku SET jumlah='$jumlah' WHERE id_buku=$buku");
            }
        }
        // Show message when user added
        echo "Sukses Menambah Pengembalian. <a href='pengembalian.php'>Lihat Pengembalian</a>";
    }
    ?>
</body>
</html>