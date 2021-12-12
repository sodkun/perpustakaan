<html>
<head>    
    <title>Peminjaman</title>
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
  <a href="tambah_peminjaman.php">Tambah Peminjaman</a><br/><br/>
    <table width='100%' border=1 align = center>
    <tr>
        <th>Nama Anggota</th> <th>Judul Buku</th> <th>Tanggal Pinjam</th> <th>Tanggal Kembali</th> <th>Petugas</th><th>Aksi</th>
    </tr>
    <?php
    $data = mysqli_query($mysqli,"SELECT b.judul,a.id_anggota,a.nama_anggota,t.id,t.nama_petugas,p.tanggal_pinjam,p.tanggal_kembali,p.id_peminjaman FROM((peminjaman p INNER JOIN anggota a ON p.anggota_id = a.id_anggota) INNER JOIN petugas t ON p.petugas_id = t.id),peminjaman_detail d,buku b WHERE d.buku_id=b.id_buku AND d.peminjaman_id=p.id_peminjaman;");
    while($tampil = mysqli_fetch_array($data)) {         
        echo "<td>".$tampil['nama_anggota']."</td>";
        echo "<td>".$tampil['judul']."</td>";
        echo "<td>".$tampil['tanggal_pinjam']."</td>";
        echo "<td>".$tampil['tanggal_kembali']."</td>";
        echo "<td>".$tampil['nama_petugas']."</td>";         
        echo "<td><a href='edit_peminjaman.php?id=$tampil[id_peminjaman]'>Edit</a> | <a href='delete_peminjaman.php?id=$tampil[id_peminjaman]'>Delete</a></td></tr>";        
    }
    ?>
    </table>
</div>
</body>
</html>