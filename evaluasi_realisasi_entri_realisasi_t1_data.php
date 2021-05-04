<?php
// connecting to db
require("dbconn.php");
	
// post data
$URUSAN_TXT 				= $_GET['URUSAN_TXT'];
$BIDANG_URUSAN_TXT 			= $_GET['BIDANG_URUSAN_TXT'];
$OPD_TXT 					= $_GET['OPD_TXT'];
$SUBOPD_TXT 				= $_GET['SUBOPD_TXT'];

$where = ""; $from = 0; $perp = 10; 	$from = $_GET['from'];	$mode = $_GET['mode'];

if ($URUSAN_TXT<>"") 			{$where .= " urs_id LIKE '". $URUSAN_TXT ."%'  AND ";} 
if ($BIDANG_URUSAN_TXT<>"") 	{$where .= " bid_urs_id LIKE '". $BIDANG_URUSAN_TXT ."%'  AND ";} 
if ($OPD_TXT<>"") 				{$where .= " opd_id LIKE '". $OPD_TXT ."%'  AND ";} 
if ($SUBOPD_TXT<>"") 			{$where .= " sub_opd_id LIKE '". $SUBOPD_TXT ."%'  AND ";} 
$where = substr($where,0,strlen($where)-4);
if ($where=="") {$where = " row_id LIKE '%' ";}

if ($mode=="paging") {
	// get data
	$sql = "SELECT COUNT(row_id) AS numr FROM program_tahunan WHERE ".$where;
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
	$data["where"]  = $where;
	
	// echoing JSON response output
	header('Content-type: application/json');
	echo json_encode($data);
	
} else {
	// get data
	$sql 		= "SELECT * FROM program_tahunan WHERE ".$where." ORDER BY row_id LIMIT ".$from.",".$perp;	
	$result     = mysql_query($sql);

	// num rows
	$numrows = mysql_num_rows($result);

	if ($numrows > 0) {
		// data
		$data 			= array();
		$data_table = array();
		
		for ($i=0; $i<$numrows; $i++) {
			$row = mysql_fetch_object($result);
			
			$no 											= $i+1+$from;				
			$data["ROW_ID"] 								= $row->row_id;
			$data["NO"] 									= $no;
			$data["PRT_ID"] 								= $row->prt_id;
			$data["SASARAN_DAERAH_ID"] 						= $row->sasaran_daerah_id;
			$data["SASARAN_PD_ID"] 							= $row->sasaran_pd_id;
			// $data["TUJUAN_PD_ID"] 							= $row->tujuan_pd_id;
			$data["OPD_ID"] 								= $row->opd_id;
			$data["SUB_OPD_ID"] 							= $row->sub_opd_id;
			$data["BIDANG_OPD_ID"] 							= $row->bidang_opd_id;
			$data["URS_ID"] 								= $row->urs_id;			
			$data["BID_URS_ID"] 							= $row->bid_urs_id;
			$data["PROG_ID"] 								= $row->prog_id;
			$data["PRG_FULL"] 								= $row->prg_full;
			$data["DESKRIPSI"] 								= $row->deskripsi;
			$data["REFR_PROG"] 								= $row->refr_prog;
			$data["TARGET_AKHIR_PAGU_PROGRAM"] 				= $row->target_akhir_pagu_program;
			$data["P_TARGET_AKHIR_PAGU_PROGRAM"] 			= $row->p_target_akhir_pagu_program;			
			$data["PAGU_PROG_TAHUNAN_RENSTRA"] 				= $row->pagu_prog_tahunan_renstra;
			$data["P_PAGU_PROG_TAHUNAN_RENSTRA"] 			= $row->p_pagu_prog_tahunan_renstra;
			$data["TARGET_PAGU_PROG_RENJA"] 				= $row->target_pagu_prog_renja;
			$data["P_TARGET_PAGU_PROG_RENJA"] 				= $row->p_target_pagu_prog_renja;
			$data["TARGET_PAGU_PROG_DPA"] 					= $row->target_pagu_prog_dpa;
			$data["P_TARGET_PAGU_PROG_DPA"] 				= $row->p_target_pagu_prog_dpa;			
			$data["REALISASI_JUMLAH"] 						= $row->realisasi_jumlah;
			$data["REALISASI_JUMLAH_BLN1"] 					= $row->realisasi_jumlah_bln1;
			$data["REALISASI_JUMLAH_BLN2"] 					= $row->realisasi_jumlah_bln2;
			$data["REALISASI_JUMLAH_BLN3"] 					= $row->realisasi_jumlah_bln3;
			$data["REALISASI_JUMLAH_BLN4"] 					= $row->realisasi_jumlah_bln4;
			$data["REALISASI_JUMLAH_BLN5"] 					= $row->realisasi_jumlah_bln5;
			$data["REALISASI_JUMLAH_BLN6"] 					= $row->realisasi_jumlah_bln6;
			$data["REALISASI_JUMLAH_BLN7"] 					= $row->realisasi_jumlah_bln7;
			$data["REALISASI_JUMLAH_BLN8"] 					= $row->realisasi_jumlah_bln8;
			$data["REALISASI_JUMLAH_BLN9"] 					= $row->realisasi_jumlah_bln9;
			$data["REALISASI_JUMLAH_BLN10"] 				= $row->realisasi_jumlah_bln10;
			$data["REALISASI_JUMLAH_BLN11"] 				= $row->realisasi_jumlah_bln11;
			$data["REALISASI_JUMLAH_BLN12"] 				= $row->realisasi_jumlah_bln12;
			$data["STATUS_RENJA"] 							= $row->status_renja;
			$data["P_STATUS_RENJA"] 						= $row->p_status_renja;
			$data["STATUS_DPA"] 							= $row->status_dpa;
			$data["P_STATUS_DPA"] 							= $row->p_status_dpa;
			$data["P_STATUS_REALISASI"] 					= $row->p_status_realisasi;			
			$data["PROSES_RENSTRA"] 						= $row->proses_renstra;
			$data["PROSES_RENJA"] 							= $row->proses_renja;
			$data["PROSES_P_RENJA"] 						= $row->proses_p_renja;
			$data["PROSES_DPA"] 							= $row->proses_dpa;
			$data["PROSES_P_DPA"] 							= $row->proses_p_dpa;			
			$data["PROSES_REALISASI"] 						= $row->proses_realisasi;
			$data["CATATAN_REJECT"] 						= $row->catatan_reject;			
			$data["TAHUN"] 									= $row->tahun;
			$data["PROG_KODE_LENGKAP"]						= $row->urs_id.".".$row->bid_urs_id.".".$row->prog_id;

			$data_table[] = $data;
		}
		
		// echoing JSON response output
		header('Content-type: application/json');
		echo json_encode($data_table);
	}
}
?>