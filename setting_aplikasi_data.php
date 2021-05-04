<?php

require_once("dbconn.php");

$sql2     = "SELECT * FROM setting_aplikasi2";
$result2 = bmysqli_query($conn, $sql2);
$numrows2 = bmysqli_num_rows($result2);


$active_data   = "SELECT * FROM setting_aplikasi2 WHERE is_active = 1";
$result = bmysqli_query($conn, $active_data);
$row2 = mysqli_fetch_assoc($result);

// $row = bmysqli_query()
// $set_app['data'] = json_encode($result2);
// echo json_encode($row['img_login']);
// var_dump($row);
// var_dump($row);
// $data["set_ap"] = $row;


// echo '<img src="img/logo_42.png">';
// var_dump($numrows2);

for ($i = 0; $i < $numrows2; $i++) {
    $row = bmysqli_fetch_object($result2);
    $data['row_id'] = $row->row_id;
    $data['nama_kota'] = $row->nama_kota;
    $data['img_login'] = $row->img_login;
    $data['img_toolbar'] = $row->img_toolbar;
    $data['is_active'] = $row->is_active;

    // $data dll dll
    // $data dll dll
    // $data dll dll
    $data_table[] = $data;
}

echo json_encode($data_table);
// echo json_encode($row2);
// echo json_encode($data_table);
