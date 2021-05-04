<?php
// connecting to db
require("dbconn.php");

//user admin super, admin opd, user bidang (disini tidak diperlukan karena get data berdasarkan id parent)
//  parameter opd/sub opd
// $param_opd ="";
$param_opd 	= "10122200002";
$prgfull	= "02120";
// $param1 	= json_decode($_POST['param1']);

$sql1="";
if (substr($prgfull,4,2)=="01"){
	// $sql1="SELECT * FROM master_program WHERE CONCAT(urs_id, bid_urs_id,prog_id) = 000001  AND lvl = 4 ";
	// $sql1="SELECT * FROM master_program WHERE CONCAT(urs_id, bid_urs_id,prog_id) = 000001  AND lvl = 4 order by CONCAT(urs_id, bid_urs_id,prog_id,keg_kode,keg_id)";
}else{
	$sql1="SELECT * FROM master_indikator WHERE urs_id = ".substr($prgfull,0,2)."  AND bid_urs_id = ".substr($prgfull,2,2);
	// $sql1="SELECT * FROM master_program WHERE CONCAT(urs_id, bid_urs_id,prog_id) = ".$prgfull."  AND lvl = 4";
	// $sql1="SELECT * FROM master_program WHERE CONCAT(urs_id, bid_urs_id,prog_id) = ".$prgfull."  AND lvl = 4 order by CONCAT(urs_id, bid_urs_id,prog_id,keg_kode,keg_id)";
}

// $conn = mysqli_connect("localhost", "root","","monevpkp_online");
// $result = mysqli_query($conn, $sql1);
$result = bmysqli_query($conn,$sql1);

// num rows
$numrows = bmysqli_num_rows($result);
// echo($numrows);
// echo "ini combo";
// echo $sql1;
if ($numrows > 0) {
	// data
	$data 		= array();
	$data_table = array();
	
	for ($i=0; $i<$numrows; $i++) {
		$row = bmysqli_fetch_object($result);		
			
		$data["id"]					    = $row->row_id;
		$data["value"]					= $row->indi_desc;		
		$data_table[] = $data;
	}
	
	// echo "var combo_kegiatan=".json_encode($data_table).";";
	echo json_encode($data_table);
	
} else {
	// no record found
	// $tes["Proses"] = "Ada error";
	// echo json_encode($tes);
	// echo "kosong";
}





?>