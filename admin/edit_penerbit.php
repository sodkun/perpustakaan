<?php
// include database connection file
include_once("../koneksi.php");
 
// Check if form is submitted for user update, then redirect to homepage after update
if(isset($_POST['update']))
{    
    $id = $_POST['id'];
    
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    // update user data
    $result = mysqli_query($mysqli, "UPDATE penerbit SET nama_penerbit='$nama',alamat_penerbit='$alamat',telp_penerbit='$telp' WHERE id_penerbit=$id");
    
    // Redirect to homepage to display updated user in list
    header("Location: penerbit.php");
}
?>
<?php
// Display selected user data based on id
// Getting id from url
$id = $_GET['id'];
 
// Fetech user data based on id
$data = mysqli_query($mysqli, "SELECT * FROM penerbit WHERE id_penerbit=$id");
 
while($tampil = mysqli_fetch_array($data))
{
    $nama = $tampil['nama_penerbit'];
    $alamat = $tampil['alamat_penerbit'];
    $telp = $tampil['telp_penerbit'];
}
?>
<html>
<head>    
    <title>Edit Data Penerbit</title>
</head>
 
<body>
    <a href="penerbit.php">kembali</a>
    <br/><br/>
    
    <form name="update_user" method="post" action="edit_penerbit.php">
            <table width="25%" border="0">
            <tr> 
                <td>Nama</td>
                <td><input type="text" name="nama" value='<?php echo $nama;?>'></td>
            </tr>
            <tr> 
                <td>Alamat</td>
                <td><textarea name="alamat"><?php echo $alamat;?></textarea></td>
            </tr>
            <tr> 
                <td>Telepon</td>
                <td><input type="text" name="telp" value='<?php echo $telp;?>'></td>
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