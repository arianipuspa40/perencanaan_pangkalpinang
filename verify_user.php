<?php
session_start();
// $_SESSION["hallo_session1"] = "ini session dari tes4"; 

// connecting to db
require("dbconn.php");


// $lvl  	= $_GET["lvl"];
$user  = $_POST["user"];
$pin   = $_POST["pin"];
$temp  = array();

$sql1 = "SELECT * FROM user WHERE user = '" . $user . "'";
$sql2 = "SELECT * FROM setting_aplikasi2 WHERE is_active = 1";

$result2  = bmysqli_query($conn, $sql2);
$result  = bmysqli_query($conn, $sql1);
$numrows = bmysqli_num_rows($result);
if ($numrows == 1) {
	$row = bmysqli_fetch_object($result);
	$row2 = bmysqli_fetch_object($result2);
	// $temp["USER"]		= $row->user;			
	if (password_verify($pin, $row->password)) {
		$temp["PIN"] 		= "verify berhasil";
		$temp["PEGAWAI_ID"] = $row->pegawai_id;
		$temp["JENIS_AKUN"] = $row->jenis_akun;
		$temp["HAK_AKSES"] 	= $row->hak_akses;
		$temp["OPD_ID"] 	= $row->opd_id;
		$temp["SUB_OPD_ID"] = $row->sub_opd_id;
		$temp["BIDANG_ID"] 	= $row->bidang_id;
		$temp["STATUS"] 	= "MBAH_DARMO";
		$temp["LOGIN"] 		= true;


		$temp["LOGO"] 	= $row2->img_login;
		$temp["NAMA_DAERAH"] 	= $row2->nama_kota;

		// encript password
		// $2y$10$wCUDFZodYujCuP4CB7lqmO7h8kqXwHqC.QofOp.iHj2vN6dSCqhpa    kosong
		// $2y$10$6qrnxQK7kOTvgGjpyvjEUO1GK6fIjY0B72ga/vmubsPzbUD96PHue    admin
		// $temp["PIN"] 		= password_hash("admin", PASSWORD_DEFAULT);

		// if (password_verify("admin", '$2y$10$6qrnxQK7kOTvgGjpyvjEUO1GK6fIjY0B72ga/vmubsPzbUD96PHue')){
		// 	$temp["PIN"] 		="verify berhasil";	
		// }else{
		// 	$temp["PIN"] 		="verify gagal";
		// }

	} else {
		$temp["PEGAWAI_ID"] = "kosong";
		$temp["JENIS_AKUN"] = "kosong";
		$temp["HAK_AKSES"] 	= "kosong";
		$temp["OPD_ID"] 	= "kosong";
		$temp["SUB_OPD_ID"] = "kosong";
		$temp["BIDANG_ID"] 	= "kosong";
		$temp["STATUS"] 	= "kosong";
		$temp["LOGIN"] 		= false;
	}
} else {
	// $temp["USER"]		= "kosong";			
	// $temp["PIN"] 		= "kosong";
	$temp["PEGAWAI_ID"] = "kosong";
	$temp["JENIS_AKUN"] = "kosong";
	$temp["HAK_AKSES"] 	= "kosong";
	$temp["OPD_ID"] 	= "kosong";
	$temp["SUB_OPD_ID"] = "kosong";
	$temp["BIDANG_ID"] 	= "kosong";
	$temp["STATUS"] 	= "kosong";
	$temp["LOGIN"] 		= false;
}

$_SESSION["USER_SETTING"] = $temp;
// $temp["SQL"] 		= $sql1;
// $temp["USER"]		= $user;			
// $temp["PIN"] 		= $pin;

echo json_encode($temp);
// echo $temp;
// echo "string  rowid: ".$rowid.", rowid2: ".$rowid2;
