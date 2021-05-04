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
        // $tes["status"] = "tujuan";
        if ($action == "add") {
            // $tes["status"] = "tujuan add ".$temp_session["SESSION"]["OPD_ID"]." SUB OPD".$temp_session["SESSION"]["SUB_OPD_ID"];
            $sql = "INSERT INTO user SET";
            $sql .= " ";
            $sql .= "id='" . "" . "'";
            $sql .= "user='" . $param1->user . "'";
            $sql .= "password='" . $param1->password . "'";
            $sql .= "pegawai_id='" . "0" . "'";
            $sql .= "jenis_akun='" . "0" . "'";
            $sql .= "hak_akses='" . $param1->hak_akses . "'";
            $sql .= "opd_id='" . password_hash($param1->opd_id, PASSWORD_DEFAULT) . "'";
            $sql .= "sub_opd_id='" . $param1->sub_opd_id . "'";
            $sql .= "bidang_id='" . "0" . "'";
            $sql .= "deskripsi='" . $param1->deskripsi . "'";

            // $tes["status"] = $sql;
            $result     = bmysqli_query($conn, $sql);
            $num_result    = bmysqli_affected_rows($conn);    // Returns the number of affected rows on success, and -1 if the last query failed						
            if ($num_result == 0) {
                $tes["status"] = "Tambah Tujuan Berhasil";
            }
            // var_dump($sql);
        } elseif ($action == "edit") {
            // $tes["status"] = "tujuan edit";
            $sql = "UPDATE tujuan_perangkat_daerah SET";
            $sql .= " ";
            $sql .= "tujuan_pd='" . $param1->TUJUAN_DESKRIPSI . "'";
            $sql .= "WHERE row_id='" . $param1->TUJUAN_ROW_ID . "'";
            $result     = bmysqli_query($conn, $sql);
            $num_result    = bmysqli_affected_rows($conn);    // Returns the number of affected rows on success, and -1 if the last query failed

        } elseif ($action == "delete") {
            // $tes["status"] = "tujuan delete";
            $sql = "SELECT * FROM program_jangka_menengah WHERE tujuan_pd_id=" . $param1->TUJUAN_ROW_ID;
            // $tes["sqltes"] = $sqltes;
            // $result		= mysql_query($sqltes);			// True/Resource on success, False on error
            $result = bmysqli_query($conn, $sql);
            $num_result = bmysqli_affected_rows($conn);    // Returns the number of affected rows on success, and -1 if the last query failed
            if ($num_result == 0) {
                // $tes["status"] = "bisa didelete";
                $sql2         = "DELETE FROM tujuan_perangkat_daerah WHERE row_id=" . $param1->TUJUAN_ROW_ID;
                // $result		= mysql_query($sql);			// True/Resource on success, False on error
                $result2     = bmysqli_query($conn, $sql2);
                $num_result = bmysqli_affected_rows($conn);    // Returns
            } else {
                // $tes["status"] = "Tujuan Digunakan Program ".$num_result;
                $tes["status"] = "Tujuan Sudah Digunakan Program ";
            }
        }
    }
} else {
    $tes["status"] = "bermasalah";
}






// // echo $tes;
echo json_encode($tes);
