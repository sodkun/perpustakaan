<html>
<head>    
    <title>Pengembalian</title>
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
  <a href="tambah_pengembalian.php">Tambah Pengembalian</a><br/><br/>
    <table width='100%' border=1 align = center>
    <tr>
        <th>Nama Anggota</th> <th>Judul Buku</th> <th>Tanggal Kembali</th> <th>Tanggal Pengembalian</th> <th>Denda</th> <th>Petugas</th><th>Aksi</th>
    </tr>
    <?php
    $data = mysqli_query($mysqli, "SELECT b.judul,b.id_buku,a.id_anggota,a.nama_anggota,t.id,t.nama_petugas,p.tanggal_kembali,p.id_peminjaman,k.tanggal_pengembalian, k.denda, k.id_pengembalian FROM(((pengembalian k INNER JOIN anggota a ON k.anggota_id = a.id_anggota) INNER JOIN petugas t ON k.petugas_id = t.id) INNER JOIN peminjaman p ON k.peminjaman_id = p.id_peminjaman),pengembalian_detail d,buku b WHERE d.buku_id=b.id_buku AND d.pengembalian_id=k.id_pengembalian;");
    while($tampil = mysqli_fetch_array($data)) {         
        echo "<td>".$tampil['nama_anggota']."</td>";
        echo "<td>".$tampil['judul']."</td>";
        echo "<td>".$tampil['tanggal_kembali']."</td>";
        echo "<td>".$tampil['tanggal_pengembalian']."</td>";
        echo "<td>".$tampil['denda']."</td>";
        echo "<td>".$tampil['nama_petugas']."</td>";         
        echo "<td><a href='edit_pengembalian.php?id=$tampil[id_pengembalian]'>Edit</a> | <a href='delete_pengembalian.php?id=$tampil[id_pengembalian]'>Delete</a></td></tr>";        
    }
    ?>
    </table>
</div>
</body>
</html>