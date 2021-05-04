<?php
// connecting to db
require("dbconn.php");
// echo "halloman2";
// isset($_GET['action']);
// $tes3 = json_decode($_POST['param1']);
$sql	="";
$sqltes	="";
$lvl	= $_GET['lvl'];
$param1 = json_decode($_POST['param1']);

// $jml = strlen($param1->PRG_FULL);
$tes["status"] = "success";
$tes["pesan_error"] = "";

if ($lvl == "indiprog"){	
	$rowid 		= $param1->INDIPROG_ROW_ID;
	$ri1		= $param1->INDIPROG_REALISASI_KINERJA_BLN1;
	$ri2		= $param1->INDIPROG_REALISASI_KINERJA_BLN2;
	$ri3		= $param1->INDIPROG_REALISASI_KINERJA_BLN3;
	$ri4		= $param1->INDIPROG_REALISASI_KINERJA_BLN4;
	$ri5		= $param1->INDIPROG_REALISASI_KINERJA_BLN5;
	$ri6		= $param1->INDIPROG_REALISASI_KINERJA_BLN6;
	$ri7		= $param1->INDIPROG_REALISASI_KINERJA_BLN7;
	$ri8		= $param1->INDIPROG_REALISASI_KINERJA_BLN8;
	$ri9		= $param1->INDIPROG_REALISASI_KINERJA_BLN9;
	$ri10		= $param1->INDIPROG_REALISASI_KINERJA_BLN10;
	$ri11		= $param1->INDIPROG_REALISASI_KINERJA_BLN11;
	$ri12		= $param1->INDIPROG_REALISASI_KINERJA_BLN12;

	$rf1		= $param1->INDIPROG_REALISASI_FISIK_BLN1;
	$rf2		= $param1->INDIPROG_REALISASI_FISIK_BLN2;
	$rf3		= $param1->INDIPROG_REALISASI_FISIK_BLN3;
	$rf4		= $param1->INDIPROG_REALISASI_FISIK_BLN4;
	$rf5		= $param1->INDIPROG_REALISASI_FISIK_BLN5;
	$rf6		= $param1->INDIPROG_REALISASI_FISIK_BLN6;
	$rf7		= $param1->INDIPROG_REALISASI_FISIK_BLN7;
	$rf8		= $param1->INDIPROG_REALISASI_FISIK_BLN8;
	$rf9		= $param1->INDIPROG_REALISASI_FISIK_BLN9;
	$rf10		= $param1->INDIPROG_REALISASI_FISIK_BLN10;
	$rf11		= $param1->INDIPROG_REALISASI_FISIK_BLN11;
	$rf12		= $param1->INDIPROG_REALISASI_FISIK_BLN12;

	$sql = "UPDATE indikator_program_tahunan SET REALISASI_KINERJA_BLN1=".$ri1.",REALISASI_KINERJA_BLN2=".$ri2.", REALISASI_KINERJA_BLN3=".$ri3.", REALISASI_KINERJA_BLN4=".$ri4.", REALISASI_KINERJA_BLN5=".$ri5.", REALISASI_KINERJA_BLN6=".$ri6.", REALISASI_KINERJA_BLN7=".$ri7.", REALISASI_KINERJA_BLN8=".$ri8.", REALISASI_KINERJA_BLN9=".$ri9.", REALISASI_KINERJA_BLN10=".$ri10.", REALISASI_KINERJA_BLN11=".$ri11.", REALISASI_KINERJA_BLN12=".$ri12.", REALISASI_FISIK_BLN1=".$rf1.", REALISASI_FISIK_BLN2=".$rf2.", REALISASI_FISIK_BLN3=".$rf3.", REALISASI_FISIK_BLN4=".$rf4.", REALISASI_FISIK_BLN5=".$rf5.", REALISASI_FISIK_BLN6=".$rf6.", REALISASI_FISIK_BLN7=".$rf7.", REALISASI_FISIK_BLN8=".$rf8.", REALISASI_FISIK_BLN9=".$rf9.", REALISASI_FISIK_BLN10=".$rf10.", REALISASI_FISIK_BLN11=".$rf11.", REALISASI_FISIK_BLN12=".$rf12." WHERE row_id=".$rowid;
		// $tes["sqltes"]  = $sql;
	$result1		= mysql_query($sql);			// True/Resource on success, False on error
	$num_result1	= mysql_affected_rows();	// Returns the number of affected rows on success, and -1 if the last query failed
	if (!$result1) {
		$tes["status"] = "Input Realisasi Kinerja Program Gagal";
	}

}elseif($lvl == "indikeg"){
	$rowid 		= $param1->INDIKEG_ROW_ID;
	$ri1		= $param1->INDIKEG_REALISASI_KINERJA_BLN1;
	$ri2		= $param1->INDIKEG_REALISASI_KINERJA_BLN2;
	$ri3		= $param1->INDIKEG_REALISASI_KINERJA_BLN3;
	$ri4		= $param1->INDIKEG_REALISASI_KINERJA_BLN4;
	$ri5		= $param1->INDIKEG_REALISASI_KINERJA_BLN5;
	$ri6		= $param1->INDIKEG_REALISASI_KINERJA_BLN6;
	$ri7		= $param1->INDIKEG_REALISASI_KINERJA_BLN7;
	$ri8		= $param1->INDIKEG_REALISASI_KINERJA_BLN8;
	$ri9		= $param1->INDIKEG_REALISASI_KINERJA_BLN9;
	$ri10		= $param1->INDIKEG_REALISASI_KINERJA_BLN10;
	$ri11		= $param1->INDIKEG_REALISASI_KINERJA_BLN11;
	$ri12		= $param1->INDIKEG_REALISASI_KINERJA_BLN12;

	$rf1		= $param1->INDIKEG_REALISASI_FISIK_BLN1;
	$rf2		= $param1->INDIKEG_REALISASI_FISIK_BLN2;
	$rf3		= $param1->INDIKEG_REALISASI_FISIK_BLN3;
	$rf4		= $param1->INDIKEG_REALISASI_FISIK_BLN4;
	$rf5		= $param1->INDIKEG_REALISASI_FISIK_BLN5;
	$rf6		= $param1->INDIKEG_REALISASI_FISIK_BLN6;
	$rf7		= $param1->INDIKEG_REALISASI_FISIK_BLN7;
	$rf8		= $param1->INDIKEG_REALISASI_FISIK_BLN8;
	$rf9		= $param1->INDIKEG_REALISASI_FISIK_BLN9;
	$rf10		= $param1->INDIKEG_REALISASI_FISIK_BLN10;
	$rf11		= $param1->INDIKEG_REALISASI_FISIK_BLN11;
	$rf12		= $param1->INDIKEG_REALISASI_FISIK_BLN12;

	$sql = "UPDATE indikator_kegiatan_tahunan SET REALISASI_KINERJA_BLN1=".$ri1.",REALISASI_KINERJA_BLN2=".$ri2.", REALISASI_KINERJA_BLN3=".$ri3.", REALISASI_KINERJA_BLN4=".$ri4.", REALISASI_KINERJA_BLN5=".$ri5.", REALISASI_KINERJA_BLN6=".$ri6.", REALISASI_KINERJA_BLN7=".$ri7.", REALISASI_KINERJA_BLN8=".$ri8.", REALISASI_KINERJA_BLN9=".$ri9.", REALISASI_KINERJA_BLN10=".$ri10.", REALISASI_KINERJA_BLN11=".$ri11.", REALISASI_KINERJA_BLN12=".$ri12.", REALISASI_FISIK_BLN1=".$rf1.", REALISASI_FISIK_BLN2=".$rf2.", REALISASI_FISIK_BLN3=".$rf3.", REALISASI_FISIK_BLN4=".$rf4.", REALISASI_FISIK_BLN5=".$rf5.", REALISASI_FISIK_BLN6=".$rf6.", REALISASI_FISIK_BLN7=".$rf7.", REALISASI_FISIK_BLN8=".$rf8.", REALISASI_FISIK_BLN9=".$rf9.", REALISASI_FISIK_BLN10=".$rf10.", REALISASI_FISIK_BLN11=".$rf11.", REALISASI_FISIK_BLN12=".$rf12." WHERE row_id=".$rowid;
		$tes["sqltes"]  = $sql;
	$result1		= mysql_query($sql);			// True/Resource on success, False on error
	$num_result1	= mysql_affected_rows();	// Returns the number of affected rows on success, and -1 if the last query failed
	if (!$result1) {
		$tes["status"] = "Input Realisasi Kinerja Kegiatan Gagal";
	}
}elseif($lvl == "indisubkeg"){
	$rowid 		= $param1->INDISUBKEG_ROW_ID;
	$ri1		= $param1->INDISUBKEG_REALISASI_KINERJA_BLN1;
	$ri2		= $param1->INDISUBKEG_REALISASI_KINERJA_BLN2;
	$ri3		= $param1->INDISUBKEG_REALISASI_KINERJA_BLN3;
	$ri4		= $param1->INDISUBKEG_REALISASI_KINERJA_BLN4;
	$ri5		= $param1->INDISUBKEG_REALISASI_KINERJA_BLN5;
	$ri6		= $param1->INDISUBKEG_REALISASI_KINERJA_BLN6;
	$ri7		= $param1->INDISUBKEG_REALISASI_KINERJA_BLN7;
	$ri8		= $param1->INDISUBKEG_REALISASI_KINERJA_BLN8;
	$ri9		= $param1->INDISUBKEG_REALISASI_KINERJA_BLN9;
	$ri10		= $param1->INDISUBKEG_REALISASI_KINERJA_BLN10;
	$ri11		= $param1->INDISUBKEG_REALISASI_KINERJA_BLN11;
	$ri12		= $param1->INDISUBKEG_REALISASI_KINERJA_BLN12;

	$rf1		= $param1->INDISUBKEG_REALISASI_FISIK_BLN1;
	$rf2		= $param1->INDISUBKEG_REALISASI_FISIK_BLN2;
	$rf3		= $param1->INDISUBKEG_REALISASI_FISIK_BLN3;
	$rf4		= $param1->INDISUBKEG_REALISASI_FISIK_BLN4;
	$rf5		= $param1->INDISUBKEG_REALISASI_FISIK_BLN5;
	$rf6		= $param1->INDISUBKEG_REALISASI_FISIK_BLN6;
	$rf7		= $param1->INDISUBKEG_REALISASI_FISIK_BLN7;
	$rf8		= $param1->INDISUBKEG_REALISASI_FISIK_BLN8;
	$rf9		= $param1->INDISUBKEG_REALISASI_FISIK_BLN9;
	$rf10		= $param1->INDISUBKEG_REALISASI_FISIK_BLN10;
	$rf11		= $param1->INDISUBKEG_REALISASI_FISIK_BLN11;
	$rf12		= $param1->INDISUBKEG_REALISASI_FISIK_BLN12;

	$sql = "UPDATE indikator_subkegiatan_tahunan SET REALISASI_KINERJA_BLN1=".$ri1.",REALISASI_KINERJA_BLN2=".$ri2.", REALISASI_KINERJA_BLN3=".$ri3.", REALISASI_KINERJA_BLN4=".$ri4.", REALISASI_KINERJA_BLN5=".$ri5.", REALISASI_KINERJA_BLN6=".$ri6.", REALISASI_KINERJA_BLN7=".$ri7.", REALISASI_KINERJA_BLN8=".$ri8.", REALISASI_KINERJA_BLN9=".$ri9.", REALISASI_KINERJA_BLN10=".$ri10.", REALISASI_KINERJA_BLN11=".$ri11.", REALISASI_KINERJA_BLN12=".$ri12.", REALISASI_FISIK_BLN1=".$rf1.", REALISASI_FISIK_BLN2=".$rf2.", REALISASI_FISIK_BLN3=".$rf3.", REALISASI_FISIK_BLN4=".$rf4.", REALISASI_FISIK_BLN5=".$rf5.", REALISASI_FISIK_BLN6=".$rf6.", REALISASI_FISIK_BLN7=".$rf7.", REALISASI_FISIK_BLN8=".$rf8.", REALISASI_FISIK_BLN9=".$rf9.", REALISASI_FISIK_BLN10=".$rf10.", REALISASI_FISIK_BLN11=".$rf11.", REALISASI_FISIK_BLN12=".$rf12." WHERE row_id=".$rowid;
		// $tes["sqltes"]  = $sql;
	$result1		= mysql_query($sql);			// True/Resource on success, False on error
	$num_result1	= mysql_affected_rows();	// Returns the number of affected rows on success, and -1 if the last query failed
	if (!$result1) {
		$tes["status"] = "Input Realisasi Kinerja Sub Kegiatan Gagal";
	}
}elseif($lvl == "subkeg"){
	$rowid 		= $param1->SUBKEG_ROW_ID;
	$prtid 		= $param1->SUBKEG_PRT_ID;
	$prtprtid 	= $param1->SUBKEG_PRTPRT_ID;
	$ri1		= $param1->SUBKEG_REALISASI_JUMLAH_BLN1;
	$ri2		= $param1->SUBKEG_REALISASI_JUMLAH_BLN2;
	$ri3		= $param1->SUBKEG_REALISASI_JUMLAH_BLN3;
	$ri4		= $param1->SUBKEG_REALISASI_JUMLAH_BLN4;
	$ri5		= $param1->SUBKEG_REALISASI_JUMLAH_BLN5;
	$ri6		= $param1->SUBKEG_REALISASI_JUMLAH_BLN6;
	$ri7		= $param1->SUBKEG_REALISASI_JUMLAH_BLN7;
	$ri8		= $param1->SUBKEG_REALISASI_JUMLAH_BLN8;
	$ri9		= $param1->SUBKEG_REALISASI_JUMLAH_BLN9;
	$ri10		= $param1->SUBKEG_REALISASI_JUMLAH_BLN10;
	$ri11		= $param1->SUBKEG_REALISASI_JUMLAH_BLN11;
	$ri12		= $param1->SUBKEG_REALISASI_JUMLAH_BLN12;
	$rjml   	= $ri1+$ri2+$ri3+$ri4+$ri5+$ri6+$ri7+$ri8+$ri9+$ri10+$ri11+$ri12;

	$sql = "UPDATE subkegiatan_tahunan SET realisasi_jumlah=".$rjml.",realisasi_jumlah_bln1=".$ri1.",realisasi_jumlah_bln2=".$ri2.", realisasi_jumlah_bln3=".$ri3.", realisasi_jumlah_bln4=".$ri4.", realisasi_jumlah_bln5=".$ri5.", realisasi_jumlah_bln6=".$ri6.", realisasi_jumlah_bln7=".$ri7.", realisasi_jumlah_bln8=".$ri8.", realisasi_jumlah_bln9=".$ri9.", realisasi_jumlah_bln10=".$ri10.", realisasi_jumlah_bln11=".$ri11.", realisasi_jumlah_bln12=".$ri12." WHERE row_id=".$rowid;
		// $tes["sqltes"]  = $sql;
	$result1		= mysql_query($sql);			// True/Resource on success, False on error
	$num_result1	= mysql_affected_rows();	// Returns the number of affected rows on success, and -1 if the last query failed
	if ($result1) {
				
		$sql2="SELECT SUM(realisasi_jumlah) AS rjmlskeg, sum(realisasi_jumlah_bln1) AS bln1, sum(realisasi_jumlah_bln2) AS bln2, sum(realisasi_jumlah_bln3) AS bln3, sum(realisasi_jumlah_bln4) AS bln4, sum(realisasi_jumlah_bln5) AS bln5, sum(realisasi_jumlah_bln6) AS bln6, sum(realisasi_jumlah_bln7) AS bln7, sum(realisasi_jumlah_bln8) AS bln8, sum(realisasi_jumlah_bln9) AS bln9, sum(realisasi_jumlah_bln10) AS bln10, sum(realisasi_jumlah_bln11) AS bln11, sum(realisasi_jumlah_bln12) AS bln12 FROM subkegiatan_tahunan WHERE prt_id = ".$prtid ;
		$result2  = mysql_query($sql2);
		$numrows2 = mysql_num_rows($result2);
		if ($numrows2 > 0) {									
			for ($i=0; $i<$numrows2; $i++) {
				$row = mysql_fetch_object($result2);								
				$rjmlskeg  = $row->rjmlskeg;
				$bln1  = $row->bln1;
				$bln2  = $row->bln2;
				$bln3  = $row->bln3;
				$bln4  = $row->bln4;
				$bln5  = $row->bln5;
				$bln6  = $row->bln6;
				$bln7  = $row->bln7;
				$bln8  = $row->bln8;
				$bln9  = $row->bln9;
				$bln10  = $row->bln10;
				$bln11  = $row->bln11;
				$bln12  = $row->bln12;
			}

			// update jumlah lvl kegiatan
			$sql3 = "UPDATE kegiatan_tahunan SET realisasi_jumlah=".$rjmlskeg." ,realisasi_jumlah_bln1=".$bln1." ,realisasi_jumlah_bln2=".$bln2." ,realisasi_jumlah_bln3=".$bln3." ,realisasi_jumlah_bln4=".$bln4." ,realisasi_jumlah_bln5=".$bln5." ,realisasi_jumlah_bln6=".$bln6." ,realisasi_jumlah_bln7=".$bln7." ,realisasi_jumlah_bln8=".$bln8." ,realisasi_jumlah_bln9=".$bln9." ,realisasi_jumlah_bln10=".$bln10." ,realisasi_jumlah_bln11=".$bln11." ,realisasi_jumlah_bln12=".$bln12." WHERE row_id=".$prtid;
			$result3		= mysql_query($sql3);			// True/Resource on success, False on error


			$sql4="SELECT SUM(realisasi_jumlah) AS rjmlskeg, sum(realisasi_jumlah_bln1) AS bln1, sum(realisasi_jumlah_bln2) AS bln2, sum(realisasi_jumlah_bln3) AS bln3, sum(realisasi_jumlah_bln4) AS bln4, sum(realisasi_jumlah_bln5) AS bln5, sum(realisasi_jumlah_bln6) AS bln6, sum(realisasi_jumlah_bln7) AS bln7, sum(realisasi_jumlah_bln8) AS bln8, sum(realisasi_jumlah_bln9) AS bln9, sum(realisasi_jumlah_bln10) AS bln10, sum(realisasi_jumlah_bln11) AS bln11, sum(realisasi_jumlah_bln12) AS bln12 FROM subkegiatan_tahunan WHERE prtprt_id = ".$prtprtid ;
			$result4  = mysql_query($sql4);
			$numrows4 = mysql_num_rows($result4);
			if ($numrows4 > 0) {
				for ($i=0; $i<$numrows4; $i++) {
					$row = mysql_fetch_object($result4);								
					$rjmlskeg  = $row->rjmlskeg;
					$bln1  = $row->bln1;
					$bln2  = $row->bln2;
					$bln3  = $row->bln3;
					$bln4  = $row->bln4;
					$bln5  = $row->bln5;
					$bln6  = $row->bln6;
					$bln7  = $row->bln7;
					$bln8  = $row->bln8;
					$bln9  = $row->bln9;
					$bln10  = $row->bln10;
					$bln11  = $row->bln11;
					$bln12  = $row->bln12;
				}

				// update jumlah lvl program
				$sql5 = "UPDATE program_tahunan SET realisasi_jumlah=".$rjmlskeg." ,realisasi_jumlah_bln1=".$bln1." ,realisasi_jumlah_bln2=".$bln2." ,realisasi_jumlah_bln3=".$bln3." ,realisasi_jumlah_bln4=".$bln4." ,realisasi_jumlah_bln5=".$bln5." ,realisasi_jumlah_bln6=".$bln6." ,realisasi_jumlah_bln7=".$bln7." ,realisasi_jumlah_bln8=".$bln8." ,realisasi_jumlah_bln9=".$bln9." ,realisasi_jumlah_bln10=".$bln10." ,realisasi_jumlah_bln11=".$bln11." ,realisasi_jumlah_bln12=".$bln12." WHERE row_id=".$prtprtid;
				$result5		= mysql_query($sql5);			// True/Resource on success, False on error

			} else {
			// no record found
			// $tdeskripsi  ="";
			}	

		} else {
			// no record found
			// $tdeskripsi  ="";
		}
		// akhir update jumlah lvl kegiatan



	}else{
		$tes["status"] = "Input Realisasi Kinerja Sub Kegiatan Gagal";
		// $tes["status"] = "Input Realisasi Kinerja Sub Kegiatan Gagal ".$prtid."  ".$prtprtid ;
	}
}
echo json_encode($tes);


?>

