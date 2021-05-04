<?php
// connecting to db
require("dbconn.php");

// post data
$ROW_ID 		 											= $_GET['ROW_ID'];
$OPD_EDIT_URUSAN_1 								= $_GET['OPD_EDIT_URUSAN_1'];
$OPD_EDIT_BIDANG_URUSAN_1 				= $_GET['OPD_EDIT_BIDANG_URUSAN_1'];
$OPD_EDIT_URUSAN_2 								= $_GET['OPD_EDIT_URUSAN_2'];
$OPD_EDIT_BIDANG_URUSAN_2 				= $_GET['OPD_EDIT_BIDANG_URUSAN_2'];
$OPD_EDIT_URUSAN_3 								= $_GET['OPD_EDIT_URUSAN_3'];
$OPD_EDIT_BIDANG_URUSAN_3 				= $_GET['OPD_EDIT_BIDANG_URUSAN_3'];
$OPD_EDIT_URUTAN_OPD 							= $_GET['OPD_EDIT_URUTAN_OPD'];
$OPD_EDIT_KODE_OPD_LENGKAP 				= $_GET['OPD_EDIT_KODE_OPD_LENGKAP'];
$OPD_EDIT_DESKRIPSI_OPD 					= $_GET['OPD_EDIT_DESKRIPSI_OPD'];
$OPD_EDIT_KODE_OPD_LAMA 					= $_GET['OPD_EDIT_KODE_OPD_LAMA'];
$OPD_EDIT_DESKRIPSI_OPD_LAMA 			= $_GET['OPD_EDIT_DESKRIPSI_OPD_LAMA'];
$OPD_EDIT_PIMPINAN 								= $_GET['OPD_EDIT_PIMPINAN'];
$OPD_EDIT_SEKRETARIS 							= $_GET['OPD_EDIT_SEKRETARIS'];
$OPD_EDIT_BIDANG_TEKNIS_BAPPEDA 	= $_GET['OPD_EDIT_BIDANG_TEKNIS_BAPPEDA'];

// update data
$sql  = "UPDATE opd SET";
$sql .= " ";
$sql .= "urs1='".$OPD_EDIT_URUSAN_1."',";
$sql .= "bid_urs1='".$OPD_EDIT_BIDANG_URUSAN_1."',";
$sql .= "urs2='".$OPD_EDIT_URUSAN_2."',";
$sql .= "bid_urs2='".$OPD_EDIT_BIDANG_URUSAN_2."',";
$sql .= "urs3='".$OPD_EDIT_URUSAN_3."',";
$sql .= "bid_urs3='".$OPD_EDIT_BIDANG_URUSAN_3."',";
$sql .= "urutan_opd='".$OPD_EDIT_URUTAN_OPD."',";
$sql .= "opd_id='".$OPD_EDIT_KODE_OPD_LENGKAP."',";
$sql .= "deskripsi_opd='".$OPD_EDIT_DESKRIPSI_OPD."',";
$sql .= "opd_id_old='".$OPD_EDIT_KODE_OPD_LAMA."',";
$sql .= "deskripsi_old_opd='".$OPD_EDIT_DESKRIPSI_OPD_LAMA."',";
$sql .= "pimpinan_id='".$OPD_EDIT_PIMPINAN."',";
$sql .= "sekretaris_id='".$OPD_EDIT_SEKRETARIS."',";
$sql .= "bidang_teknis_bappeda='".$OPD_EDIT_BIDANG_TEKNIS_BAPPEDA."'";
$sql .= " ";
$sql .= "WHERE row_id='".$ROW_ID."'";

$result			= mysql_query($sql);			// True/Resource on success, False on error
$num_result = mysql_affected_rows();	// Returns the number of affected rows on success, and -1 if the last query failed

if ($num_result >= 0) {
	$data = array();
	$data["status"] = "success";
	
	// echoing JSON response output
	header('Content-type: application/json');
	echo json_encode($data);
} else {
	$data = array();
	$data["status"] = "error";
	
	// echoing JSON response output
	header('Content-type: application/json');
	echo json_encode($data);
}

?>