<?php
// connecting to db
require_once("dbconn.php");

//user admin super, admin opd, user bidang (disini tidak diperlukan karena get data berdasarkan id parent)
// lvl : kegiatan, subkegiatan, indiprog, indikeg, indisubkeg



$lvl    = $_GET["lvl"];
$rowid  = $_POST["rowid"];
$sql  = "";

$data = array();

if ($lvl == "kegiatan") {
  // get data
  // $sql 		= "SELECT * FROM kegiatan_jangka_menengah WHERE PRT_ID=1";
  $sql   = "SELECT * FROM kegiatan_jangka_menengah WHERE PRT_ID=" . $rowid;
  $result = bmysqli_query($conn, $sql);
  // num rows
  $numrows = bmysqli_num_rows($result);
  if ($numrows > 0) {
    // data
    $temp       = array();
    $data_table    = array();

    for ($i = 0; $i < $numrows; $i++) {
      $row = bmysqli_fetch_object($result);
      $temp["KEG_NO"]       = $i + 1;
      $temp["KEG_ROW_ID"]      = $row->row_id;
      $temp["KEG_PRT_ID"]     = $row->prt_id;
      $temp["KEG_OPD_ID"]     = $row->opd_id;
      $temp["KEG_SUB_OPD_ID"]   = $row->sub_opd_id;
      $temp["KEG_BIDANG_OPD_ID"]   = $row->bidang_opd_id;
      $temp["KEG_URS_ID"]     = $row->urs_id;
      $temp["KEG_BID_URS_ID"]   = $row->bid_urs_id;
      $temp["KEG_PROG_ID"]     = $row->prog_id;
      $temp["KEG_PRG_FULL"]     = $row->prg_full;
      $temp["KEG_KEG_KODE"]     = $row->keg_kode;
      $temp["KEG_KEG_ID"]     = $row->keg_id;
      $temp["KEG_KEG_FULL"]     = $row->keg_full;
      $temp["KEG_DESKRIPSI"]     = $row->deskripsi;
      $temp["KEG_REFR_PROG"]     = $row->refr_prog;
      $temp["KEG_TARGET_AKHIR_PAGU_KEGIATAN"]   = $row->target_akhir_pagu_kegiatan;
      $temp["KEG_TARGET_PAGU_KEG_TAHUN1"]     = $row->target_pagu_keg_tahun1;
      $temp["KEG_TARGET_PAGU_KEG_TAHUN2"]     = $row->target_pagu_keg_tahun2;
      $temp["KEG_TARGET_PAGU_KEG_TAHUN3"]     = $row->target_pagu_keg_tahun3;
      $temp["KEG_TARGET_PAGU_KEG_TAHUN4"]     = $row->target_pagu_keg_tahun4;
      $temp["KEG_TARGET_PAGU_KEG_TAHUN5"]     = $row->target_pagu_keg_tahun5;
      $temp["KEG_P_TARGET_AKHIR_PAGU_KEGIATAN"]   = $row->p_target_akhir_pagu_kegiatan;
      $temp["KEG_P_TARGET_PAGU_KEG_TAHUN1"]     = $row->p_target_pagu_keg_tahun1;
      $temp["KEG_P_TARGET_PAGU_KEG_TAHUN2"]     = $row->p_target_pagu_keg_tahun2;
      $temp["KEG_P_TARGET_PAGU_KEG_TAHUN3"]     = $row->p_target_pagu_keg_tahun3;
      $temp["KEG_P_TARGET_PAGU_KEG_TAHUN4"]     = $row->p_target_pagu_keg_tahun4;
      $temp["KEG_P_TARGET_PAGU_KEG_TAHUN5"]     = $row->p_target_pagu_keg_tahun5;
      $temp["KEG_STATUS_RENSTRA"]         = $row->status_renstra;
      $temp["KEG_P_STATUS_RENSTRA"]         = $row->p_status_renstra;
      $temp["KEG_CATATAN_REJECT"]         = $row->catatan_reject;
      $temp["KEG_PROSES_RENSTRA"]         = $row->proses_renstra;
      $temp["KEG_PROSES_P_RENSTRA"]         = $row->proses_p_renstra;

      $temp["KEG_KODE_LENGKAP"]  = $row->urs_id . "." . $row->bid_urs_id . "." . $row->prog_id . "." . $row->keg_kode . "." . $row->keg_id;

      $data_table[] = $temp;
    }

    // echoing JSON response output
    header('Content-type: application/json');
    echo json_encode($data_table);
  } else {
    // no record found
  }
} elseif ($lvl == "subkegiatan") {

  // get data
  // $sql 		= "SELECT * FROM kegiatan_jangka_menengah WHERE PRT_ID=1";
  $sql     = "SELECT * FROM subkegiatan_jangka_menengah WHERE PRT_ID=" . $rowid;
  $result = bmysqli_query($conn, $sql);
  // num rows
  $numrows = bmysqli_num_rows($result);
  if ($numrows > 0) {
    // data
    $temp       = array();
    $data_table    = array();

    for ($i = 0; $i < $numrows; $i++) {
      $row = bmysqli_fetch_object($result);
      $temp["SUBKEG_NO"]                 = $i + 1;
      $temp["SUBKEG_ROW_ID"]               = $row->row_id;
      $temp["SUBKEG_PRT_ID"]               = $row->prt_id;
      $temp["SUBKEG_PRTPRT_ID"]            = $row->prtprt_id;
      $temp["SUBKEG_OPD_ID"]               = $row->opd_id;
      $temp["SUBKEG_SUB_OPD_ID"]             = $row->sub_opd_id;
      $temp["SUBKEG_BIDANG_OPD_ID"]           = $row->bidang_opd_id;
      $temp["SUBKEG_URS_ID"]               = $row->urs_id;
      $temp["SUBKEG_BID_URS_ID"]             = $row->bid_urs_id;
      $temp["SUBKEG_PROG_ID"]             = $row->prog_id;
      $temp["SUBKEG_PRG_FULL"]             = $row->prg_full;
      $temp["SUBKEG_KEG_KODE"]             = $row->keg_kode;
      $temp["SUBKEG_KEG_ID"]               = $row->keg_id;
      $temp["SUBKEG_KEG_FULL"]             = $row->keg_full;
      $temp["SUBKEG_SUBKEG_ID"]            = $row->subkeg_id;
      $temp["SUBKEG_SUBKEG_FULL"]            = $row->subkeg_full;
      $temp["SUBKEG_DESKRIPSI"]             = $row->deskripsi;
      $temp["SUBKEG_REFR_PROG"]             = $row->refr_prog;
      $temp["SUBKEG_TARGET_AKHIR_PAGU_SUBKEGIATAN"]   = $row->target_akhir_pagu_subkegiatan;
      $temp["SUBKEG_TARGET_PAGU_SUBKEG_TAHUN1"]     = $row->target_pagu_subkeg_tahun1;
      $temp["SUBKEG_TARGET_PAGU_SUBKEG_TAHUN2"]     = $row->target_pagu_subkeg_tahun2;
      $temp["SUBKEG_TARGET_PAGU_SUBKEG_TAHUN3"]     = $row->target_pagu_subkeg_tahun3;
      $temp["SUBKEG_TARGET_PAGU_SUBKEG_TAHUN4"]     = $row->target_pagu_subkeg_tahun4;
      $temp["SUBKEG_TARGET_PAGU_SUBKEG_TAHUN5"]     = $row->target_pagu_subkeg_tahun5;
      $temp["SUBKEG_P_TARGET_AKHIR_PAGU_KEGIATAN"]   = $row->p_target_akhir_pagu_subkegiatan;
      $temp["SUBKEG_P_TARGET_PAGU_SUBKEG_TAHUN1"]   = $row->p_target_pagu_subkeg_tahun1;
      $temp["SUBKEG_P_TARGET_PAGU_SUBKEG_TAHUN2"]   = $row->p_target_pagu_subkeg_tahun2;
      $temp["SUBKEG_P_TARGET_PAGU_SUBKEG_TAHUN3"]   = $row->p_target_pagu_subkeg_tahun3;
      $temp["SUBKEG_P_TARGET_PAGU_SUBKEG_TAHUN4"]   = $row->p_target_pagu_subkeg_tahun4;
      $temp["SUBKEG_P_TARGET_PAGU_SUBKEG_TAHUN5"]   = $row->p_target_pagu_subkeg_tahun5;
      $temp["SUBKEG_STATUS_RENSTRA"]           = $row->status_renstra;
      $temp["SUBKEG_P_STATUS_RENSTRA"]         = $row->p_status_renstra;
      $temp["SUBKEG_CATATAN_REJECT"]           = $row->catatan_reject;
      $temp["SUBKEG_PROSES_RENSTRA"]           = $row->proses_renstra;
      $temp["SUBKEG_PROSES_P_RENSTRA"]         = $row->proses_p_renstra;

      $temp["SUBKEG_KODE_LENGKAP"]  = $row->urs_id . "." . $row->bid_urs_id . "." . $row->prog_id . "." . $row->keg_kode . "." . $row->keg_id . "." . $row->subkeg_id;

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

} elseif ($lvl == "indiprog") {
  $sql     = "SELECT * FROM indikator_program_jangka_menengah WHERE PRT_ID=" . $rowid;
  $result = bmysqli_query($conn, $sql);
  // num rows
  $numrows = bmysqli_num_rows($result);
  if ($numrows > 0) {
    // data
    $temp       = array();
    $data_table    = array();

    for ($i = 0; $i < $numrows; $i++) {
      $row = bmysqli_fetch_object($result);
      $temp["INDIPROG_NO"]                 = $i + 1;
      $temp["INDIPROG_ROW_ID"]               = $row->row_id;
      $temp["INDIPROG_PRT_ID"]               = $row->prt_id;
      $temp["INDIPROG_OPD_ID"]               = $row->opd_id;
      $temp["INDIPROG_SUB_OPD_ID"]             = $row->sub_opd_id;
      $temp["INDIPROG_URS_ID"]               = $row->urs_id;
      $temp["INDIPROG_BID_URS_ID"]             = $row->bid_urs_id;
      $temp["INDIPROG_PROG_ID"]               = $row->prog_id;
      $temp["INDIPROG_PRG_FULL"]               = $row->prg_full;
      $temp["INDIPROG_INDIKATOR_PROGRAM"]     = $row->Indikator_program;
      $temp["INDIPROG_SATUAN_INDIKATOR_PROGRAM"] = $row->satuan_indikator_program;
      $temp["INDIPROG_KINERJA_AWAL_PROGRAM"]        = $row->kinerja_awal_program;
      $temp["INDIPROG_TARGET_AKHIR_KINERJA_PROGRAM"]     = $row->target_akhir_kinerja_program;
      $temp["INDIPROG_TARGET_KINERJA_PROG_TAHUN1"]     = $row->target_kinerja_prog_tahun1;
      $temp["INDIPROG_TARGET_KINERJA_PROG_TAHUN2"]     = $row->target_kinerja_prog_tahun2;
      $temp["INDIPROG_TARGET_KINERJA_PROG_TAHUN3"]     = $row->target_kinerja_prog_tahun3;
      $temp["INDIPROG_TARGET_KINERJA_PROG_TAHUN4"]     = $row->target_kinerja_prog_tahun4;
      $temp["INDIPROG_TARGET_KINERJA_PROG_TAHUN5"]     = $row->target_kinerja_prog_tahun5;
      $temp["INDIPROG_P_TARGET_AKHIR_KINERJA_PROGRAM"]   = $row->p_target_akhir_kinerja_program;
      $temp["INDIPROG_P_TARGET_KINERJA_PROG_TAHUN1"]     = $row->p_target_kinerja_prog_tahun1;
      $temp["INDIPROG_P_TARGET_KINERJA_PROG_TAHUN2"]     = $row->p_target_kinerja_prog_tahun2;
      $temp["INDIPROG_P_TARGET_KINERJA_PROG_TAHUN3"]     = $row->p_target_kinerja_prog_tahun3;
      $temp["INDIPROG_P_TARGET_KINERJA_PROG_TAHUN4"]     = $row->p_target_kinerja_prog_tahun4;
      $temp["INDIPROG_P_TARGET_KINERJA_PROG_TAHUN5"]     = $row->p_target_kinerja_prog_tahun5;
      $temp["INDIPROG_CATATAN_REJECT"]           = $row->catatan_reject;
      $temp["INDIPROG_PROSES_RENSTRA"]           = $row->proses_renstra;
      $temp["INDIPROG_P_PROSES_RENSTRA"]           = $row->p_proses_renstra;
      $temp["INDIPROG_STATUS_RENSTRA"]           = $row->status_renstra;
      $temp["INDIPROG_P_STATUS_RENSTRA"]           = $row->p_status_renstra;

      // $temp["SUBKEG_KODE_LENGKAP"]	= $row->urs_id.".".$row->bid_urs_id.".".$row->prog_id.".".$row->keg_kode.".".$row->keg_id.".".$row->subkeg_id;

      $data_table[] = $temp;
    }

    // echoing JSON response output
    header('Content-type: application/json');
    echo json_encode($data_table);
  } else {
    // no record found
  }
} elseif ($lvl == "indikeg") {
  $sql     = "SELECT * FROM indikator_kegiatan_jangka_menengah WHERE PRT_ID=" . $rowid;
  $result = bmysqli_query($conn, $sql);
  // num rows
  $numrows = bmysqli_num_rows($result);
  if ($numrows > 0) {
    // data
    $temp       = array();
    $data_table    = array();

    for ($i = 0; $i < $numrows; $i++) {
      $row = bmysqli_fetch_object($result);
      $temp["INDIKEG_NO"]                 = $i + 1;
      $temp["INDIKEG_ROW_ID"]               = $row->row_id;
      $temp["INDIKEG_PRT_ID"]               = $row->prt_id;
      $temp["INDIKEG_OPD_ID"]               = $row->opd_id;
      $temp["INDIKEG_SUB_OPD_ID"]             = $row->sub_opd_id;
      $temp["INDIKEG_URS_ID"]               = $row->urs_id;
      $temp["INDIKEG_BID_URS_ID"]             = $row->bid_urs_id;
      $temp["INDIKEG_PROG_ID"]               = $row->prog_id;
      $temp["INDIKEG_KEG_KODE"]               = $row->keg_kode;
      $temp["INDIKEG_KEG_ID"]               = $row->keg_id;
      $temp["INDIKEG_PRG_FULL"]               = $row->prg_full;
      $temp["INDIKEG_KEG_FULL"]               = $row->keg_full;
      $temp["INDIKEG_INDIKATOR_KEGIATAN"]         = $row->Indikator_kegiatan;
      $temp["INDIKEG_SATUAN_INDIKATOR_KEGIATAN"]       = $row->satuan_indikator_kegiatan;
      $temp["INDIKEG_KINERJA_AWAL_KEGIATAN"]        = $row->kinerja_awal_kegiatan;
      $temp["INDIKEG_TARGET_AKHIR_KINERJA_KEGIATAN"]     = $row->target_akhir_kinerja_kegiatan;
      $temp["INDIKEG_TARGET_KINERJA_KEG_TAHUN1"]       = $row->target_kinerja_keg_tahun1;
      $temp["INDIKEG_TARGET_KINERJA_KEG_TAHUN2"]       = $row->target_kinerja_keg_tahun2;
      $temp["INDIKEG_TARGET_KINERJA_KEG_TAHUN3"]       = $row->target_kinerja_keg_tahun3;
      $temp["INDIKEG_TARGET_KINERJA_KEG_TAHUN4"]       = $row->target_kinerja_keg_tahun4;
      $temp["INDIKEG_TARGET_KINERJA_KEG_TAHUN5"]       = $row->target_kinerja_keg_tahun5;
      $temp["INDIKEG_P_TARGET_AKHIR_KINERJA_KEGIATAN"]   = $row->p_target_akhir_kinerja_kegiatan;
      $temp["INDIKEG_P_TARGET_KINERJA_KEG_TAHUN1"]     = $row->p_target_kinerja_keg_tahun1;
      $temp["INDIKEG_P_TARGET_KINERJA_KEG_TAHUN2"]     = $row->p_target_kinerja_keg_tahun2;
      $temp["INDIKEG_P_TARGET_KINERJA_KEG_TAHUN3"]     = $row->p_target_kinerja_keg_tahun3;
      $temp["INDIKEG_P_TARGET_KINERJA_KEG_TAHUN4"]     = $row->p_target_kinerja_keg_tahun4;
      $temp["INDIKEG_P_TARGET_KINERJA_KEG_TAHUN5"]     = $row->p_target_kinerja_keg_tahun5;
      $temp["INDIKEG_CATATAN_REJECT"]           = $row->catatan_reject;
      $temp["INDIKEG_PROSES_RENSTRA"]           = $row->proses_renstra;
      $temp["INDIKEG_P_PROSES_RENSTRA"]           = $row->p_proses_renstra;
      $temp["INDIKEG_STATUS_RENSTRA"]           = $row->status_renstra;
      $temp["INDIKEG_P_STATUS_RENSTRA"]           = $row->p_status_renstra;

      // $temp["SUBKEG_KODE_LENGKAP"]	= $row->urs_id.".".$row->bid_urs_id.".".$row->prog_id.".".$row->keg_kode.".".$row->keg_id.".".$row->subkeg_id;

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

} elseif ($lvl == "indisubkeg") {
  $sql     = "SELECT * FROM indikator_subkegiatan_jangka_menengah WHERE PRT_ID=" . $rowid;
  $result = bmysqli_query($conn, $sql);
  // num rows
  $numrows = bmysqli_num_rows($result);
  if ($numrows > 0) {
    // data
    $temp       = array();
    $data_table    = array();

    for ($i = 0; $i < $numrows; $i++) {
      $row = bmysqli_fetch_object($result);
      $temp["INDISUBKEG_NO"]                 = $i + 1;
      $temp["INDISUBKEG_ROW_ID"]               = $row->row_id;
      $temp["INDISUBKEG_PRT_ID"]               = $row->prt_id;
      $temp["INDISUBKEG_OPD_ID"]               = $row->opd_id;
      $temp["INDISUBKEG_SUB_OPD_ID"]             = $row->sub_opd_id;
      $temp["INDISUBKEG_URS_ID"]               = $row->urs_id;
      $temp["INDISUBKEG_BID_URS_ID"]             = $row->bid_urs_id;
      $temp["INDISUBKEG_PROG_ID"]             = $row->prog_id;
      $temp["INDISUBKEG_KEG_KODE"]             = $row->keg_kode;
      $temp["INDISUBKEG_KEG_ID"]               = $row->keg_id;
      $temp["INDISUBKEG_SUBKEG_ID"]             = $row->subkeg_id;
      $temp["INDISUBKEG_PRG_FULL"]             = $row->prg_full;
      $temp["INDISUBKEG_KEG_FULL"]             = $row->keg_full;
      $temp["INDISUBKEG_SUBKEG_FULL"]           = $row->subkeg_full;
      $temp["INDISUBKEG_INDIKATOR_SUBKEGIATAN"]       = $row->Indikator_subkegiatan;
      $temp["INDISUBKEG_SATUAN_INDIKATOR_SUBKEGIATAN"]  = $row->satuan_indikator_subkegiatan;
      $temp["INDISUBKEG_KINERJA_AWAL_SUBKEGIATAN"]    = $row->kinerja_awal_subkegiatan;
      $temp["INDISUBKEG_TARGET_AKHIR_KINERJA_SUBKEGIATAN"]   = $row->target_akhir_kinerja_subkegiatan;
      $temp["INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN1"]     = $row->target_kinerja_subkeg_tahun1;
      $temp["INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN2"]     = $row->target_kinerja_subkeg_tahun2;
      $temp["INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN3"]     = $row->target_kinerja_subkeg_tahun3;
      $temp["INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN4"]     = $row->target_kinerja_subkeg_tahun4;
      $temp["INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN5"]     = $row->target_kinerja_subkeg_tahun5;
      $temp["INDISUBKEG_P_TARGET_AKHIR_KINERJA_SUBKEGIATAN"]  = $row->p_target_akhir_kinerja_subkegiatan;
      $temp["INDISUBKEG_P_TARGET_KINERJA_SUBKEG_TAHUN1"]   = $row->p_target_kinerja_subkeg_tahun1;
      $temp["INDISUBKEG_P_TARGET_KINERJA_SUBKEG_TAHUN2"]   = $row->p_target_kinerja_subkeg_tahun2;
      $temp["INDISUBKEG_P_TARGET_KINERJA_SUBKEG_TAHUN3"]   = $row->p_target_kinerja_subkeg_tahun3;
      $temp["INDISUBKEG_P_TARGET_KINERJA_SUBKEG_TAHUN4"]   = $row->p_target_kinerja_subkeg_tahun4;
      $temp["INDISUBKEG_P_TARGET_KINERJA_SUBKEG_TAHUN5"]   = $row->p_target_kinerja_subkeg_tahun5;
      $temp["INDISUBKEG_CATATAN_REJECT"]           = $row->catatan_reject;
      $temp["INDISUBKEG_PROSES_RENSTRA"]           = $row->proses_renstra;
      $temp["INDISUBKEG_P_PROSES_RENSTRA"]         = $row->p_proses_renstra;
      $temp["INDISUBKEG_STATUS_RENSTRA"]           = $row->status_renstra;
      $temp["INDISUBKEG_P_STATUS_RENSTRA"]         = $row->p_status_renstra;

      // $temp["SUBKEG_KODE_LENGKAP"]	= $row->urs_id.".".$row->bid_urs_id.".".$row->prog_id.".".$row->keg_kode.".".$row->keg_id.".".$row->subkeg_id;

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






// if ($numrows > 0) {
// 	// data
// 	$data 			= array();
// 	$data_table = array();
	
// 	for ($i=0; $i<$numrows; $i++) {
// 		$row = mysql_fetch_object($result);	
				
// 		$data["ROW_ID"] 								= $row->row_id;
// 		$data["PRT_ID"] 								= $row->prt_id;
// 		$data["NO"] 									= $i+1;
// 		$data["BIDANG_OPD_ID"] 							= $row->bidang_opd_id;
// 		$data["NAMA_BIDANG"] 							= $row->nama_bidang;
// 		$data["OPD_ID"] 								= $row->opd_id;
// 		$data["SUB_OPD_ID"] 							= $row->sub_opd_id;
				
// 		$data_table[] = $data;
// 	}
	
// 	// echoing JSON response output
// 	header('Content-type: application/json');
// 	echo json_encode($data_table);
	
// } else {
// 	// no record found
// }
