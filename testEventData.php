<?php
session_start();
$temp_session             = array();

$tes["status"] = "success";
if (isset($_SESSION["USER_SETTING"]["LOGIN"])) {
    $temp_session["SESSION"]     = $_SESSION["USER_SETTING"];
    // connecting to db
    require_once("dbconn.php");

    $param1 = $_POST['param1'];
    // $jml = strlen($param1->PRG_FULL);

    $tes["status"] = "status " . "$param1";
} else {
    $tes["status"] = "$param1";
}

// // echo $tes;
echo json_encode($tes);
