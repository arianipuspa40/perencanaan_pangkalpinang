<?php
// connecting to db
require("dbconn.php");

//user admin super, admin opd, user bidang (disini tidak diperlukan karena get data berdasarkan id parent)
//  parameter opd/sub opd
// $param_opd ="";
$param_opd = "10122200002";

$sql1="";


if (strlen($param_opd) == 11){	
	$sql1="SELECT * FROM master_program WHERE (CONCAT(urs_id, bid_urs_id) = 000 OR CONCAT(urs_id, bid_urs_id) = ".substr($param_opd,0,3)." OR CONCAT(urs_id, bid_urs_id) = ".substr($param_opd,3,3)." OR CONCAT(urs_id, bid_urs_id) = ".substr($param_opd,6,3).") AND lvl = 5";
}else{
	$sql1="SELECT * FROM master_program WHERE lvl = 5";
}

$result = mysql_query($sql1);
// num rows
$numrows = mysql_num_rows($result);
// echo($numrows);
// echo "ini combo";
// echo $sql1;
if ($numrows > 0) {
	// data
	$data 		= array();
	$data_table = array();
	
	for ($i=0; $i<$numrows; $i++) {
		$row = mysql_fetch_object($result);		
			
		$data["id"]					    = $row->urs_id.$row->bid_urs_id.$row->prog_id.$row->keg_kode.$row->keg_id;
		$data["value"]					= $row->deskripsi;		
		$data_table[] = $data;
	}
	
	echo json_encode($data_table);
	
} else {
	// no record found
	// $tes["Proses"] = "Ada error";
	// echo json_encode($tes);
}

?>