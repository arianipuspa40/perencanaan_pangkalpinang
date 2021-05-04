<?php
// koneksi db sudah di panggil di file perencanaan_renstra_entri_murni.php
// connecting to db
// require("dbconn.php");
// session_start();
// $temp_session 						= array();

if (isset($_SESSION["USER_SETTING"]["LOGIN"])) {
	$temp_session["SESSION"]	 	= $_SESSION["USER_SETTING"];
} else {
	header("location:index.php");
}
// var_dump($temp_session["SESSION"]["OPD_ID"]);

// connecting to db
// require("dbconn.php");

//user admin super, admin opd, user bidang (disini tidak diperlukan karena get data berdasarkan id parent)
//  parameter opd/sub opd
// $param_opd = "10122200002";
$param_opd = $temp_session["SESSION"]["OPD_ID"];
$sql1 = "";


if (strlen($param_opd) == 11) {
	$sql1 = "SELECT * FROM master_program WHERE (CONCAT(urs_id, bid_urs_id) = 000 OR CONCAT(urs_id, bid_urs_id) = " . substr($param_opd, 0, 3) . " OR CONCAT(urs_id, bid_urs_id) = " . substr($param_opd, 3, 3) . " OR CONCAT(urs_id, bid_urs_id) = " . substr($param_opd, 6, 3) . ") AND lvl = 3";
} else {
	$sql1 = "SELECT * FROM master_program WHERE lvl = 3";
}

// $result = mysql_query($sql1);
$result = bmysqli_query($conn, $sql1);
// $numrows = mysql_num_rows($result);
$numrows = bmysqli_num_rows($result);
// echo($numrows);
// echo "ini combo";
// echo $sql1;
if ($numrows > 0) {
	// data
	$data 		= array();
	$data_table = array();

	for ($i = 0; $i < $numrows; $i++) {
		$row = bmysqli_fetch_object($result);

		if ($row->prog_id <> "01") {
			$data["id"] = $row->urs_id . $row->bid_urs_id . $row->prog_id;
		} else {
			$data["id"] = "0" . substr($param_opd, 0, 3) . $row->prog_id;
		}

		$data["value"]					= $row->deskripsi;
		$data_table[] = $data;


		// if ($row->urs_id.$row->bid_urs_id == "0000"){			
		// 	$data["id"]					    = "0".substr($param_opd,0,3).$row->prog_id;
		// 	$data["value"]					= $row->deskripsi;		
		// 	$data_table[] = $data;
		// }

		// var_dump($data_table);
	}

	// echo "var combo_program=".json_encode($data_table).";";
	echo json_encode($data_table);
} else {
	// no record found
	$tes = array();
	// $tes["Proses"] = "Ada error";

	echo json_encode($tes);
}
