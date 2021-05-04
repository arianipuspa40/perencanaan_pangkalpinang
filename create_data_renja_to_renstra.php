<?php
// connecting to db
// catatan blm ditambahkan filter tahun sesuai tahun aktif/tahun ke berapa?
require("dbconn.php");


	// // program
	// $sql 		= "SELECT * FROM program_tahunan";
	// $result = mysql_query($sql);	

	// // num rows
	// $numrows = mysql_num_rows($result);
	// // echo $numrows;
	// if ($numrows > 0) {
	// 	// data
	// 	// $data 			= array();
	// 	// $data_table = array();
		
	// 	for ($i=0; $i<$numrows; $i++) {
	// 		$sql2 = "";
	// 		$row = mysql_fetch_object($result);		

	// 		// insert data
	// 		$sql2  = "INSERT INTO program_jangka_menengah SET";
	// 		$sql2 .= " ";
	// 		$sql2 .= "sasaran_daerah_id='".$row->sasaran_daerah_id."',";
	// 		$sql2 .= "sasaran_pd_id='".$row->sasaran_pd_id."',";
	// 		$sql2 .= "opd_id='".$row->opd_id."',";
	// 		$sql2 .= "sub_opd_id='".$row->sub_opd_id."',";
	// 		$sql2 .= "bidang_opd_id='".$row->bidang_opd_id."',";
	// 		$sql2 .= "urs_id='".$row->urs_id."',";
	// 		$sql2 .= "bid_urs_id='".$row->bid_urs_id."',";
	// 		$sql2 .= "prog_id='".$row->prog_id."',";
	// 		$sql2 .= "deskripsi='".$row->deskripsi."',";
	// 		$sql2 .= "refr_prog='".$row->refr_prog."',";
	// 		$sql2 .= "target_pagu_prog_tahun3='".$row->pagu_prog_tahunan_renstra."',";
	// 		$sql2 .= "p_target_pagu_prog_tahun3='".$row->p_pagu_prog_tahunan_renstra."'";	
	// 		// $data_table[] = $data;


	// 		$result2 = mysql_query($sql2);
	// 		$num_result = mysql_affected_rows();
	// 		if ($num_result > 0) {
	// 			$sql2 = "";
	// 			echo "berhasil";
	// 		} else {
	// 			$sql2 = "";
	// 			echo "gagal";
	// 		}
	// 		 // echo $num_result;
	// 		// echo $sql2;
	// 	}
	// 	// echo json_encode($data_table);
	// 	// echoing JSON response output
	// 	// header('Content-type: application/json');
	// 	// echo json_encode($data_table);			
	// }

	// // indikator program
	// $sql 		= "SELECT * FROM indikator_program_tahunan";
	// $result 	= mysql_query($sql);	

	// // num rows
	// $numrows = mysql_num_rows($result);
	// // echo $numrows;
	// if ($numrows > 0) {

	// 	for ($i=0; $i<$numrows; $i++) {
	// 		$sql2 = "";
	// 		$row = mysql_fetch_object($result);		

	// 		// insert data
	// 		$sql2  = "INSERT INTO indikator_program_jangka_menengah SET";
	// 		$sql2 .= " ";
	// 		$sql2 .= "opd_id='".$row->opd_id."',";
	// 		$sql2 .= "sub_opd_id='".$row->sub_opd_id."',";
	// 		$sql2 .= "urs_id='".$row->urs_id."',";
	// 		$sql2 .= "bid_urs_id='".$row->bid_urs_id."',";
	// 		$sql2 .= "prog_id='".$row->prog_id."',";
	// 		$sql2 .= "Indikator_program='".$row->Indikator_program."',";
	// 		$sql2 .= "satuan_indikator_program='".$row->satuan_indikator_program."',";
	// 		$sql2 .= "target_kinerja_prog_tahun3='".$row->kinerja_prog_renstra_tahunan."',";
	// 		$sql2 .= "p_target_kinerja_prog_tahun3='".$row->p_kinerja_prog_renstra_tahunan."'";	
	// 		// $data_table[] = $data;

	// 		$result2 = mysql_query($sql2);
	// 		$num_result = mysql_affected_rows();
	// 		if ($num_result > 0) {
	// 			$sql2 = "";
	// 			echo "berhasil";
	// 		} else {
	// 			$sql2 = "";
	// 			echo "gagal";
	// 		}
	// 		// akhir insert data
	// 		 // echo $num_result;
	// 		// echo $sql2;
	// 	}
	// 	// create parent
	// 	$sql 		= "update indikator_program_jangka_menengah AS ip, program_jangka_menengah AS p SET ip.prt_id=p.row_id WHERE concat(p.sub_opd_id,p.urs_id,p.bid_urs_id,p.prog_id) = concat(ip.sub_opd_id,ip.urs_id,ip.bid_urs_id,ip.prog_id)";
	// 	$result 	= mysql_query($sql);			
	// 	$num_result = mysql_affected_rows();
	// 	if ($num_result > 0) {
	// 		$sql2 = "";
	// 		echo "berhasil";
	// 	} else {
	// 		$sql2 = "";
	// 		echo "gagal";
	// 	}
	// }	
	// // akhir indikator program


	// // kegiatan
	// $sql 		= "SELECT * FROM kegiatan_tahunan";
	// $result = mysql_query($sql);	

	// // num rows
	// $numrows = mysql_num_rows($result);
	// // echo $numrows;
	// if ($numrows > 0) {
	// 	// data
	// 	// $data 			= array();
	// 	// $data_table = array();
		
	// 	for ($i=0; $i<$numrows; $i++) {
	// 		$sql2 = "";
	// 		$row = mysql_fetch_object($result);		

	// 		// insert data
	// 		$sql2  = "INSERT INTO kegiatan_jangka_menengah SET";
	// 		$sql2 .= " ";			
	// 		$sql2 .= "opd_id='".$row->opd_id."',";
	// 		$sql2 .= "sub_opd_id='".$row->sub_opd_id."',";
	// 		$sql2 .= "bidang_opd_id='".$row->bidang_opd_id."',";
	// 		$sql2 .= "urs_id='".$row->urs_id."',";
	// 		$sql2 .= "bid_urs_id='".$row->bid_urs_id."',";
	// 		$sql2 .= "prog_id='".$row->prog_id."',";
	// 		$sql2 .= "keg_kode='".$row->keg_kode."',";
	// 		$sql2 .= "keg_id='".$row->keg_id."',";
	// 		$sql2 .= "deskripsi='".$row->deskripsi."',";
	// 		$sql2 .= "refr_prog='".$row->refr_prog."',";
	// 		$sql2 .= "target_pagu_keg_tahun3='".$row->pagu_keg_tahunan_renstra."',";
	// 		$sql2 .= "p_target_pagu_keg_tahun3='".$row->p_pagu_keg_tahunan_renstra."'";	

	// 		$result2 = mysql_query($sql2);
	// 		$num_result = mysql_affected_rows();
	// 		if ($num_result > 0) {
	// 			$sql2 = "";
	// 			echo "berhasil";
	// 		} else {
	// 			$sql2 = "";
	// 			echo "gagal";
	// 		}
	// 		 // echo $num_result;
	// 		// echo $sql2;
	// 	}
	// 	// echo json_encode($data_table);
	// 	// echoing JSON response output
	// 	// header('Content-type: application/json');
	// 	// echo json_encode($data_table);			
	// }

	// // indikator kegiatan
	// $sql 		= "SELECT * FROM indikator_kegiatan_tahunan";
	// $result 	= mysql_query($sql);	

	// // num rows
	// $numrows = mysql_num_rows($result);
	// // echo $numrows;
	// if ($numrows > 0) {
	// 	for ($i=0; $i<$numrows; $i++) {
	// 		$sql2 = "";
	// 		$row = mysql_fetch_object($result);		

	// 		// insert data
	// 		$sql2  = "INSERT INTO indikator_kegiatan_jangka_menengah SET";
	// 		$sql2 .= " ";
	// 		$sql2 .= "opd_id='".$row->opd_id."',";
	// 		$sql2 .= "sub_opd_id='".$row->sub_opd_id."',";
	// 		$sql2 .= "urs_id='".$row->urs_id."',";
	// 		$sql2 .= "bid_urs_id='".$row->bid_urs_id."',";
	// 		$sql2 .= "prog_id='".$row->prog_id."',";
	// 		$sql2 .= "keg_kode='".$row->keg_kode."',";
	// 		$sql2 .= "keg_id='".$row->keg_id."',";
	// 		$sql2 .= "Indikator_kegiatan='".$row->Indikator_kegiatan."',";
	// 		$sql2 .= "satuan_indikator_kegiatan='".$row->satuan_indikator_kegiatan."',";
	// 		$sql2 .= "target_kinerja_keg_tahun3='".$row->kinerja_keg_renstra_tahunan."',";
	// 		$sql2 .= "p_target_kinerja_keg_tahun3='".$row->p_kinerja_keg_renstra_tahunan."'";	
	// 		// $data_table[] = $data;
	

	// 		$result2 = mysql_query($sql2);
	// 		$num_result = mysql_affected_rows();
	// 		if ($num_result > 0) {
	// 			$sql2 = "";
	// 			echo "berhasil";
	// 		} else {
	// 			$sql2 = "";
	// 			echo "gagal";
	// 		}
	// 		// akhir insert data
	// 		 // echo $num_result;
	// 		// echo $sql2;
	// 	}
	// 	// create parent
	// 	$sql 	= "update indikator_kegiatan_jangka_menengah AS ik, kegiatan_jangka_menengah AS k SET ik.prt_id=k.row_id WHERE concat(k.sub_opd_id, k.urs_id,k.bid_urs_id,k.prog_id,k.keg_kode,k.keg_id) = concat(ik.sub_opd_id,ik.urs_id,ik.bid_urs_id,ik.prog_id,ik.keg_kode,ik.keg_id)";
	// 	$result 	= mysql_query($sql);			
	// 	$num_result = mysql_affected_rows();
	// 	if ($num_result > 0) {
	// 		$sql2 = "";
	// 		echo "berhasil";
	// 	} else {
	// 		$sql2 = "";
	// 		echo "gagal";
	// 	}
	// }
	// // akhir indikator kegiatan

	// // subkegiatan
	// $sql 		= "SELECT * FROM subkegiatan_tahunan";
	// $result = mysql_query($sql);	

	// // num rows
	// $numrows = mysql_num_rows($result);
	// // echo $numrows;
	// if ($numrows > 0) {
		
	// 	for ($i=0; $i<$numrows; $i++) {
	// 		$sql2 = "";
	// 		$row = mysql_fetch_object($result);		

	// 		// insert data
	// 		$sql2  = "INSERT INTO subkegiatan_jangka_menengah SET";
	// 		$sql2 .= " ";			
	// 		$sql2 .= "opd_id='".$row->opd_id."',";
	// 		$sql2 .= "sub_opd_id='".$row->sub_opd_id."',";
	// 		$sql2 .= "bidang_opd_id='".$row->bidang_opd_id."',";
	// 		$sql2 .= "urs_id='".$row->urs_id."',";
	// 		$sql2 .= "bid_urs_id='".$row->bid_urs_id."',";
	// 		$sql2 .= "prog_id='".$row->prog_id."',";
	// 		$sql2 .= "keg_kode='".$row->keg_kode."',";
	// 		$sql2 .= "keg_id='".$row->keg_id."',";
	// 		$sql2 .= "subkeg_id='".$row->subkeg_id."',";
	// 		$sql2 .= "deskripsi='".$row->deskripsi."',";
	// 		$sql2 .= "refr_prog='".$row->refr_prog."',";
	// 		$sql2 .= "target_pagu_subkeg_tahun3='".$row->pagu_subkeg_tahunan_renstra."',";
	// 		$sql2 .= "p_target_pagu_subkeg_tahun3='".$row->p_pagu_subkeg_tahunan_renstra."'";	

	// 		$result2 = mysql_query($sql2);
	// 		$num_result = mysql_affected_rows();
	// 		if ($num_result > 0) {
	// 			$sql2 = "";
	// 			echo "berhasil";
	// 		} else {
	// 			$sql2 = "";
	// 			echo "gagal";
	// 		}
	// 	}	
	// }

	// indikator sub kegiatan
	$sql 		= "SELECT * FROM indikator_subkegiatan_tahunan";
	$result 	= mysql_query($sql);	

	// num rows
	$numrows = mysql_num_rows($result);
	// echo $numrows;
	if ($numrows > 0) {
		for ($i=0; $i<$numrows; $i++) {
			$sql2 = "";
			$row = mysql_fetch_object($result);		

			// insert data
			$sql2  = "INSERT INTO indikator_subkegiatan_jangka_menengah SET";
			$sql2 .= " ";
			$sql2 .= "opd_id='".$row->opd_id."',";
			$sql2 .= "sub_opd_id='".$row->sub_opd_id."',";
			$sql2 .= "urs_id='".$row->urs_id."',";
			$sql2 .= "bid_urs_id='".$row->bid_urs_id."',";
			$sql2 .= "prog_id='".$row->prog_id."',";
			$sql2 .= "keg_kode='".$row->keg_kode."',";
			$sql2 .= "keg_id='".$row->keg_id."',";
			$sql2 .= "subkeg_id='".$row->subkeg_id."',";
			$sql2 .= "Indikator_subkegiatan='".$row->Indikator_subkegiatan."',";
			$sql2 .= "satuan_indikator_subkegiatan='".$row->satuan_indikator_subkegiatan."',";
			$sql2 .= "target_kinerja_subkeg_tahun3='".$row->kinerja_subkeg_renstra_tahunan."',";
			$sql2 .= "p_target_kinerja_subkeg_tahun3='".$row->p_kinerja_subkeg_renstra_tahunan."'";	
			
			$result2 = mysql_query($sql2);
			$num_result = mysql_affected_rows();
			if ($num_result > 0) {
				$sql2 = "";
				echo "berhasil";
			} else {
				$sql2 = "";
				echo "gagal";
			}
			// akhir insert data
			
			// echo $num_result;
			// echo $sql2;
		}
		// create parent
		$sql 	= "update indikator_subkegiatan_jangka_menengah AS isk, subkegiatan_jangka_menengah AS sk SET isk.prt_id=sk.row_id WHERE concat(sk.sub_opd_id, sk.urs_id,sk.bid_urs_id,sk.prog_id,sk.keg_kode,sk.keg_id,sk.subkeg_id) = concat(isk.sub_opd_id,isk.urs_id,isk.bid_urs_id,isk.prog_id, isk.keg_kode, isk.keg_id,isk.subkeg_id)";
		$result 	= mysql_query($sql);			
		$num_result = mysql_affected_rows();
		if ($num_result > 0) {
			$sql2 = "";
			echo "berhasil";
		} else {
			$sql2 = "";
			echo "gagal";
		}
	}
	// akhir indikator sub kegiatan

?>