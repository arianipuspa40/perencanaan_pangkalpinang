<?php
session_start();
$temp_session  = array();
$tes["status"] = "success";
if (isset($_SESSION["USER_SETTING"]["LOGIN"])) {
  $temp_session["SESSION"]         = $_SESSION["USER_SETTING"];
  // connecting to db
  require_once("dbconn.php");

  //user admin super, admin opd, user bidang (disini tidak diperlukan karena get data berdasarkan id parent)
  //  parameter opd/sub opd
  // $param_opd ="";
  // $param_opd 	= "10122200002";
  // $prgfull	= $_GET['prgfull'];
  // $param1 	= json_decode($_POST['param1']);

  // $sql1 = "SELECT * FROM user";
  $sql1 = "SELECT * FROM user";


  // $result = mysql_query($sql1);
  $result = bmysqli_query($conn, $sql1);
  // num rows
  $numrows = bmysqli_num_rows($result);
  // $row = bmysqli_fetch_object($result);
  // echo($numrows);
  // echo "ini combo";
  // echo $sql1;

  if ($numrows > 0) {
    // data
    $data         = array();
    $data_table = array();

    for ($i = 0; $i < $numrows; $i++) {
      $row = bmysqli_fetch_object($result);
      $data["NO"]                                    = $i + 1;
      $data["row_id"]                        = $row->row_id;
      $data["deskripsi"]                        = $row->deskripsi;
      $data["pegawai_id"]                        = $row->pegawai_id;
      $data["opd_id"]                        = $row->opd_id;
      $data["jenis_akun"]                        = $row->jenis_akun;
      $data["sub_opd_id"]                        = $row->sub_opd_id;
      $data["bidang_id"]                        = $row->bidang_id;
      // $data["password"]                        = $row->password;
      $data["user"]                        = $row->user;
      $data["hak_akses"]                        = $row->hak_akses;
      $data_table[] = $data;
    }
    header('Content-type: application/json');
    echo json_encode($data_table);
  } else {
    // no record found
    $tes["Proses"] = "Ada error";
    echo json_encode($tes);
  }
} else {
  $tes["status"] = "bermasalah";
  echo json_encode($tes);
}
// var_dump($data_table);

// $tes["status"] = "success ".$prgfull;
// // echo $tes;
	// echo json_encode($param1);
