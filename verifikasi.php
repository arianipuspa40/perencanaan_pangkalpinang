<?php
// connecting to db
require("dbconn.php");

//user admin super, admin opd, user bidang (disini tidak diperlukan karena get data berdasarkan id parent)
//  parameter opd/sub opd

$action = $_GET['action'];
$lvl	= $_GET['lvl'];
$param1 = json_decode($_POST['param1']);
$param_opd = $param1->OPD_ID;
$sql1="";

$tes["status"] = "success";

if ($lvl == "renstra_kabid"){
	if ($action == "approve"){
		// $tes["status"] = "approve ".$param1->OPD_ID;

		$sql1 		= "UPDATE program_jangka_menengah SET catatan_reject='', status_renstra='request' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE indikator_program_jangka_menengah SET catatan_reject='', status_renstra='request' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE kegiatan_jangka_menengah SET catatan_reject='', status_renstra='request' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE indikator_kegiatan_jangka_menengah SET catatan_reject='', status_renstra='request' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE subkegiatan_jangka_menengah SET catatan_reject='', status_renstra='request' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE indikator_subkegiatan_jangka_menengah SET catatan_reject='', status_renstra='request' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

	}elseif($action == "reject"){
		// $tes["status"] = "reject";
		$sql1 		= "UPDATE program_jangka_menengah SET status_renstra='reject' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE indikator_program_jangka_menengah SET status_renstra='reject' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE kegiatan_jangka_menengah SET status_renstra='reject' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE indikator_kegiatan_jangka_menengah SET status_renstra='reject' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE subkegiatan_jangka_menengah SET status_renstra='reject' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE indikator_subkegiatan_jangka_menengah SET status_renstra='reject' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

	}elseif($action == "cancel_request"){
		// $tes["status"] = "cancel_request";
		$sql1 		= "UPDATE program_jangka_menengah SET status_renstra='new' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE indikator_program_jangka_menengah SET status_renstra='new' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE kegiatan_jangka_menengah SET status_renstra='new' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE indikator_kegiatan_jangka_menengah SET status_renstra='new' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE subkegiatan_jangka_menengah SET status_renstra='new' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE indikator_subkegiatan_jangka_menengah SET status_renstra='new' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

	}elseif($action == "pengajuan"){
		// $tes["status"] = "cancel_request";
		$sql1 		= "UPDATE program_jangka_menengah SET status_renstra='new' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE indikator_program_jangka_menengah SET status_renstra='new' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE kegiatan_jangka_menengah SET status_renstra='new' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE indikator_kegiatan_jangka_menengah SET status_renstra='new' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE subkegiatan_jangka_menengah SET status_renstra='new' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE indikator_subkegiatan_jangka_menengah SET status_renstra='new' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);
	}

}elseif($lvl == "renstra_sekretaris"){
	if ($action == "approve"){
		// $tes["status"] = "approve sekretaris";

		$sql1 		= "UPDATE program_jangka_menengah SET catatan_reject='', status_renstra='verify' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE indikator_program_jangka_menengah SET catatan_reject='', status_renstra='verify' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE kegiatan_jangka_menengah SET catatan_reject='', status_renstra='verify' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE indikator_kegiatan_jangka_menengah SET catatan_reject='', status_renstra='verify' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE subkegiatan_jangka_menengah SET catatan_reject='', status_renstra='verify' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE indikator_subkegiatan_jangka_menengah SET catatan_reject='', status_renstra='verify' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

	}elseif($action == "reject"){
		// $tes["status"] = "reject sekretaris";
		$sql1 		= "UPDATE program_jangka_menengah SET status_renstra='reject' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE indikator_program_jangka_menengah SET status_renstra='reject' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE kegiatan_jangka_menengah SET status_renstra='reject' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE indikator_kegiatan_jangka_menengah SET status_renstra='reject' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE subkegiatan_jangka_menengah SET status_renstra='reject' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE indikator_subkegiatan_jangka_menengah SET status_renstra='reject' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

	}
}elseif($lvl == "renstra_bidang_teknis"){
	if ($action == "approve"){
		// $tes["status"] = "approve bidang teknis";

		$sql1 		= "UPDATE program_jangka_menengah SET catatan_reject='', status_renstra='finish' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE indikator_program_jangka_menengah SET catatan_reject='', status_renstra='finish' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE kegiatan_jangka_menengah SET catatan_reject='', status_renstra='finish' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE indikator_kegiatan_jangka_menengah SET catatan_reject='', status_renstra='finish' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE subkegiatan_jangka_menengah SET catatan_reject='', status_renstra='finish' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE indikator_subkegiatan_jangka_menengah SET catatan_reject='', status_renstra='finish' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

	}elseif($action == "reject"){
		// $tes["status"] = "reject bidang teknis";

		$sql1 		= "UPDATE program_jangka_menengah SET status_renstra='reject' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE indikator_program_jangka_menengah SET status_renstra='reject' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE kegiatan_jangka_menengah SET status_renstra='reject' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE indikator_kegiatan_jangka_menengah SET status_renstra='reject' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE subkegiatan_jangka_menengah SET status_renstra='reject' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE indikator_subkegiatan_jangka_menengah SET status_renstra='reject' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);
	}
}elseif($lvl == "renstra_bidang_perencanaan"){
	if ($action == "cancel_finish"){
		// $tes["status"] = "cancel_finish";

		$sql1 		= "UPDATE program_jangka_menengah SET status_renstra='verify' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE indikator_program_jangka_menengah SET status_renstra='verify' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE kegiatan_jangka_menengah SET status_renstra='verify' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE indikator_kegiatan_jangka_menengah SET status_renstra='verify' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE subkegiatan_jangka_menengah SET status_renstra='verify' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);

		$sql1 		= "UPDATE indikator_subkegiatan_jangka_menengah SET status_renstra='verify' WHERE opd_id=".$param_opd;
		$result1	= mysql_query($sql1);
	}
}


// // echo $tes;
echo json_encode($tes);

?>