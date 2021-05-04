<?php
session_start();
$temp_session = array();

$tes["status"] = "success";
if (isset($_SESSION["USER_SETTING"]["LOGIN"])) {
  $temp_session["SESSION"]         = $_SESSION["USER_SETTING"];
  // connecting to db
  require_once("dbconn.php");


  $sql    = "";
  $sqltes    = "";
  $action = $_GET['action'];
  $lvl    = $_GET['lvl'];
  $param1 = json_decode($_POST['param1']);
  $tes["action"] = $action;

  if ($lvl == "EDIT_USER") {
    // $tes["status"] = "edit user";
    if ($action == "add") {
      // $tes["status"] = "add user";
      // $tes["status"] = "tujuan add ".$temp_session["SESSION"]["OPD_ID"]." SUB OPD".$temp_session["SESSION"]["SUB_OPD_ID"];
      $sql = "INSERT INTO user SET ";
      // $sql .= " ";
      $sql .= "row_id='" . " " . "',";
      $sql .= "user='" . $param1->user . "',";
      $sql .= "password='" . password_hash($param1->password, PASSWORD_DEFAULT) . "',";
      $sql .= "pegawai_id='" . "0" . "',";
      $sql .= "jenis_akun='" . "0" . "',";
      $sql .= "hak_akses='" . $param1->hak_akses . "',";
      $sql .= "opd_id='" . $param1->opd_id . "',";
      $sql .= "sub_opd_id='" . $param1->sub_opd_id . "',";
      $sql .= "bidang_id='" . "0" . "',";
      $sql .= "deskripsi='" . $param1->deskripsi . "'";

      // $tes["status"] = $sql;

      // belum benerrrr synatx insert tiru yang asli
      $result     = bmysqli_query($conn, $sql);
      $num_result    = bmysqli_affected_rows($conn);    // Returns the number of affected rows on success, and -1 if the last query failed						
      if ($num_result == 0) {
        $tes["status"] = "Tambah Tujuan Berhasil";
      }
      // var_dump($sql);
    } elseif ($action == "edit") {
      $sql = "UPDATE user SET";
      $sql .= " ";
      $sql .= "user='" . $param1->user . "',";
      $sql .= "opd_id='" . $param1->opd_id . "',";
      $sql .= "deskripsi='" . $param1->deskripsi . "',";
      $sql .= "hak_akses='" . $param1->hak_akses . "'";
      $sql .= "WHERE row_id='" . $param1->row_id . "'";

      // $tes["status"] = $sql;
      $result     = bmysqli_query($conn, $sql);
      $num_result    = bmysqli_affected_rows($conn);    // Returns the number of affected rows on success, and -1 if the last query failed


    } elseif ($action == "editPassword") {

      // $tes["status"] = $param1->password1  ==  $param1->password2;
      if ($param1->password1 == $param1->password2) {
        // $sql = $param1->row_id;
        $sql = "UPDATE user SET";
        $sql .= " ";
        $sql .= "password='" . password_hash($param1->password1, PASSWORD_DEFAULT) . "'";
        $sql .= "WHERE row_id='" . $param1->row_id . "'";

        $result     = bmysqli_query($conn, $sql);
        $num_result    = bmysqli_affected_rows($conn);
        // Returns the number of affected rows on success, and -1 if the last query failed
        $tes["status"] = "success";
      } else {
        $tes["status"] = "invalid password";
      }
    } elseif ($action == "delete") {
      // $tes["status"] = "tujuan delete";
      $sql = "DELETE FROM user WHERE row_id = $param1->row_id";
      // $tes["status"] = $sql;
      // $tes["sqltes"] = $sqltes;
      // $result		= mysql_query($sqltes);			// True/Resource on success, False on error
      $result = bmysqli_query($conn, $sql);
      $num_result = bmysqli_affected_rows($conn);
    }
  }
} else {
  $tes["status"] = "bermasalah";
}


// // echo $tes;
echo json_encode($tes);
