<?php
// connecting to db
require("dbconn.php");
// echo "Renstra Murni";
// isset($_GET['action']);
// $tes3 = json_decode($_POST['param1']);
$sql	="";
$sqltes	="";
$action = $_GET['action'];
$lvl	= $_GET['lvl'];
$param1 = json_decode($_POST['param1']);
$sts_renstra = "";
// $jml = strlen($param1->PRG_FULL);
$tes["status"] = "success";
$tes["action"] = $action;
// $tes["action"] = $action." ".substr($param1->PRG_FULL,0,2)." ".substr($param1->PRG_FULL,2,2)." ".substr($param1->PRG_FULL,4,2)." panjang karakter ".$jml;
$tes["pesan_error"] = "";

if ($lvl == "program"){
	$sts_renstra = $param1->STATUS_RENSTRA;
}elseif ($lvl == "indiprog"){
	$sts_renstra = $param1->INDIPROG_STATUS_RENSTRA;
}elseif ($lvl == "kegiatan"){
	$sts_renstra = $param1->KEG_STATUS_RENSTRA;
}elseif ($lvl == "indikeg"){
	$sts_renstra = $param1->INDIKEG_STATUS_RENSTRA;
}elseif ($lvl == "subkeg"){
	$sts_renstra = $param1->SUBKEG_STATUS_RENSTRA;
}elseif ($lvl == "indisubkeg"){
	$sts_renstra = $param1->INDISUBKEG_STATUS_RENSTRA;
}

// bisa lakukan add, update, delete jika status_renstra new dan proses_renstra <> 2 (murni), 
if ($sts_renstra == "verify"){
	// $tes["status"] = "new";

	if ($lvl == "program"){
		if ($action == "add"){					

		}elseif($action == "edit"){
			$rowid 		= $param1->ROW_ID;
			$catatan	= $param1->CATATAN_REJECT;
			

			$sql = "UPDATE program_jangka_menengah SET catatan_reject='".$catatan."' WHERE row_id=".$rowid;
				// $tes["sqltes"]  = $sql;
			$result1		= mysql_query($sql);			// True/Resource on success, False on error
			$num_result1	= mysql_affected_rows();	// Returns the number of affected rows on success, and -1 if the last query failed
			if (!$result1) {
				$tes["status"] = "Tambah Catatan Gagal";
			}

		}elseif($action == "delete"){

			
		}
	}elseif($lvl == "indiprog"){
		if ($action == "add"){	
			
		}elseif($action == "edit"){
			 // $tes["status"] ="masuk di edit indikator";

			$row_id   			= $param1->INDIPROG_ROW_ID;
			$catatan          	= $param1->INDIPROG_CATATAN_REJECT;
						
			$sql3 = "UPDATE indikator_program_jangka_menengah SET catatan_reject='".$catatan."' WHERE row_id=".$row_id;

				// $tes["status"]  = $sql3;
				$result3		= mysql_query($sql3);			// True/Resource on success, False on error
				$num_result3	= mysql_affected_rows();	// Returns the number of affected rows on success, and -1 if the last query failed
			
			if ($num_result3 == 0) {
				// $tes["status"] = "Tambah Catatan Gagal";
			}
		}elseif($action == "delete"){
			
		}
	}elseif($lvl == "kegiatan"){
		if ($action == "add"){
			
		}elseif($action == "edit"){
			// $tes["status"] = "edit catatan";

			$row_id   			= $param1->KEG_ROW_ID;
			$catatan          	= $param1->KEG_CATATAN_REJECT;
						
			$sql3 = "UPDATE kegiatan_jangka_menengah SET catatan_reject='".$catatan."' WHERE row_id=".$row_id;

				// $tes["status"]  = $sql3;
				$result3		= mysql_query($sql3);			// True/Resource on success, False on error
				$num_result3	= mysql_affected_rows();	// Returns the number of affected rows on success, and -1 if the last query failed
			
			if ($num_result3 == 0) {
				// $tes["status"] = "Tambah Catatan Gagal";
			}

		}elseif($action == "delete"){
			// delete kegiatan
			
		}
	}elseif($lvl == "indikeg"){
		if ($action == "add"){
		 	// $tes["status"] = "masuk di add indikeg";
		 	
			
		}elseif ($action == "edit"){
			// $tes["status"] = "masuk di edit indikeg";

			$row_id          	= $param1->INDIKEG_ROW_ID;
			$catatan          	= $param1->INDIKEG_CATATAN_REJECT;
						
			//tambah indikator 
			$sql3 = "UPDATE indikator_kegiatan_jangka_menengah SET";
			$sql3 .= " ";
			$sql3 .= "catatan_reject='".$catatan."'";			
			$sql3 .= " ";
			$sql3 .= "WHERE row_id='".$row_id."'";

				// $tes["status"]  = $sql3;
				$result3		= mysql_query($sql3);			// True/Resource on success, False on error
				$num_result3	= mysql_affected_rows();	// Returns the number of affected rows on success, and -1 if the last query failed
			
			if (!$result3) {
				$tes["status"] = "Tambah Catatan Gagal ";
			}

				
		}elseif ($action == "delete"){
			// $tes["status"] = "masuk di delete indikeg";
			
		}
	}elseif($lvl == "subkeg"){
		if ($action == "add"){
			
		}elseif ($action == "edit"){
			$rowid 		= $param1->SUBKEG_ROW_ID;
			$catatan 	= $param1->SUBKEG_CATATAN_REJECT;		

			
			$sql3 = "UPDATE subkegiatan_jangka_menengah SET";
			$sql3 .= " ";
			$sql3 .= "catatan_reject='".$catatan."'";
			$sql3 .= " ";
			$sql3 .= "WHERE row_id='".$rowid."'";
				// $tes["sqltes"]  = $sql;
			$result1		= mysql_query($sql3);			// True/Resource on success, False on error
			$num_result1	= mysql_affected_rows();	// Returns the number of affected rows on success, and -1 if the last query failed
			
		}elseif ($action == "delete"){
			// $tes["status"] = "delete sub kegiatan ";
			
		}
	}elseif($lvl == "indisubkeg"){
		if ($action == "add"){
			// $tes["status"] = "add indikator sub kegiatan";
			
		}elseif ($action == "edit"){
			// $tes["status"] = "edit indikator sub kegiatan";

			$rowid          	= $param1->INDISUBKEG_ROW_ID;
			$catatan          	= $param1->INDISUBKEG_CATATAN_REJECT;							
			
			
			//update
			$sql3 = "UPDATE indikator_subkegiatan_jangka_menengah SET";
			$sql3 .= " ";
			$sql3 .= "catatan_reject='".$catatan."'";
			$sql3 .= " ";
			$sql3 .= "WHERE row_id='".$rowid."'";

			// $tes["status"]  = $sql3;
			$result3		= mysql_query($sql3);			// True/Resource on success, False on error
			$num_result3	= mysql_affected_rows();	// Returns the number of affected rows on success, and -1 if the last query failed
			
			// if (!$result3) {
			// 	$tes["status"] = "Gagal";
			// }

		}elseif ($action == "delete"){
			// $tes["status"] = "delete Indikator sub Kegiatan";

		}
	}	

} else{
	$tes["status"] = "KARENA STATUS DATA ".$sts_renstra;
}



// // echo $tes;
echo json_encode($tes);


?>

