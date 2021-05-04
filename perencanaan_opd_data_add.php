<?php
// connecting to db
require("dbconn.php");

// post data
$OPD_ADD_URUSAN_1 							= $_GET['OPD_ADD_URUSAN_1'];
$OPD_ADD_BIDANG_URUSAN_1 				= $_GET['OPD_ADD_BIDANG_URUSAN_1'];
$OPD_ADD_URUSAN_2 							= $_GET['OPD_ADD_URUSAN_2'];
$OPD_ADD_BIDANG_URUSAN_2 				= $_GET['OPD_ADD_BIDANG_URUSAN_2'];
$OPD_ADD_URUSAN_3 							= $_GET['OPD_ADD_URUSAN_3'];
$OPD_ADD_BIDANG_URUSAN_3 				= $_GET['OPD_ADD_BIDANG_URUSAN_3'];
$OPD_ADD_URUTAN_OPD 						= $_GET['OPD_ADD_URUTAN_OPD'];
$OPD_ADD_KODE_OPD_LENGKAP 			= $_GET['OPD_ADD_KODE_OPD_LENGKAP'];
$OPD_ADD_DESKRIPSI_OPD 					= $_GET['OPD_ADD_DESKRIPSI_OPD'];
$OPD_ADD_KODE_OPD_LAMA 					= $_GET['OPD_ADD_KODE_OPD_LAMA'];
$OPD_ADD_DESKRIPSI_OPD_LAMA 		= $_GET['OPD_ADD_DESKRIPSI_OPD_LAMA'];
$OPD_ADD_PIMPINAN 							= $_GET['OPD_ADD_PIMPINAN'];
$OPD_ADD_SEKRETARIS 						= $_GET['OPD_ADD_SEKRETARIS'];
$OPD_ADD_BIDANG_TEKNIS_BAPPEDA 	= $_GET['OPD_ADD_BIDANG_TEKNIS_BAPPEDA'];

// insert data
$sql  = "INSERT INTO opd SET";
$sql .= " ";
$sql .= "urs1='".$OPD_ADD_URUSAN_1."',";
$sql .= "bid_urs1='".$OPD_ADD_BIDANG_URUSAN_1."',";
$sql .= "urs2='".$OPD_ADD_URUSAN_2."',";
$sql .= "bid_urs2='".$OPD_ADD_BIDANG_URUSAN_2."',";
$sql .= "urs3='".$OPD_ADD_URUSAN_3."',";
$sql .= "bid_urs3='".$OPD_ADD_BIDANG_URUSAN_3."',";
$sql .= "urutan_opd='".$OPD_ADD_URUTAN_OPD."',";
$sql .= "opd_id='".$OPD_ADD_KODE_OPD_LENGKAP."',";
$sql .= "deskripsi_opd='".$OPD_ADD_DESKRIPSI_OPD."',";
$sql .= "opd_id_old='".$OPD_ADD_KODE_OPD_LAMA."',";
$sql .= "deskripsi_old_opd='".$OPD_ADD_DESKRIPSI_OPD_LAMA."',";
$sql .= "pimpinan_id='".$OPD_ADD_PIMPINAN."',";
$sql .= "sekretaris_id='".$OPD_ADD_SEKRETARIS."',";
$sql .= "bidang_teknis_bappeda='".$OPD_ADD_BIDANG_TEKNIS_BAPPEDA."'";

$result			= mysql_query($sql);			// True/Resource on success, False on error
$num_result = mysql_affected_rows();	// Returns the number of affected rows on success, and -1 if the last query failed

if ($num_result > 0) {
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