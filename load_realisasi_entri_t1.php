<?php
// connecting to db
require("dbconn.php");
// get data
$sql 		= "SELECT * FROM program_tahunan";
$result = mysql_query($sql);

// num rows
$numrows = mysql_num_rows($result);

if ($numrows > 0) {
	// data
	$data 			= array();
	$data_table = array();
	
	for ($i=0; $i<$numrows; $i++) {
		$row = mysql_fetch_object($result);
		
		$no 										= $i+1;
		
		
		$data["row_id"] 								= $row->row_id;
		$data["NO"] 									= $no;
		$data["prt_id"] 							    = $row->prt_id;
		$data["sasaran_daerah_id"] 						= $row->sasaran_daerah_id;
		$data["sasaran_pd_id"] 							= $row->sasaran_pd_id;
		$data["opd_id"] 								= $row->opd_id;
		$data["sub_opd_id"] 							= $row->sub_opd_id;
		$data["bidang_opd_id"] 							= $row->bidang_opd_id;
		$data["urs_id"] 								= $row->urs_id;
		$data["bid_urs_id"] 							= $row->bid_urs_id;
		$data["prog_id"] 								= $row->prog_id;
		$data["deskripsi"] 								= $row->deskripsi;		
		$data["target_pagu_prog_renja"] 				= $row->target_pagu_prog_renja;
		$data["realisasi_jumlah_bln1"] 		            = $row->realisasi_jumlah_bln1;
		$data["realisasi_jumlah_bln2"] 		            = $row->realisasi_jumlah_bln2;
		$data["realisasi_jumlah_bln3"] 		            = $row->realisasi_jumlah_bln3;
		// $data["PIMPINAN"] 							= $pimpinan_id;
		// $data["SEKRETARIS"] 						= $sekretaris_id;
		// $data["BIDANG_TEKNIS_BAPPEDA"] 	= $bidang_teknis_bappeda;
		// $data["STATUS_AKTIF"]  = $row->status_aktif;

		$data_table[] = $data;
	}
	
	// echoing JSON response output
	header('Content-type: application/json');
	echo json_encode($data_table);
	
} else {
	// no record found
}

?>