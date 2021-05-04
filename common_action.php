<?
// connecting to db
require("dbconn.php");

// post data
$what = $_GET['what'];

if ($what == "GET_OPD1"){
	
	// get data
	$sql 		= "SELECT row_id, deskripsi_opd FROM opd WHERE status_aktif='1'";
	$result = mysql_query($sql);

	// num rows
	$numrows = mysql_num_rows($result);

	if ($numrows > 0) {
		// data
		$data 			= array();
		$data_table = array();
		
		for ($i=0; $i<$numrows; $i++) {
			$row = mysql_fetch_object($result);
			
			$row_id 				= $row->row_id;
			$deskripsi_opd 	= $row->deskripsi_opd;
			
			$data["id"] 		= $row_id;
			$data["value"] 	= $deskripsi_opd;
			
			$data_table[] 	= $data;
		}
		
		// echoing JSON response output
		header('Content-type: application/json');
		echo json_encode($data_table);
		
	} else {
		// no record found
	}
	
} elseif ($what == "GET_SUB_OPD1"){
	$opd 			= $_GET['opd'];
	
	// get data
	$sql 				= "SELECT urs1, bid_urs1, urutan_opd FROM opd WHERE row_id='$opd'";
	$result 		= mysql_query($sql);
	$row 				= mysql_fetch_object($result);
	$bid_urs1 	= $row->bid_urs1;
	$urs1 			= $row->urs1;
	$urutan_opd = $row->urutan_opd;
	
	$sql 		= "SELECT row_id, deskripsi_opd FROM opd WHERE bid_urs1='$bid_urs1' AND urs1='$urs1' AND urutan_opd>'$urutan_opd'";
	$result = mysql_query($sql);

	// num rows
	$numrows = mysql_num_rows($result);

	if ($numrows > 0) {
		// data
		$data 			= array();
		$data_table = array();
		
		for ($i=0; $i<$numrows; $i++) {
			$row = mysql_fetch_object($result);
			
			$row_id 				= $row->row_id;
			$deskripsi_opd 	= $row->deskripsi_opd;
			
			$data["id"] 		= $row_id;
			$data["value"] 	= $deskripsi_opd;
			
			$data_table[] 	= $data;
		}
		
		// echoing JSON response output
		header('Content-type: application/json');
		echo json_encode($data_table);
		
	} else {
		// no record found
	}
	
} elseif ($what == "GET_OPD2"){
	
	// get data
	$sql 		= "SELECT row_id, deskripsi_opd FROM opd WHERE status_aktif='1'";
	$result = mysql_query($sql);

	// num rows
	$numrows = mysql_num_rows($result);

	if ($numrows > 0) {
		// data
		$data 			= array();
		$data_table = array();
		
		for ($i=0; $i<$numrows; $i++) {
			$row = mysql_fetch_object($result);
			
			$row_id 				= $row->row_id;
			$deskripsi_opd 	= $row->deskripsi_opd;
			
			$data["id"] 		= $row_id;
			$data["value"] 	= $deskripsi_opd;
			
			$data_table[] 	= $data;
		}
		
		// echoing JSON response output
		header('Content-type: application/json');
		echo json_encode($data_table);
		
	} else {
		// no record found
	}
	
} elseif ($what == "GET_SUB_OPD2"){
	$opd = $_GET['opd'];
	
	// get data
	$sql 				= "SELECT urs1, bid_urs1, urutan_opd FROM opd WHERE row_id='$opd'";
	$result 		= mysql_query($sql);
	$row 				= mysql_fetch_object($result);
	$bid_urs1 	= $row->bid_urs1;
	$urs1 			= $row->urs1;
	$urutan_opd = $row->urutan_opd;
	
	$sql 		= "SELECT row_id, deskripsi_opd FROM opd WHERE bid_urs1='$bid_urs1' AND urs1='$urs1' AND urutan_opd>'$urutan_opd'";
	$result = mysql_query($sql);

	// num rows
	$numrows = mysql_num_rows($result);

	if ($numrows > 0) {
		// data
		$data 			= array();
		$data_table = array();
		
		for ($i=0; $i<$numrows; $i++) {
			$row = mysql_fetch_object($result);
			
			$row_id 				= $row->row_id;
			$deskripsi_opd 	= $row->deskripsi_opd;
			
			$data["id"] 		= $row_id;
			$data["value"] 	= $deskripsi_opd;
			
			$data_table[] 	= $data;
		}
		
		// echoing JSON response output
		header('Content-type: application/json');
		echo json_encode($data_table);
		
	} else {
		// no record found
	}
}
?>