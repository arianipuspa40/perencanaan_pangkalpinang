<?php
// connecting to db
require("dbconn.php");

//user admin super, admin opd, user bidang (disini tidak diperlukan karena get data berdasarkan id parent)
// lvl : kegiatan, subkegiatan, indiprog, indikeg, indisubkeg



$lvl  	= $_GET["lvl"];
$rowid  = $_POST["rowid"];
$sql	= "";

$data = array();

if ($lvl == "kegiatan"){
	// get data
	// $sql 		= "SELECT * FROM kegiatan_jangka_menengah WHERE PRT_ID=1";
	$sql 		= "SELECT * FROM kegiatan_tahunan WHERE PRT_ID=".$rowid; 
	$result = mysql_query($sql);
	// num rows
	$numrows = mysql_num_rows($result);
	if ($numrows > 0) {
		// data
		$temp 			= array();
		$data_table		= array();
		
		for ($i=0; $i<$numrows; $i++) {
			$row = mysql_fetch_object($result);	
			// $temp["$css"]										= "highlight";
			$temp["KEG_NO"] 									= $i+1;
			$temp["KEG_ROW_ID"] 								= $row->row_id;
			$temp["KEG_PRT_ID"] 								= $row->prt_id;
			$temp["KEG_PRTPRT_ID"] 								= $row->prtprt_id;
			$temp["KEG_OPD_ID"] 								= $row->opd_id;
			$temp["KEG_SUB_OPD_ID"] 							= $row->sub_opd_id;
			$temp["KEG_BIDANG_OPD_ID"] 							= $row->bidang_opd_id;
			$temp["KEG_URS_ID"] 								= $row->urs_id;			
			$temp["KEG_BID_URS_ID"] 							= $row->bid_urs_id;
			$temp["KEG_PROG_ID"] 								= $row->prog_id;
			$temp["KEG_KEG_KODE"] 								= $row->keg_kode;
			$temp["KEG_KEG_ID"] 								= $row->keg_id;
			$temp["KEG_PRG_FULL"] 								= $row->prg_full;
			$temp["KEG_KEG_FULL"] 								= $row->keg_full;
			$temp["KEG_DESKRIPSI"] 								= $row->deskripsi;
			$temp["KEG_REFR_PROG"] 								= $row->refr_prog;

			$temp["KEG_TARGET_AKHIR_PAGU_KEGIATAN"] 			= $row->target_akhir_pagu_kegiatan;
			$temp["KEG_P_TARGET_AKHIR_PAGU_KEGIATAN"] 			= $row->p_target_akhir_pagu_kegiatan;			
			$temp["KEG_PAGU_KEG_TAHUNAN_RENSTRA"] 				= $row->pagu_keg_tahunan_renstra;
			$temp["KEG_P_PAGU_KEG_TAHUNAN_RENSTRA"] 			= $row->p_pagu_keg_tahunan_renstra;
			$temp["KEG_TARGET_PAGU_KEG_RENJA"] 					= $row->target_pagu_keg_renja;
			$temp["KEG_P_TARGET_PAGU_KEG_RENJA"] 				= $row->p_target_pagu_keg_renja;
			$temp["KEG_TARGET_PAGU_KEG_DPA"] 					= $row->target_pagu_keg_dpa;
			$temp["KEG_P_TARGET_PAGU_KEG_DPA"] 					= $row->p_target_pagu_keg_dpa;	

			$temp["KEG_REALISASI_JUMLAH"] 						= $row->realisasi_jumlah;
			$temp["KEG_REALISASI_JUMLAH_BLN1"] 					= $row->realisasi_jumlah_bln1;
			$temp["KEG_REALISASI_JUMLAH_BLN2"] 					= $row->realisasi_jumlah_bln2;
			$temp["KEG_REALISASI_JUMLAH_BLN3"] 					= $row->realisasi_jumlah_bln3;
			$temp["KEG_REALISASI_JUMLAH_BLN4"] 					= $row->realisasi_jumlah_bln4;
			$temp["KEG_REALISASI_JUMLAH_BLN5"] 					= $row->realisasi_jumlah_bln5;
			$temp["KEG_REALISASI_JUMLAH_BLN6"] 					= $row->realisasi_jumlah_bln6;
			$temp["KEG_REALISASI_JUMLAH_BLN7"] 					= $row->realisasi_jumlah_bln7;
			$temp["KEG_REALISASI_JUMLAH_BLN8"] 					= $row->realisasi_jumlah_bln8;
			$temp["KEG_REALISASI_JUMLAH_BLN9"] 					= $row->realisasi_jumlah_bln9;
			$temp["KEG_REALISASI_JUMLAH_BLN10"] 				= $row->realisasi_jumlah_bln10;
			$temp["KEG_REALISASI_JUMLAH_BLN11"] 				= $row->realisasi_jumlah_bln11;
			$temp["KEG_REALISASI_JUMLAH_BLN12"] 				= $row->realisasi_jumlah_bln12;

			$temp["KEG_STATUS_RENJA"] 							= $row->status_renja;
			$temp["KEG_P_STATUS_RENJA"] 						= $row->p_status_renja;
			$temp["KEG_STATUS_DPA"] 							= $row->status_dpa;
			$temp["KEG_P_STATUS_DPA"] 							= $row->p_status_dpa;
			$temp["KEG_P_STATUS_REALISASI"] 					= $row->p_status_realisasi;			
			$temp["KEG_PROSES_RENSTRA"] 						= $row->proses_renstra;
			$temp["KEG_PROSES_RENJA"] 							= $row->proses_renja;
			$temp["KEG_PROSES_P_RENJA"] 						= $row->proses_p_renja;
			$temp["KEG_PROSES_DPA"] 							= $row->proses_dpa;
			$temp["KEG_PROSES_P_DPA"] 							= $row->proses_p_dpa;			
			$temp["KEG_PROSES_REALISASI"] 						= $row->proses_realisasi;
			$temp["KEG_CATATAN_REJECT"] 						= $row->catatan_reject;			
			$temp["KEG_TAHUN"] 									= $row->tahun;
			$temp["KEG_KODE_LENGKAP"]							= $row->urs_id.".".$row->bid_urs_id.".".$row->prog_id.".".$row->keg_kode.".".$row->keg_id;

			$data_table[] = $temp;
		}
		
		// echoing JSON response output
		header('Content-type: application/json');
		echo json_encode($data_table);
		
	} else {
		// no record found
	}	

}elseif ($lvl == "subkegiatan"){
	
	// get data
	// $sql 		= "SELECT * FROM kegiatan_jangka_menengah WHERE PRT_ID=1";
	$sql 		= "SELECT * FROM subkegiatan_tahunan WHERE PRT_ID=".$rowid; 
	$result = mysql_query($sql);
	// num rows
	$numrows = mysql_num_rows($result);
	if ($numrows > 0) {
		// data
		$temp 			= array();
		$data_table		= array();
		
		for ($i=0; $i<$numrows; $i++) {
			$row = mysql_fetch_object($result);	
			$temp["SUBKEG_NO"] 										= $i+1;

			$temp["SUBKEG_ROW_ID"] 									= $row->row_id;
			$temp["SUBKEG_PRT_ID"] 									= $row->prt_id;
			$temp["SUBKEG_PRTPRT_ID"] 								= $row->prtprt_id;
			$temp["SUBKEG_OPD_ID"] 									= $row->opd_id;
			$temp["SUBKEG_SUB_OPD_ID"] 								= $row->sub_opd_id;
			$temp["SUBKEG_BIDANG_OPD_ID"] 							= $row->bidang_opd_id;
			$temp["SUBKEG_URS_ID"] 									= $row->urs_id;			
			$temp["SUBKEG_BID_URS_ID"] 								= $row->bid_urs_id;
			$temp["SUBKEG_PROG_ID"] 								= $row->prog_id;
			$temp["SUBKEG_KEG_KODE"] 								= $row->keg_kode;
			$temp["SUBKEG_KEG_ID"] 									= $row->keg_id;
			$temp["SUBKEG_PRG_FULL"] 								= $row->prg_full;
			$temp["SUBKEG_KEG_FULL"] 								= $row->keg_full;
			$temp["SUBKEG_SUBKEG_FULL"] 							= $row->subkeg_full;
			$temp["SUBKEG_SUBKEG_ID"] 								= $row->subkeg_id;
			$temp["SUBKEG_DESKRIPSI"] 								= $row->deskripsi;
			$temp["SUBKEG_REFR_PROG"] 								= $row->refr_prog;

			$temp["SUBKEG_TARGET_AKHIR_PAGU_SUBKEGIATAN"] 			= $row->target_akhir_pagu_subkegiatan;
			$temp["SUBKEG_P_TARGET_AKHIR_PAGU_SUBKEGIATAN"] 		= $row->p_target_akhir_pagu_subkegiatan;			
			$temp["SUBKEG_PAGU_SUBKEG_TAHUNAN_RENSTRA"] 			= $row->pagu_subkeg_tahunan_renstra;
			$temp["SUBKEG_P_PAGU_SUBKEG_TAHUNAN_RENSTRA"] 			= $row->p_pagu_subkeg_tahunan_renstra;
			$temp["SUBKEG_TARGET_PAGU_SUBKEG_RENJA"] 				= $row->target_pagu_subkeg_renja;
			$temp["SUBKEG_P_TARGET_PAGU_SUBKEG_RENJA"] 				= $row->p_target_pagu_subkeg_renja;
			$temp["SUBKEG_TARGET_PAGU_SUBKEG_DPA"] 					= $row->target_pagu_subkeg_dpa;
			$temp["SUBKEG_P_TARGET_PAGU_SUBKEG_DPA"] 				= $row->p_target_pagu_subkeg_dpa;	

			$temp["SUBKEG_REALISASI_JUMLAH"] 						= $row->realisasi_jumlah;
			$temp["SUBKEG_REALISASI_JUMLAH_BLN1"] 					= $row->realisasi_jumlah_bln1;
			$temp["SUBKEG_REALISASI_JUMLAH_BLN2"] 					= $row->realisasi_jumlah_bln2;
			$temp["SUBKEG_REALISASI_JUMLAH_BLN3"] 					= $row->realisasi_jumlah_bln3;
			$temp["SUBKEG_REALISASI_JUMLAH_BLN4"] 					= $row->realisasi_jumlah_bln4;
			$temp["SUBKEG_REALISASI_JUMLAH_BLN5"] 					= $row->realisasi_jumlah_bln5;
			$temp["SUBKEG_REALISASI_JUMLAH_BLN6"] 					= $row->realisasi_jumlah_bln6;
			$temp["SUBKEG_REALISASI_JUMLAH_BLN7"] 					= $row->realisasi_jumlah_bln7;
			$temp["SUBKEG_REALISASI_JUMLAH_BLN8"] 					= $row->realisasi_jumlah_bln8;
			$temp["SUBKEG_REALISASI_JUMLAH_BLN9"] 					= $row->realisasi_jumlah_bln9;
			$temp["SUBKEG_REALISASI_JUMLAH_BLN10"] 					= $row->realisasi_jumlah_bln10;
			$temp["SUBKEG_REALISASI_JUMLAH_BLN11"] 					= $row->realisasi_jumlah_bln11;
			$temp["SUBKEG_REALISASI_JUMLAH_BLN12"] 					= $row->realisasi_jumlah_bln12;

			$temp["SUBKEG_STATUS_RENJA"] 							= $row->status_renja;
			$temp["SUBKEG_P_STATUS_RENJA"] 							= $row->p_status_renja;
			$temp["SUBKEG_STATUS_DPA"] 								= $row->status_dpa;
			$temp["SUBKEG_P_STATUS_DPA"] 							= $row->p_status_dpa;
			$temp["SUBKEG_P_STATUS_REALISASI"] 						= $row->p_status_realisasi;			
			$temp["SUBKEG_PROSES_RENSTRA"] 							= $row->proses_renstra;
			$temp["SUBKEG_PROSES_RENJA"] 							= $row->proses_renja;
			$temp["SUBKEG_PROSES_P_RENJA"] 							= $row->proses_p_renja;
			$temp["SUBKEG_PROSES_DPA"] 								= $row->proses_dpa;
			$temp["SUBKEG_PROSES_P_DPA"] 							= $row->proses_p_dpa;			
			$temp["SUBKEG_PROSES_REALISASI"] 						= $row->proses_realisasi;
			$temp["SUBKEG_CATATAN_REJECT"] 							= $row->catatan_reject;			
			$temp["SUBKEG_TAHUN"] 									= $row->tahun;
			$temp["SUBKEG_KODE_LENGKAP"]							= $row->urs_id.".".$row->bid_urs_id.".".$row->prog_id.".".$row->keg_kode.".".$row->keg_id.".".$row->subkeg_id;

			$data_table[] = $temp;
		}
		
		// echoing JSON response output
		header('Content-type: application/json');
		echo json_encode($data_table);
		
	} else {
		// no record found
	}


	// $data["status"] 	= "success subkegiatan ".$rowid;
	// // echoing JSON response output
	// header('Content-type: application/json');
	// echo json_encode($data);

}elseif ($lvl == "indiprog"){
	// catatan penting data indikator yang di isi realisasinya adalah yang proses_dpa = 2 (apbd sudah ditetapkan, boleh entri realisasi) 
	//  atau proses_p_dpa = 2 (apbd perubahan sudah ditetapkan, boleh entri realisasi)
	//  dan proses_realisasi <> 2 (kl 2 berarti sudah ditetapkan tidak boleh diedit2 lagi)
	// $sql 		= "SELECT * FROM indikator_program_tahunan WHERE PRT_ID=".$rowid." "; 
	// SETTING tahun dan sub_opd_id
	$sql 		= "SELECT * FROM indikator_program_tahunan WHERE PRT_ID=".$rowid; 
	$result = mysql_query($sql);
	// num rows
	$numrows = mysql_num_rows($result);
	if ($numrows > 0) {
		// data
		$temp 			= array();
		$data_table		= array();
		
		for ($i=0; $i<$numrows; $i++) {
			$row = mysql_fetch_object($result);	
			$temp["INDIPROG_NO"] 							= $i+1;

			$temp["INDIPROG_ROW_ID"] 								= $row->row_id;
			$temp["INDIPROG_PRT_ID"] 								= $row->prt_id;
			$temp["INDIPROG_OPD_ID"] 								= $row->opd_id;
			$temp["INDIPROG_SUB_OPD_ID"] 							= $row->sub_opd_id;
			// $temp["BIDANG_OPD_ID"] 								= $row->bidang_opd_id;
			$temp["INDIPROG_URS_ID"] 								= $row->urs_id;			
			$temp["INDIPROG_BID_URS_ID"] 							= $row->bid_urs_id;
			$temp["INDIPROG_PROG_ID"] 								= $row->prog_id;
			$temp["INDIPROG_PRG_FULL"] 								= $row->prg_full;
			$temp["INDIPROG_INDIKATOR_PROGRAM"] 					= $row->Indikator_program;
			$temp["INDIPROG_SATUAN_INDIKATOR_PROGRAM"] 				= $row->satuan_indikator_program;
			$temp["INDIPROG_KINERJA_AWAL_PROGAM"] 					= $row->kinerja_awal_program;

			$temp["INDIPROG_TARGET_AKHIR_KINERJA_PROGRAM"] 			= $row->target_akhir_kinerja_program;			
			$temp["INDIPROG_P_TARGET_AKHIR_KINERJA_PROGRAM"] 		= $row->p_target_akhir_kinerja_program;
			$temp["INDIPROG_KINERJA_PROG_RENSTRA_TAHUNAN"] 			= $row->kinerja_prog_renstra_tahunan;
			$temp["INDIPROG_P_KINERJA_PROG_RENSTRA_TAHUNAN"]		= $row->p_kinerja_prog_renstra_tahunan;
			$temp["INDIPROG_KINERJA_RENJA_PROG"] 					= $row->kinerja_renja_prog;
			$temp["INDIPROG_P_KINERJA_RENJA_PROG"] 					= $row->p_kinerja_renja_prog;
			$temp["INDIPROG_KINERJA_DPA_PROG"] 						= $row->kinerja_dpa_prog;
			$temp["INDIPROG_P_KINERJA_DPA_PROG"] 					= $row->p_kinerja_dpa_prog;

			$temp["INDIPROG_REALISASI_KINERJA_BLN1"] 				= $row->realisasi_kinerja_bln1;
			$temp["INDIPROG_REALISASI_KINERJA_BLN2"] 				= $row->realisasi_kinerja_bln2;
			$temp["INDIPROG_REALISASI_KINERJA_BLN3"] 				= $row->realisasi_kinerja_bln3;
			$temp["INDIPROG_REALISASI_KINERJA_BLN4"] 				= $row->realisasi_kinerja_bln4;
			$temp["INDIPROG_REALISASI_KINERJA_BLN5"] 				= $row->realisasi_kinerja_bln5;
			$temp["INDIPROG_REALISASI_KINERJA_BLN6"] 				= $row->realisasi_kinerja_bln6;
			$temp["INDIPROG_REALISASI_KINERJA_BLN7"] 				= $row->realisasi_kinerja_bln7;
			$temp["INDIPROG_REALISASI_KINERJA_BLN8"] 				= $row->realisasi_kinerja_bln8;
			$temp["INDIPROG_REALISASI_KINERJA_BLN9"] 				= $row->realisasi_kinerja_bln9;
			$temp["INDIPROG_REALISASI_KINERJA_BLN10"] 				= $row->realisasi_kinerja_bln10;
			$temp["INDIPROG_REALISASI_KINERJA_BLN11"] 				= $row->realisasi_kinerja_bln11;
			$temp["INDIPROG_REALISASI_KINERJA_BLN12"] 				= $row->realisasi_kinerja_bln12;

			$temp["INDIPROG_REALISASI_FISIK_BLN1"] 					= $row->realisasi_fisik_bln1;
			$temp["INDIPROG_REALISASI_FISIK_BLN2"] 					= $row->realisasi_fisik_bln2;
			$temp["INDIPROG_REALISASI_FISIK_BLN3"] 					= $row->realisasi_fisik_bln3;
			$temp["INDIPROG_REALISASI_FISIK_BLN4"] 					= $row->realisasi_fisik_bln4;
			$temp["INDIPROG_REALISASI_FISIK_BLN5"] 					= $row->realisasi_fisik_bln5;
			$temp["INDIPROG_REALISASI_FISIK_BLN6"] 					= $row->realisasi_fisik_bln6;
			$temp["INDIPROG_REALISASI_FISIK_BLN7"] 					= $row->realisasi_fisik_bln7;
			$temp["INDIPROG_REALISASI_FISIK_BLN8"] 					= $row->realisasi_fisik_bln8;
			$temp["INDIPROG_REALISASI_FISIK_BLN9"] 					= $row->realisasi_fisik_bln9;
			$temp["INDIPROG_REALISASI_FISIK_BLN10"] 				= $row->realisasi_fisik_bln10;
			$temp["INDIPROG_REALISASI_FISIK_BLN11"] 				= $row->realisasi_fisik_bln11;
			$temp["INDIPROG_REALISASI_FISIK_BLN12"] 				= $row->realisasi_fisik_bln12;

			$temp["INDIPROG_PROSES_RENSTRA"] 						= $row->proses_renstra;
			$temp["INDIPROG_PROSES_RENJA"] 							= $row->proses_renja;
			$temp["INDIPROG_PROSES_P_RENJA"] 						= $row->proses_p_renja;
			$temp["INDIPROG_PROSES_DPA"] 							= $row->proses_dpa;
			$temp["INDIPROG_PROSES_P_DPA"] 							= $row->proses_p_dpa;			
			$temp["INDIPROG_PROSES_REALISASI"] 						= $row->proses_realisasi;
			$temp["INDIPROG_CATATAN_REJECT"] 						= $row->catatan_reject;			
			$temp["INDIPROG_TAHUN"] 								= $row->tahun;
			$temp["INDIPROG_PROG_KODE_LENGKAP"]						= $row->urs_id.".".$row->bid_urs_id.".".$row->prog_id;	

			$data_table[] = $temp;
		}
		
		// echoing JSON response output
		header('Content-type: application/json');
		echo json_encode($data_table);
		
	} else {
		// no record found
	}	

}elseif ($lvl == "indikeg"){
	$sql 		= "SELECT * FROM indikator_kegiatan_tahunan WHERE PRT_ID=".$rowid; 
	$result 	= mysql_query($sql);
	// num rows
	$numrows = mysql_num_rows($result);
	if ($numrows > 0) {
		// data
		$temp 			= array();
		$data_table		= array();
		
		for ($i=0; $i<$numrows; $i++) {
			$row = mysql_fetch_object($result);	
			$temp["INDIKEG_NO"] 									= $i+1;			

			$temp["INDIKEG_ROW_ID"] 								= $row->row_id;
			$temp["INDIKEG_PRT_ID"] 								= $row->prt_id;
			$temp["INDIKEG_OPD_ID"] 								= $row->opd_id;
			$temp["INDIKEG_SUB_OPD_ID"] 							= $row->sub_opd_id;
			$temp["INDIKEG_URS_ID"] 								= $row->urs_id;			
			$temp["INDIKEG_BID_URS_ID"] 							= $row->bid_urs_id;
			$temp["INDIKEG_PROG_ID"] 								= $row->prog_id;
			$temp["INDIKEG_KEG_KODE"] 								= $row->keg_kode;
			$temp["INDIKEG_KEG_ID"] 								= $row->keg_id;
			$temp["INDIKEG_PRG_FULL"] 								= $row->prg_full;
			$temp["INDIKEG_KEG_FULL"] 								= $row->keg_full;
			$temp["INDIKEG_INDIKATOR_KEGIATAN"] 					= $row->Indikator_kegiatan;
			$temp["INDIKEG_SATUAN_INDIKATOR_KEGIATAN"] 				= $row->satuan_indikator_kegiatan;
			$temp["INDIKEG_KINERJA_AWAL_KEGIATAN"] 					= $row->kinerja_awal_kegiatan;

			$temp["INDIKEG_TARGET_AKHIR_KINERJA_KEGIATAN"] 			= $row->target_akhir_kinerja_kegiatan;			
			$temp["INDIKEG_P_TARGET_AKHIR_KINERJA_KEGIATAN"] 		= $row->p_target_akhir_kinerja_kegiatan;
			$temp["INDIKEG_KINERJA_KEG_RENSTRA_TAHUNAN"] 			= $row->kinerja_keg_renstra_tahunan;
			$temp["INDIKEG_P_KINERJA_KEG_RENSTRA_TAHUNAN"]			= $row->p_kinerja_keg_renstra_tahunan;
			$temp["INDIKEG_KINERJA_RENJA_KEG"] 						= $row->kinerja_renja_keg;
			$temp["INDIKEG_P_KINERJA_RENJA_KEG"] 					= $row->p_kinerja_renja_keg;
			$temp["INDIKEG_KINERJA_DPA_KEG"] 						= $row->kinerja_dpa_keg;
			$temp["INDIKEG_P_KINERJA_DPA_KEG"] 						= $row->p_kinerja_dpa_keg;

			$temp["INDIKEG_REALISASI_KINERJA_BLN1"] 				= $row->realisasi_kinerja_bln1;
			$temp["INDIKEG_REALISASI_KINERJA_BLN2"] 				= $row->realisasi_kinerja_bln2;
			$temp["INDIKEG_REALISASI_KINERJA_BLN3"] 				= $row->realisasi_kinerja_bln3;
			$temp["INDIKEG_REALISASI_KINERJA_BLN4"] 				= $row->realisasi_kinerja_bln4;
			$temp["INDIKEG_REALISASI_KINERJA_BLN5"] 				= $row->realisasi_kinerja_bln5;
			$temp["INDIKEG_REALISASI_KINERJA_BLN6"] 				= $row->realisasi_kinerja_bln6;
			$temp["INDIKEG_REALISASI_KINERJA_BLN7"] 				= $row->realisasi_kinerja_bln7;
			$temp["INDIKEG_REALISASI_KINERJA_BLN8"] 				= $row->realisasi_kinerja_bln8;
			$temp["INDIKEG_REALISASI_KINERJA_BLN9"] 				= $row->realisasi_kinerja_bln9;
			$temp["INDIKEG_REALISASI_KINERJA_BLN10"] 				= $row->realisasi_kinerja_bln10;
			$temp["INDIKEG_REALISASI_KINERJA_BLN11"] 				= $row->realisasi_kinerja_bln11;
			$temp["INDIKEG_REALISASI_KINERJA_BLN12"] 				= $row->realisasi_kinerja_bln12;

			$temp["INDIKEG_REALISASI_FISIK_BLN1"] 					= $row->realisasi_fisik_bln1;
			$temp["INDIKEG_REALISASI_FISIK_BLN2"] 					= $row->realisasi_fisik_bln2;
			$temp["INDIKEG_REALISASI_FISIK_BLN3"] 					= $row->realisasi_fisik_bln3;
			$temp["INDIKEG_REALISASI_FISIK_BLN4"] 					= $row->realisasi_fisik_bln4;
			$temp["INDIKEG_REALISASI_FISIK_BLN5"] 					= $row->realisasi_fisik_bln5;
			$temp["INDIKEG_REALISASI_FISIK_BLN6"] 					= $row->realisasi_fisik_bln6;
			$temp["INDIKEG_REALISASI_FISIK_BLN7"] 					= $row->realisasi_fisik_bln7;
			$temp["INDIKEG_REALISASI_FISIK_BLN8"] 					= $row->realisasi_fisik_bln8;
			$temp["INDIKEG_REALISASI_FISIK_BLN9"] 					= $row->realisasi_fisik_bln9;
			$temp["INDIKEG_REALISASI_FISIK_BLN10"] 					= $row->realisasi_fisik_bln10;
			$temp["INDIKEG_REALISASI_FISIK_BLN11"] 					= $row->realisasi_fisik_bln11;
			$temp["INDIKEG_REALISASI_FISIK_BLN12"] 					= $row->realisasi_fisik_bln12;

			$temp["INDIKEG_PROSES_RENSTRA"] 						= $row->proses_renstra;
			$temp["INDIKEG_PROSES_RENJA"] 							= $row->proses_renja;
			$temp["INDIKEG_PROSES_P_RENJA"] 						= $row->proses_p_renja;
			$temp["INDIKEG_PROSES_DPA"] 							= $row->proses_dpa;
			$temp["INDIKEG_PROSES_P_DPA"] 							= $row->proses_p_dpa;			
			$temp["INDIKEG_PROSES_REALISASI"] 						= $row->proses_realisasi;
			$temp["INDIKEG_CATATAN_REJECT"] 						= $row->catatan_reject;			
			$temp["INDIKEG_TAHUN"] 									= $row->tahun;

			$data_table[] = $temp;
		}
		
		// echoing JSON response output
		header('Content-type: application/json');
		echo json_encode($data_table);
		
	} else {
		// no record found
	}


	// $data["status"] 	= "success indikator kegiatan";
	// $data["numrows"] 	= $numrows;
	// // echoing JSON response output
	// header('Content-type: application/json');
	// echo json_encode($data);	
	
}elseif ($lvl == "indisubkeg"){
	$sql 		= "SELECT * FROM indikator_subkegiatan_tahunan WHERE PRT_ID=".$rowid; 
	$result = mysql_query($sql);
	// num rows
	$numrows = mysql_num_rows($result);	
	if ($numrows > 0) {
		// data
		$temp 			= array();
		$data_table		= array();
		
		for ($i=0; $i<$numrows; $i++) {
			$row = mysql_fetch_object($result);	
			$temp["INDISUBKEG_NO"] 										= $i+1;
			
			$temp["INDISUBKEG_ROW_ID"] 									= $row->row_id;
			$temp["INDISUBKEG_PRT_ID"] 									= $row->prt_id;
			$temp["INDISUBKEG_OPD_ID"] 									= $row->opd_id;
			$temp["INDISUBKEG_SUB_OPD_ID"] 								= $row->sub_opd_id;
			$temp["INDISUBKEG_URS_ID"] 									= $row->urs_id;			
			$temp["INDISUBKEG_BID_URS_ID"] 								= $row->bid_urs_id;
			$temp["INDISUBKEG_PROG_ID"] 								= $row->prog_id;
			$temp["INDISUBKEG_KEG_KODE"] 								= $row->keg_kode;
			$temp["INDISUBKEG_KEG_ID"] 									= $row->keg_id;
			$temp["INDISUBKEG_PRG_FULL"] 								= $row->prg_full;
			$temp["INDISUBKEG_KEG_FULL"] 								= $row->keg_full;
			$temp["INDISUBKEG_SUBKEG_FULL"] 							= $row->subkeg_full;
			$temp["INDISUBKEG_SUBKEG_ID"] 								= $row->subkeg_id;
			$temp["INDISUBKEG_INDIKATOR_SUBKEGIATAN"] 					= $row->Indikator_subkegiatan;
			$temp["INDISUBKEG_SATUAN_INDIKATOR_SUBKEGIATAN"]			= $row->satuan_indikator_subkegiatan;
			$temp["INDISUBKEG_KINERJA_AWAL_SUBKEGIATAN"] 				= $row->kinerja_awal_subkegiatan;

			$temp["INDISUBKEG_TARGET_AKHIR_KINERJA_SUBKEGIATAN"] 		= $row->target_akhir_kinerja_subkegiatan;			
			$temp["INDISUBKEG_P_TARGET_AKHIR_KINERJA_SUBKEGIATAN"] 		= $row->p_target_akhir_kinerja_subkegiatan;
			$temp["INDISUBKEG_KINERJA_SUBKEG_RENSTRA_TAHUNAN"] 			= $row->kinerja_subkeg_renstra_tahunan;
			$temp["INDISUBKEG_P_KINERJA_SUBKEG_RENSTRA_TAHUNAN"]		= $row->p_kinerja_subkeg_renstra_tahunan;
			$temp["INDISUBKEG_KINERJA_RENJA_SUBKEG"] 					= $row->kinerja_renja_subkeg;
			$temp["INDISUBKEG_P_KINERJA_RENJA_SUBKEG"] 					= $row->p_kinerja_renja_subkeg;
			$temp["INDISUBKEG_KINERJA_DPA_SUBKEG"] 						= $row->kinerja_dpa_subkeg;
			$temp["INDISUBKEG_P_KINERJA_DPA_SUBKEG"] 					= $row->p_kinerja_dpa_subkeg;

			$temp["INDISUBKEG_REALISASI_KINERJA_BLN1"] 					= $row->realisasi_kinerja_bln1;
			$temp["INDISUBKEG_REALISASI_KINERJA_BLN2"] 					= $row->realisasi_kinerja_bln2;
			$temp["INDISUBKEG_REALISASI_KINERJA_BLN3"] 					= $row->realisasi_kinerja_bln3;
			$temp["INDISUBKEG_REALISASI_KINERJA_BLN4"] 					= $row->realisasi_kinerja_bln4;
			$temp["INDISUBKEG_REALISASI_KINERJA_BLN5"] 					= $row->realisasi_kinerja_bln5;
			$temp["INDISUBKEG_REALISASI_KINERJA_BLN6"] 					= $row->realisasi_kinerja_bln6;
			$temp["INDISUBKEG_REALISASI_KINERJA_BLN7"] 					= $row->realisasi_kinerja_bln7;
			$temp["INDISUBKEG_REALISASI_KINERJA_BLN8"] 					= $row->realisasi_kinerja_bln8;
			$temp["INDISUBKEG_REALISASI_KINERJA_BLN9"] 					= $row->realisasi_kinerja_bln9;
			$temp["INDISUBKEG_REALISASI_KINERJA_BLN10"] 				= $row->realisasi_kinerja_bln10;
			$temp["INDISUBKEG_REALISASI_KINERJA_BLN11"] 				= $row->realisasi_kinerja_bln11;
			$temp["INDISUBKEG_REALISASI_KINERJA_BLN12"] 				= $row->realisasi_kinerja_bln12;

			$temp["INDISUBKEG_REALISASI_FISIK_BLN1"] 					= $row->realisasi_fisik_bln1;
			$temp["INDISUBKEG_REALISASI_FISIK_BLN2"] 					= $row->realisasi_fisik_bln2;
			$temp["INDISUBKEG_REALISASI_FISIK_BLN3"] 					= $row->realisasi_fisik_bln3;
			$temp["INDISUBKEG_REALISASI_FISIK_BLN4"] 					= $row->realisasi_fisik_bln4;
			$temp["INDISUBKEG_REALISASI_FISIK_BLN5"] 					= $row->realisasi_fisik_bln5;
			$temp["INDISUBKEG_REALISASI_FISIK_BLN6"] 					= $row->realisasi_fisik_bln6;
			$temp["INDISUBKEG_REALISASI_FISIK_BLN7"] 					= $row->realisasi_fisik_bln7;
			$temp["INDISUBKEG_REALISASI_FISIK_BLN8"] 					= $row->realisasi_fisik_bln8;
			$temp["INDISUBKEG_REALISASI_FISIK_BLN9"] 					= $row->realisasi_fisik_bln9;
			$temp["INDISUBKEG_REALISASI_FISIK_BLN10"] 					= $row->realisasi_fisik_bln10;
			$temp["INDISUBKEG_REALISASI_FISIK_BLN11"] 					= $row->realisasi_fisik_bln11;
			$temp["INDISUBKEG_REALISASI_FISIK_BLN12"] 					= $row->realisasi_fisik_bln12;

			$temp["INDISUBKEG_PROSES_RENSTRA"] 							= $row->proses_renstra;
			$temp["INDISUBKEG_PROSES_RENJA"] 							= $row->proses_renja;
			$temp["INDISUBKEG_PROSES_P_RENJA"] 							= $row->proses_p_renja;
			$temp["INDISUBKEG_PROSES_DPA"] 								= $row->proses_dpa;
			$temp["INDISUBKEG_PROSES_P_DPA"] 							= $row->proses_p_dpa;			
			$temp["INDISUBKEG_PROSES_REALISASI"] 						= $row->proses_realisasi;
			$temp["INDISUBKEG_CATATAN_REJECT"] 							= $row->catatan_reject;			
			$temp["INDISUBKEG_TAHUN"] 									= $row->tahun;		

			$data_table[] = $temp;
		}
		
		// echoing JSON response output
		header('Content-type: application/json');
		echo json_encode($data_table);
		
	} else {
		// no record found
	}


	// $data["status"] 	= "success indikator subkegiatan ".$numrows;
	// // echoing JSON response output
	// header('Content-type: application/json');
	// echo json_encode($data);	
}

?>