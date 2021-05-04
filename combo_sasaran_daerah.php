<?php
// koneksi db sudah di panggil di file perencanaan_renstra_entri_murni.php
// connecting to db
// require("dbconn.php");

if(isset($_SESSION["USER_SETTING"]["LOGIN"])){
	$temp_session["SESSION"]	 	= $_SESSION["USER_SETTING"];
}else{
	header("location:index.php");
}

$sql="";
$sql="SELECT * FROM sasaran_daerah";

// $result = mysql_query($sql);
$result = bmysqli_query($conn,$sql);
// num rows
// $numrows = mysql_num_rows($result);
$numrows = bmysqli_num_rows($result);

if ($numrows > 0) {
	// data
	$data 		= array();
	$data_table = array();
	
	for ($i=0; $i<$numrows; $i++) {
		$row = bmysqli_fetch_object($result);	
			
		$data["id"]					    = $row->row_id;
		$data["value"]					= $row->deskripsi;		
		$data_table[] = $data;
	}
	
	// echo "var tujuan_pd=".json_encode($data_table).";";
	// echo "var tujuan_pd=".json_encode($data_table);
	echo json_encode($data_table);

} else {
	// no record found
	$tes = array();
	// $tes["Proses"] = "Ada error";

	echo json_encode($tes);
}

?>