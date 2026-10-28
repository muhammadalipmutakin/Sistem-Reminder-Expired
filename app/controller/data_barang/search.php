<?php
//koneksi ke database
include '../conf/config.php';

$query = $_POST['query'];

//query ke database
$sql = "SELECT * FROM tb_barang WHERE descp LIKE '%$query%' OR plu LIKE '%$query%'";
$result = mysqli_query($koneksi, $sql);

//mengembalikan hasil pencarian dalam format HTML
if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_assoc($result)){
		echo "<tr>";
		echo "<td>".$row['plu']."</td>";
		echo "<td>".$row['barcode']."</td>";
		echo "<td>".$row['descp']."</td>";
        echo "<td>".$row['planogram']."</td>";

		echo "</tr>";
	}
}else{
	echo "<tr><td colspan='3'>No results found</td></tr>";
}
?>
