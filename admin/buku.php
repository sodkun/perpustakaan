<html>
<head>    
    <title>Buku</title>
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
  <a href="tambah_buku.php">Tambah Buku</a><br/><br/>
    <table width='100%' border=1 align = center>
    <tr>
        <th>Judul</th> <th>Tahun Terbit</th> <th>ISBN</th> <th>Pengarang</th> <th>Penerbit</th> <th>Jumlah</th><th>Aksi</th>
    </tr>
    <?php
    $data = mysqli_query($mysqli, "SELECT * FROM((buku b INNER JOIN pengarang p ON b.pengarang_id = p.id_pengarang) INNER JOIN penerbit t ON b.penerbit_id = t.id_penerbit)");
    while($tampil = mysqli_fetch_array($data)) {         
        echo "<tr>";
        echo "<td>".$tampil['judul']."</td>";
        echo "<td>".$tampil['tahun_terbit']."</td>";
        echo "<td>".$tampil['isbn']."</td>";
        echo "<td>".$tampil['nama_pengarang']."</td>";
        echo "<td>".$tampil['nama_penerbit']."</td>";
        echo "<td>".$tampil['jumlah']."</td>";           
        echo "<td><a href='edit_buku.php?id=$tampil[id_buku]'>Edit</a> | <a href='delete_buku.php?id=$tampil[id_buku]'>Delete</a></td></tr>";        
    }
    ?>
    </table>
</div>
</body>
</html>