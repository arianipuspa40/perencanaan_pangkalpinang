<?php
// connecting to db
require("dbconn.php");

// post data
$KODE_OPD_TXT 							= $_GET['KODE_OPD_TXT'];
$DESKRIPSI_TXT 							= $_GET['DESKRIPSI_TXT'];
$BIDANG_TEKNIS_TXT 					= $_GET['BIDANG_TEKNIS_TXT'];
$PIMPINAN_TXT 							= $_GET['PIMPINAN_TXT'];

$where = ""; $from = 0; $perp = 30; 	$from = $_GET['from'];	$mode = $_GET['mode'];

if ($KODE_OPD_TXT<>"") 			{$where .= " opd_id LIKE '". $KODE_OPD_TXT ."%'  AND ";} 
if ($DESKRIPSI_TXT<>"") 		{$where .= " deskripsi_opd LIKE '". $DESKRIPSI_TXT ."%'  AND ";} 
if ($BIDANG_TEKNIS_TXT<>"") {$where .= " bidang_teknis_bappeda LIKE '". $BIDANG_TEKNIS_TXT ."%'  AND ";} 
if ($PIMPINAN_TXT<>"") 			{$where .= " pimpinan_id LIKE '". $PIMPINAN_TXT ."%'  AND ";} 

$where = substr($where,0,strlen($where)-4);
if ($where=="") {$where = " row_id LIKE '%' ";}

if ($mode=="paging") {
	// get data
	$sql = "SELECT COUNT(row_id) AS numr FROM opd WHERE ".$where;
	$result = mysql_query($sql);
	$numr = 0;	
	while ($row = mysql_fetch_object($result)) {	
		$numr = $row->numr;
	}	
	$page = ceil($numr/$perp);
	mysql_free_result($result);	
	
	$data = array();
	$data["status"] = "success";
	$data["numr"] 	= $numr;
	$data["page"] 	= $page;
	$data["perp"] 	= $perp;
	
	// echoing JSON response output
	header('Content-type: application/json');
	echo json_encode($data);
	
} else {
	// get data
	$sql 		= "SELECT * FROM opd WHERE ".$where." ORDER BY row_id LIMIT ".$from.",".$perp;
	$result = mysql_query($sql);

	// num rows
	$numrows = mysql_num_rows($result);

	if ($numrows > 0) {
		// data
		$data 			= array();
		$data_table = array();
		
		for ($i=0; $i<$numrows; $i++) {
			$row = mysql_fetch_object($result);
			
			$no 										= $i+1+$from;
			$row_id 								= $row->row_id;
			$urs1 									= $row->urs1;
			$bid_urs1								= $row->bid_urs1;
			$urs2 									= $row->urs2;
			$bid_urs2  							= $row->bid_urs2;
			$urs3 									= $row->urs3;
			$bid_urs3 							= $row->bid_urs3;
			$urutan_opd 						= $row->urutan_opd;
			$opd_id 								= $row->opd_id;
			$sub_opd_id 						= $row->sub_opd_id;
			$deskripsi_opd 					= $row->deskripsi_opd;
			$opd_id_old 						= $row->opd_id_old;
			$deskripsi_old_opd 			= $row->deskripsi_old_opd;
			$pimpinan_id 						= $row->pimpinan_id;
			$sekretaris_id 					= $row->sekretaris_id;
			$bidang_teknis_bappeda 	= $row->bidang_teknis_bappeda;
			$status_aktif 					= $row->status_aktif;
			
			$data["ROW_ID"] 								= $row_id;
			$data["NO"] 										= $no;
			$data["URUSAN_1"] 							= $urs1;
			$data["BIDANG_URUSAN_1"] 				= $bid_urs1;
			$data["URUSAN_2"] 							= $urs2;
			$data["BIDANG_URUSAN_2"] 				= $bid_urs2;
			$data["URUSAN_3"] 							= $urs3;
			$data["BIDANG_URUSAN_3"] 				= $bid_urs3;
			$data["URUTAN_OPD"] 						= $urutan_opd;
			$data["KODE_OPD_LENGKAP"] 			= $opd_id;
			$data["DESKRIPSI_OPD"] 					= $deskripsi_opd;
			$data["KODE_OPD_LAMA"] 					= $opd_id_old;
			$data["DESKRIPSI_OPD_LAMA"] 		= $deskripsi_old_opd;
			$data["PIMPINAN"] 							= $pimpinan_id;
			$data["SEKRETARIS"] 						= $sekretaris_id;
			$data["BIDANG_TEKNIS_BAPPEDA"] 	= $bidang_teknis_bappeda;
			
			$data_table[] = $data;
		}
		
		// echoing JSON response output
		header('Content-type: application/json');
		echo json_encode($data_table);
		
	} else {
		// no record found
	}
}
?>