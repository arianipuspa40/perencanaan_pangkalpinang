<?php
session_start();
$temp_session             = array();

$tes["status"] = "success";
if (isset($_SESSION["USER_SETTING"]["LOGIN"])) {
  $temp_session["SESSION"]     = $_SESSION["USER_SETTING"];
  // connecting to db
  require_once("dbconn.php");
  // echo "Renstra Murni";
  // isset($_GET['action']);
  // $tes3 = json_decode($_POST['param1']);


  $param1 = json_decode($_POST['param1']);
  // jika ada is active true/false maka update selected id sesuai param dan cari di DB is active  = true dan rubah menjadi 0
  // jika ingin menonaktifkan maka tidak bisa(tidak bisa di matikan, aktifkan profile yang lain)
  if ($param1->is_active == 0) {
    $tes["status"] = "forbidden";
    // jika mengaktifkan maka jalankan ini
  } else {
    $sql = "UPDATE setting_aplikasi2 SET ";
    $sql .= "is_active='" . 0 . "'";
    $sql .= "WHERE row_id !='" . $param1->row_id . "'";
    $result = bmysqli_query($conn, $sql);

    $sql = "UPDATE setting_aplikasi2 SET ";
    $sql .= "nama_kota='" . $param1->nama_kota . "',";
    $sql .= "img_login='" . $param1->img_login . "',";
    $sql .= "img_toolbar='" . $param1->img_toolbar . "',";
    $sql .= "is_active='" . $param1->is_active . "'";
    $sql .= "WHERE row_id='" . $param1->row_id . "'";
    $result = bmysqli_query($conn, $sql);
  }
} else {
  // header("location:index.php");
  $data = array();
  $data["status"] = "bermasalah";
  // echoing JSON response output
  header('Content-type: application/json');
  echo json_encode($data);
}

echo json_encode($tes);
