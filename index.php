<?php
// Create database connection using config file
include_once("koneksi.php");
 ?>
 
<html>
<head>    
    <title>Perpustakaan</title>
</head>
 
<body>
    <style>.menu{
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
}</style>
<ul class="menu">
  <li><a href="login.php">Login</a></li>
</ul>
<div align = center>
    <br>
<form action="index.php" method="get">
	<label>Cari :</label>
	<input type="text" name="cari">
	<input type="submit" value="Cari">
</form>
 
<?php 
if(isset($_GET['cari'])){
	$cari = $_GET['cari'];
	echo "<b>Hasil pencarian : ".$cari."</b>";
}
?>
 </div>
    <table width='100%' border=1 align = center>
    <tr>
        <th>Judul</th> <th>Tahun Terbit</th> <th>ISBN</th> <th>Pengarang</th> <th>Penerbit</th>
    </tr>
    <?php
    if(isset($_GET['cari'])){
        $cari = $_GET['cari'];
        $data =  mysqli_query($mysqli, "SELECT * FROM((buku b INNER JOIN pengarang p ON b.pengarang_id = p.id_pengarang) INNER JOIN penerbit t ON b.penerbit_id = t.id_penerbit) where b.judul like '%".$cari."%'");
    }else{
        $data = mysqli_query($mysqli, "SELECT * FROM((buku b INNER JOIN pengarang p ON b.pengarang_id = p.id_pengarang) INNER JOIN penerbit t ON b.penerbit_id = t.id_penerbit)");
    }
    while($tampil = mysqli_fetch_array($data)) {         
        echo "<tr>";
        echo "<td>".$tampil['judul']."</td>";
        echo "<td>".$tampil['tahun_terbit']."</td>";
        echo "<td>".$tampil['isbn']."</td>";
        echo "<td>".$tampil['nama_pengarang']."</td>";
        echo "<td>".$tampil['nama_penerbit']."</td>";         
    }
    ?>
    </table>
</body>
</html>