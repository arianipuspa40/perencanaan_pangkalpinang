<?php
session_start();
$temp_session             = array();

$tes["status"] = "success";
if (isset($_SESSION["USER_SETTING"]["LOGIN"])) {
  $temp_session["SESSION"]     = $_SESSION["USER_SETTING"];
  // connecting to db
  require_once("dbconn.php");


  $sql  = "";
  $sqltes  = "";
  $action = $_GET['action'];
  $lvl  = $_GET['lvl'];
  $param1 = json_decode($_POST['param1']);
  $tes["action"] = $action;

  if ($lvl == "tujuan") {
    // $tes["status"] = "tujuan";
    if ($action == "add") {
      // $tes["status"] = "tujuan add ".$temp_session["SESSION"]["OPD_ID"]." SUB OPD".$temp_session["SESSION"]["SUB_OPD_ID"];
      $sql = "INSERT INTO tujuan_perangkat_daerah SET";
      $sql .= " ";
      $sql .= "opd_id='" . $temp_session["SESSION"]["OPD_ID"] . "',";
      $sql .= "sub_opd_id='" . $temp_session["SESSION"]["SUB_OPD_ID"] . "',";
      $sql .= "tujuan_pd='" . $param1->ADD_TUJUAN . "'";
      // $tes["status"] = $sql;
      $result   = bmysqli_query($conn, $sql);
      $num_result  = bmysqli_affected_rows($conn);  // Returns the number of affected rows on success, and -1 if the last query failed						
      if ($num_result == 0) {
        $tes["status"] = "Tambah Tujuan Berhasil";
      }
    } elseif ($action == "edit") {
      // $tes["status"] = "tujuan edit";
      $sql = "UPDATE tujuan_perangkat_daerah SET";
      $sql .= " ";
      $sql .= "tujuan_pd='" . $param1->TUJUAN_DESKRIPSI . "'";
      $sql .= "WHERE row_id='" . $param1->TUJUAN_ROW_ID . "'";
      $result   = bmysqli_query($conn, $sql);
      $num_result  = bmysqli_affected_rows($conn);  // Returns the number of affected rows on success, and -1 if the last query failed

    } elseif ($action == "delete") {
      // $tes["status"] = "tujuan delete";
      $sql = "SELECT * FROM program_jangka_menengah WHERE tujuan_pd_id=" . $param1->TUJUAN_ROW_ID;
      // $tes["sqltes"] = $sqltes;
      // $result		= mysql_query($sqltes);			// True/Resource on success, False on error
      $result = bmysqli_query($conn, $sql);
      $num_result = bmysqli_affected_rows($conn);  // Returns the number of affected rows on success, and -1 if the last query failed
      if ($num_result == 0) {
        // $tes["status"] = "bisa didelete";
        $sql2     = "DELETE FROM tujuan_perangkat_daerah WHERE row_id=" . $param1->TUJUAN_ROW_ID;
        // $result		= mysql_query($sql);			// True/Resource on success, False on error
        $result2   = bmysqli_query($conn, $sql2);
        $num_result = bmysqli_affected_rows($conn);  // Returns
      } else {
        // $tes["status"] = "Tujuan Digunakan Program ".$num_result;
        $tes["status"] = "Tujuan Sudah Digunakan Program ";
      }
    }
  } elseif ($lvl == "sasaran") {
    if ($action == "add") {
      // $tes["status"] = "sasaran add ".$temp_session["SESSION"]["OPD_ID"]." SUB OPD".$temp_session["SESSION"]["SUB_OPD_ID"];
      $sql = "INSERT INTO sasaran_perangkat_daerah SET";
      $sql .= " ";
      $sql .= "opd_id='" . $temp_session["SESSION"]["OPD_ID"] . "',";
      $sql .= "sub_opd_id='" . $temp_session["SESSION"]["SUB_OPD_ID"] . "',";
      $sql .= "sasaran_pd='" . $param1->ADD_SASARAN . "'";
      // $tes["status"] = $sql;
      $result   = bmysqli_query($conn, $sql);
      $num_result  = bmysqli_affected_rows($conn);  // Returns the number of affected rows on success, and -1 if the last query failed						
      if ($num_result == 0) {
        $tes["status"] = "Tambah Sasaran Berhasil";
      }
    } elseif ($action == "edit") {
      // $tes["status"] = "sasaran edit";
      $sql = "UPDATE sasaran_perangkat_daerah SET";
      $sql .= " ";
      $sql .= "sasaran_pd='" . $param1->SASARAN_DESKRIPSI . "'";
      $sql .= "WHERE row_id='" . $param1->SASARAN_ROW_ID . "'";
      $result   = bmysqli_query($conn, $sql);
      $num_result  = bmysqli_affected_rows($conn);  // Returns the number of affected rows on success, and -1 if the last query failed

    } elseif ($action == "delete") {
      // $tes["status"] = "sasaran delete";
      $sql = "SELECT * FROM program_jangka_menengah WHERE sasaran_pd_id=" . $param1->SASARAN_ROW_ID;
      // $tes["sqltes"] = $sqltes;
      // $result		= mysql_query($sqltes);			// True/Resource on success, False on error
      $result = bmysqli_query($conn, $sql);
      $num_result = bmysqli_affected_rows($conn);  // Returns the number of affected rows on success, and -1 if the last query failed
      if ($num_result == 0) {
        // $tes["status"] = "bisa didelete";
        $sql2     = "DELETE FROM sasaran_perangkat_daerah WHERE row_id=" . $param1->SASARAN_ROW_ID;
        // $result		= mysql_query($sql);			// True/Resource on success, False on error
        $result2   = bmysqli_query($conn, $sql2);
        $num_result = bmysqli_affected_rows($conn);  // Returns
      } else {
        // $tes["status"] = "Sasaran Digunakan Program ".$num_result;
        $tes["status"] = "Sasaran Sudah Digunakan Program ";
      }
    }
  }
} else {
  $tes["status"] = "bermasalah";
}






// // echo $tes;
echo json_encode($tes);
