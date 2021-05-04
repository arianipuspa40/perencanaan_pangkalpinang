<?php
session_start();
$temp_session             = array();
if (isset($_SESSION["USER_SETTING"]["LOGIN"])) {
  $temp_session["SESSION"]     = $_SESSION["USER_SETTING"];
  // connecting to db
  require_once("dbconn.php");

  //  parameter opd/sub opd
  $param_sub_opd = $temp_session["SESSION"]["SUB_OPD_ID"];


  // post data
  $SASARAN_PD_TXT         = trim($_GET['SASARAN_PD_TXT']);
  $OPD_TXT             = trim($_GET['OPD_TXT']);
  $SUB_OPD_TXT           = $_GET['SUB_OPD_TXT'];
  $DESKRIPSI_TXT           = trim($_GET['DESKRIPSI_TXT']);
  $STATUS_RENSTRA_TXT       = $_GET['STATUS_RENSTRA_TXT'];

  // $SASARAN_PD_TXT 				= "";
  // $OPD_TXT 						= "";
  // $SUB_OPD_TXT 					= "";
  // $DESKRIPSI_TXT 					= "";
  // $STATUS_RENSTRA_TXT 			= "";

  // $where = ""; $from = 0; $perp = 10; 		$mode = "pagingx";
  $where = "";
  $from = 0;
  $perp = 10;
  $from = $_GET['from'];
  $mode = $_GET['mode'];

  if (trim($temp_session["SESSION"]["JENIS_AKUN"]) == 5) {
    $where = "";
  } else {
    $where .= " sub_opd_id='" . $param_sub_opd . "'   AND ";
  }

  if ($SASARAN_PD_TXT <> "") {
    $where .= " sasaran_pd_id LIKE '%" . $SASARAN_PD_TXT . "%'  AND ";
  }
  if ($OPD_TXT <> "") {
    $where .= " opd_id LIKE '%" . $OPD_TXT . "%'  AND ";
  }
  if ($SUB_OPD_TXT <> "") {
    $where .= " sub_opd_id LIKE '%" . $SUB_OPD_TXT . "%'  AND ";
  }
  if ($DESKRIPSI_TXT <> "") {
    $where .= " deskripsi LIKE '%" . $DESKRIPSI_TXT . "%'  AND ";
  }
  if ($STATUS_RENSTRA_TXT <> "") {
    $where .= " status_renstra LIKE '%" . $STATUS_RENSTRA_TXT . "%'  AND ";
  }
  $where = substr($where, 0, strlen($where) - 4);
  if ($where == "") {
    $where = " row_id LIKE '%' ";
  }


  if ($mode == "paging") {
    // get data
    $sql = "SELECT COUNT(row_id) AS numr FROM program_jangka_menengah WHERE " . $where;

    // $result = mysql_query($sql);
    $result = bmysqli_query($conn, $sql);
    $numr = 0;
    while ($row = bmysqli_fetch_object($result)) {
      $numr = $row->numr;
    }
    $page = ceil($numr / $perp);
    bmysqli_free_result($result);

    $data = array();
    $data["status"] = "success";
    $data["numr"]   = $numr;
    $data["page"]   = $page;
    $data["perp"]   = $perp;
    $data["where"] = $where;

    // echoing JSON response output
    header('Content-type: application/json');
    echo json_encode($data);
  } else {
    // get data
    // $sql 		= "SELECT * FROM program_jangka_menengah";
    $sql     = "SELECT * FROM program_jangka_menengah WHERE " . $where . " ORDER BY prg_full LIMIT " . $from . "," . $perp;
    // $sql 		= "SELECT * FROM program_jangka_menengah WHERE sub_opd_id=".$param_sub_opd." and ".$where." ORDER BY prg_full,row_id LIMIT ".$from.",".$perp;	
    // $result     = mysql_query($sql);
    $result = bmysqli_query($conn, $sql);

    // num rows
    // $numrows = mysql_num_rows($result);
    $numrows = bmysqli_num_rows($result);

    if ($numrows > 0) {
      // data
      $data     = array();
      $data_opd  = array();
      $data_table = array();

      for ($i = 0; $i < $numrows; $i++) {
        // $row = mysql_fetch_object($result);
        $row = bmysqli_fetch_object($result);

        $no                   = $i + 1 + $from;
        $data["ROW_ID"]       = $row->row_id;
        $data["NO"]           = $no;
        $data["SASARAN_DAERAH_ID"] = $row->sasaran_daerah_id;
        $data["SASARAN_PD_ID"]    = $row->sasaran_pd_id;
        $data["TUJUAN_PD_ID"]     = $row->tujuan_pd_id;
        $data["OPD_ID"]           = $row->opd_id;
        $data["SUB_OPD_ID"]       = $row->sub_opd_id;
        $data["BIDANG_OPD_ID"]    = $row->bidang_opd_id;
        $data["URS_ID"]           = $row->urs_id;
        $data["BID_URS_ID"]       = $row->bid_urs_id;
        $data["PROG_ID"]          = $row->prog_id;
        $data["PRG_FULL"]         = $row->prg_full;
        $data["DESKRIPSI"]        = $row->deskripsi;
        $data["REFR_PROG"]        = $row->refr_prog;
        $data["TARGET_AKHIR_PAGU_PROGRAM"] = $row->target_akhir_pagu_program;
        $data["TARGET_PAGU_PROG_TAHUN1"]  = $row->target_pagu_prog_tahun1;
        $data["TARGET_PAGU_PROG_TAHUN2"]  = $row->target_pagu_prog_tahun2;
        $data["TARGET_PAGU_PROG_TAHUN3"]  = $row->target_pagu_prog_tahun3;
        $data["TARGET_PAGU_PROG_TAHUN4"]  = $row->target_pagu_prog_tahun4;
        $data["TARGET_PAGU_PROG_TAHUN5"]  = $row->target_pagu_prog_tahun5;
        $data["STATUS_RENSTRA"]           = $row->status_renstra;
        $data["P_TARGET_AKHIR_PAGU_PROGRAM"] = $row->p_target_akhir_pagu_program;
        $data["P_TARGET_PAGU_PROG_TAHUN1"]  = $row->p_target_pagu_prog_tahun1;
        $data["P_TARGET_PAGU_PROG_TAHUN2"]  = $row->p_target_pagu_prog_tahun2;
        $data["P_TARGET_PAGU_PROG_TAHUN3"]  = $row->p_target_pagu_prog_tahun3;
        $data["P_TARGET_PAGU_PROG_TAHUN4"]  = $row->p_target_pagu_prog_tahun4;
        $data["P_TARGET_PAGU_PROG_TAHUN5"]  = $row->p_target_pagu_prog_tahun5;
        $data["P_STATUS_RENSTRA"]           = $row->p_status_renstra;
        $data["CATATAN_REJECT"]             = $row->catatan_reject;
        $data["PROSES_RENSTRA"]             = $row->proses_renstra;
        $data["PROSES_P_RENSTRA"]           = $row->proses_p_renstra;

        $data["KODE_PROGRAM_LENGKAP"]       = $row->urs_id . "." . $row->bid_urs_id . "." . $row->prog_id;
        $data["NAMA_OPD"]                   = "NAME";
        // tambah deskripsi opd
        // if ($data_opd["hallo" == null){
        // 	$data["NAMA_OPD"]	= "NAMA";
        // }else{
        // 	$data["NAMA_OPD"]	= "NAMi";
        // }


        $sql2     = "SELECT * FROM opd WHERE sub_opd_id='" . $row->sub_opd_id . "'";
        $result2 = bmysqli_query($conn, $sql2);
        $numrows2 = bmysqli_num_rows($result2);
        if ($numrows2 == 1) {
          $row2 = bmysqli_fetch_object($result2);
          $data["NAMA_OPD"] = $row2->deskripsi_opd;
        } else {
          // $row2 = bmysqli_fetch_object($result2);
          // $data["NAMA_OPD"] = "- ".$numrows2;
          $data["NAMA_OPD"] = "";
        }

        $data_table[] = $data;
      }

      // echoing JSON response output
      header('Content-type: application/json');
      echo json_encode($data_table);
    }
  }
} else {
  // header("location:index.php");
  $data = array();
  $data["status"] = "bermasalah";
  // echoing JSON response output
  header('Content-type: application/json');
  echo json_encode($data);
}
