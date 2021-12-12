<?php
// include database connection file
include_once("../koneksi.php");
 
// Get id from URL to delete that user
$id = $_GET['id'];
//update buku
$data = mysqli_query($mysqli, "SELECT buku_id FROM peminjaman_detail WHERE peminjaman_id=$id");
$tampil = mysqli_fetch_array($data);
$buku = $tampil['buku_id'];
$tangkap = mysqli_query($mysqli, "SELECT * FROM buku WHERE id_buku=$buku");
$show = mysqli_fetch_array($tangkap);
$jumlah =  $show['jumlah'] + 1;
$update = mysqli_query($mysqli,"UPDATE buku SET jumlah='$jumlah' WHERE id_buku=$buku");
// Delete user row from table based on given id
$result = mysqli_query($mysqli, "DELETE FROM peminjaman WHERE id_peminjaman=$id");
$detail = mysqli_query($mysqli,"DELETE FROM peminjaman_detail WHERE peminjaman_id=$id");
 
// After delete redirect to Home, so that latest user list will be displayed.
header("Location:peminjaman.php");
?>