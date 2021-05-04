<?php
// koneksi db sudah di panggil di file perencanaan_renstra_entri_murni.php
// connecting to db
// require("dbconn.php");

// session_start();
// $temp_session 						= array();

if(isset($_SESSION["USER_SETTING"]["LOGIN"])){
	$temp_session["SESSION"]	 	= $_SESSION["USER_SETTING"];
}else{
	header("location:index.php");
}

//  parameter opd/sub opd
$param_opd = $temp_session["SESSION"]["OPD_ID"];
// $param_opd = "10122200002";


$sql="";

if (strlen($param_opd) == 11){	
	$sql="SELECT * FROM sasaran_perangkat_daerah where opd_id="." ".$param_opd;

}else{
	$sql="SELECT * FROM sasaran_perangkat_daerah";
}

// $result = mysql_query($sql);
$result = bmysqli_query($conn,$sql);
// num rows
// $numrows = mysql_num_rows($result);
$numrows = bmysqli_num_rows($result);
// echo($numrows);
// echo "ini combo";
if ($numrows > 0) {
	// data
	$data 		= array();
	$data_table = array();
	
	for ($i=0; $i<$numrows; $i++) {
		$row = bmysqli_fetch_object($result);		
			
		$data["id"]					    = $row->row_id;
		$data["value"]					= $row->sasaran_pd;		
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