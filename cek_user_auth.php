<?php
// connecting to db

session_start();
$temp_session = array();
$tes["status"] = "valid";

if (isset($_SESSION["USER_SETTING"]["LOGIN"])) {
    $temp_session["SESSION"]         = $_SESSION["USER_SETTING"];
    require("dbconn.php");
    // $lvl  	= $_GET["lvl"];
    // $pin   = $_POST["password"];
    $param1 = json_decode($_POST['param1']);
    $temp  = array();

    $sql1 = "SELECT * FROM user WHERE row_id = '$param1->row_id'";

    $result  = bmysqli_query($conn, $sql1);
    $numrows = bmysqli_num_rows($result);
    $row = bmysqli_fetch_object($result);
    // $cek["hasil"] = $sql1;
    // echo json_encode($cek);

    if (password_verify($param1->password, $row->password)) {
        $tes["status"] = "valid";
        echo json_encode($tes);
    } else {
        $tes["status"] = "invalid";
        echo json_encode($tes);
    }
} else {
    $tes["status"] = "bermasalah";
    echo json_encode($tes);
}
// echo $temp;
// echo "string  rowid: ".$rowid.", rowid2: ".$rowid2;
