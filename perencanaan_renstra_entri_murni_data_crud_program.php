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
  $sql  = "";
  $sqltes  = "";
  $action = $_GET['action'];
  $lvl  = $_GET['lvl'];


  $param1 = json_decode($_POST['param1']);
  $sts_renstra = "";
  // $jml = strlen($param1->PRG_FULL);

  $tes["action"] = $action;
  // $tes["action"] = $action." ".substr($param1->PRG_FULL,0,2)." ".substr($param1->PRG_FULL,2,2)." ".substr($param1->PRG_FULL,4,2)." panjang karakter ".$jml;
  $tes["pesan_error"] = "";

  if ($lvl == "program") {
    $sts_renstra = $param1->STATUS_RENSTRA;
  } elseif ($lvl == "indiprog") {
    $sts_renstra = $param1->INDIPROG_STATUS_RENSTRA;
  } elseif ($lvl == "kegiatan") {
    $sts_renstra = $param1->KEG_STATUS_RENSTRA;
  } elseif ($lvl == "indikeg") {
    $sts_renstra = $param1->INDIKEG_STATUS_RENSTRA;
  } elseif ($lvl == "subkeg") {
    $sts_renstra = $param1->SUBKEG_STATUS_RENSTRA;
  } elseif ($lvl == "indisubkeg") {
    $sts_renstra = $param1->INDISUBKEG_STATUS_RENSTRA;
  }

  // bisa lakukan add, update, delete jika status_renstra new dan proses_renstra <> 2 (murni), 
  if ($sts_renstra == "new") {
    if ($lvl == "program") {
      if ($action == "add") {
        // $sub_opd_id	= $param1->SUB_OPD_ID;
        // $opd_id    	= $param1->OPD_ID;	
        // diganti ambil dari session
        $sub_opd_id  = $temp_session["SESSION"]["SUB_OPD_ID"];
        $opd_id      = $temp_session["SESSION"]["OPD_ID"];
        // console.log($temp_session["SESSION"]);
        $sasaran_pd  = $param1->SASARAN_PD_ID;
        $tujuan_pd   = $param1->TUJUAN_PD_ID;
        $prgfull   = $param1->PRG_FULL;
        $bidang_pd   = $param1->BIDANG_OPD_ID;

        $pagu1 = $param1->TARGET_PAGU_PROG_TAHUN1;
        $pagu2 = $param1->TARGET_PAGU_PROG_TAHUN2;
        $pagu3 = $param1->TARGET_PAGU_PROG_TAHUN3;
        $pagu4 = $param1->TARGET_PAGU_PROG_TAHUN4;
        $pagu5 = $param1->TARGET_PAGU_PROG_TAHUN5;
        $AkhirPagu = $pagu1 + $pagu2 + $pagu3 + $pagu4 + $pagu5;

        if (strlen($sasaran_pd) == 0) {
          $sasaran_pd = 0;
        }
        if (strlen($tujuan_pd) == 0) {
          $tujuan_pd = 0;
        }
        if (strlen($bidang_pd) == 0) {
          $bidang_pd = 0;
        }

        if (strlen($prgfull) == 0 or strlen($sub_opd_id) == 0) {
          $tes["status"] = "PROGRAM HARUS DIISI" . " prg: " . $prgfull . " opd: " . $sub_opd_id . " session: " . $temp_session["SESSION"]["SUB_OPD_ID"];
        } elseif (strlen($prgfull) == 6) {
          // cek duplicate 
          $sqltes = "SELECT * FROM program_jangka_menengah WHERE sub_opd_id= " . $sub_opd_id . " AND prg_full = " . $prgfull;
          // $tes["sqltes"] = $sqltes;
          // $result		= mysql_query($sqltes);			// True/Resource on success, False on error
          $result   = bmysqli_query($conn, $sqltes);
          $num_result = bmysqli_affected_rows($conn);  // Returns the number of affected rows on success, and -1 if the last query failed
          if ($num_result == 0) {
            // get deskripsi 
            $tdeskripsi = "";
            $sqldes = "";
            $sqldes = "SELECT deskripsi FROM master_program WHERE lvl=3 AND CONCAT(urs_id,bid_urs_id,prog_id)='" . $prgfull . "'";

            // $result_des = mysql_query($sqldes);
            $result_des  = bmysqli_query($conn, $sqldes);
            // num rows
            // $numrows_des = mysql_num_rows($result_des);
            $numrows_des = bmysqli_num_rows($result_des);

            if ($numrows_des > 0) {
              for ($i = 0; $i < $numrows_des; $i++) {
                // $row = mysql_fetch_object($result_des);		
                $row = bmysqli_fetch_object($result_des);
                $tdeskripsi  = $row->deskripsi;
              }
            } else {
              // no record found
              $tdeskripsi  = "";
              if (substr($prgfull, 4, 2) == "01") {
                $tdeskripsi  = "PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH";
              }
            }

            // cek asal inputan dari rpjmd atau renstra
            $lane = $_GET['lane'];
            if ($lane == "rpjmd") {

              // insert from RPJMD tabel
              $sql = "INSERT INTO program_jangka_menengah (proses_renstra, sasaran_pd_id,tujuan_pd_id, opd_id, sub_opd_id, bidang_opd_id, urs_id, bid_urs_id, prog_id, prg_full,target_akhir_pagu_program,target_pagu_prog_tahun1,target_pagu_prog_tahun2,target_pagu_prog_tahun3,target_pagu_prog_tahun4,target_pagu_prog_tahun5,deskripsi) VALUES (1, " . $sasaran_pd . "," . $tujuan_pd . "," . $opd_id . "," . $sub_opd_id . "," . $bidang_pd . "," . substr($param1->PRG_FULL, 0, 2) . "," . substr($param1->PRG_FULL, 2, 2) . "," . substr($param1->PRG_FULL, 4, 2) . "," . $prgfull . "," . $AkhirPagu . "," . $pagu1 . "," . $pagu2 . "," . $pagu3 . "," . $pagu4 . "," . $pagu5 . ",'" . $tdeskripsi . "')";
            } elseif ($lane == "renstra") {
              $sql = "INSERT INTO program_jangka_menengah (proses_renstra, sasaran_pd_id,tujuan_pd_id, opd_id, sub_opd_id, bidang_opd_id, urs_id, bid_urs_id, prog_id, prg_full,deskripsi) VALUES (1, " . $sasaran_pd . "," . $tujuan_pd . "," . $opd_id . "," . $sub_opd_id . "," . $bidang_pd . "," . substr($param1->PRG_FULL, 0, 2) . "," . substr($param1->PRG_FULL, 2, 2) . "," . substr($param1->PRG_FULL, 4, 2) . "," . $prgfull . ",'" . $tdeskripsi . "')";
            } else {
              $te["status"] = "lane gagal";
            }

            $result1    = bmysqli_query($conn, $sql);
            $num_result1  = bmysqli_affected_rows($conn);  // Returns the number of affected rows on success, and -1 if the last query failed
            // $tes["status2"]  = "tesstatus2";
            // $tes["status"]  = "success";
            if ($num_result1 < 1) {
              $tes["status"] = "Tambah Program gagal";
            }
          } else {
            // ada 2 macam, yang pertama memang sudah ada, yang kedua sudah ada tetapi statusnya/prosesnya membuat tidak terlihat
            // $numrows = mysql_num_rows($result);
            $numrows = bmysqli_num_rows($result);
            if ($numrows == 1) {
              // $row = mysql_fetch_object($result);	
              $row = bmysqli_fetch_object($result);
              if ($row->proses_p_renstra == 0 and $row->proses_renstra == 2) {
                $tes["status"] = "PROGRAM SUDAH TERSEDIA TETAPI DALAM KONDISI NON AKTIF";
                // Aktifkan kembali program tersebut (ini terjadi khusus di renstra perubahan)

              } else {
                $tes["status"] = "PROGRAM SUDAH TERSEDIA";
              }
            } else {
              // no record found
              $tes["status"] = "PROGRAM SUDAH TERSEDIA SEBANYAK= " . $numrows;
            }
          }
        } else {
          $tes["status"] = "error";
        }
      } elseif ($action == "edit") {
        $rowid     = $param1->ROW_ID;
        $sasaran_pd  = $param1->SASARAN_PD_ID;
        $tujuan_pd   = $param1->TUJUAN_PD_ID;
        $bidang_pd   = $param1->BIDANG_OPD_ID;
        $pagu1       = $param1->TARGET_PAGU_PROG_TAHUN1;
        $pagu2       = $param1->TARGET_PAGU_PROG_TAHUN2;
        $pagu3       = $param1->TARGET_PAGU_PROG_TAHUN3;
        $pagu4       = $param1->TARGET_PAGU_PROG_TAHUN4;
        $pagu5       = $param1->TARGET_PAGU_PROG_TAHUN5;
        $AkhirPagu   = $pagu1 + $pagu2 + $pagu3 + $pagu4 + $pagu5;

        if (strlen($sasaran_pd) == 0) {
          $sasaran_pd = 0;
        }
        if (strlen($tujuan_pd) == 0) {
          $tujuan_pd = 0;
        }
        if (strlen($bidang_pd) == 0) {
          $bidang_pd = 0;
        }
        // $tes["status"] = "gagal";
        $lane = $_GET['lane'];
        if ($lane = "rpjmd") {
          $sql = "UPDATE program_jangka_menengah SET sasaran_pd_id=" . $sasaran_pd . ",tujuan_pd_id=" . $tujuan_pd . ", bidang_opd_id=" . $bidang_pd . ", target_akhir_pagu_program=" . $AkhirPagu . ", target_pagu_prog_tahun1=" . $pagu1 . ", target_pagu_prog_tahun2=" . $pagu2 . ", target_pagu_prog_tahun3=" . $pagu3 . ", target_pagu_prog_tahun4=" . $pagu4 . ", target_pagu_prog_tahun5=" . $pagu5 . " WHERE row_id=" . $rowid;
        } elseif ($lane = "restra") {
          $sql = "UPDATE program_jangka_menengah SET sasaran_pd_id=" . $sasaran_pd . ",tujuan_pd_id=" . $tujuan_pd . ", bidang_opd_id=" . $bidang_pd . " WHERE row_id=" . $rowid;
        }

        // $tes["sqltes"]  = $sql;
        // $result1		= mysql_query($sql);			// True/Resource on success, False on error
        $result1       = bmysqli_query($conn, $sql);
        $num_result1  = bmysqli_affected_rows($conn);  // Returns the number of affected rows on success, and -1 if the last query failed							  
        if (!$result1) {
          $tes["status"] = "Edit Program gagal";
        }
      } elseif ($action == "delete") {

        $prog_rowid = $param1->ROW_ID;

        // delete sub kegiatan
        $sql     = "SELECT * FROM subkegiatan_jangka_menengah WHERE prtprt_id=" . $prog_rowid;
        // $result 	= mysql_query($sql);
        $result = bmysqli_query($conn, $sql);
        // num rows
        // $numrows = mysql_num_rows($result);	
        $numrows = bmysqli_num_rows($result);
        if ($numrows > 0) {
          for ($i = 0; $i < $numrows; $i++) {
            // $row     = mysql_fetch_object($result);
            $row    = bmysqli_fetch_object($result);
            $sql1    = "DELETE FROM indikator_subkegiatan_jangka_menengah WHERE prt_id=" . $row->row_id;
            // $result1 = mysql_query($sql1);	
            $result1 = bmysqli_query($conn, $sql1);
          }

          $sql2    = "DELETE FROM subkegiatan_jangka_menengah WHERE prtprt_id=" . $prog_rowid;
          // $result2 = mysql_query($sql2);
          $result2 = bmysqli_query($conn, $sql2);
        }

        // delete kegiatan
        $sql     = "SELECT * FROM kegiatan_jangka_menengah WHERE prt_id=" . $prog_rowid;
        // $result 	= mysql_query($sql);
        $result   = bmysqli_query($conn, $sql);
        // num rows
        // $numrows = mysql_num_rows($result);	
        $numrows = bmysqli_num_rows($result);
        if ($numrows > 0) {
          for ($i = 0; $i < $numrows; $i++) {
            // $row     = mysql_fetch_object($result);
            $row    = bmysqli_fetch_object($result);
            $sql1    = "DELETE FROM indikator_kegiatan_jangka_menengah WHERE prt_id=" . $row->row_id;
            // $result1 = mysql_query($sql1);	
            $result1 = bmysqli_query($conn, $sql1);
          }

          $sql2    = "DELETE FROM kegiatan_jangka_menengah WHERE prt_id=" . $prog_rowid;
          // $result2 = mysql_query($sql2);	
          $result2 = bmysqli_query($conn, $sql2);
        }

        // delete program
        $sql1    = "DELETE FROM indikator_program_jangka_menengah WHERE prt_id=" . $prog_rowid;
        // $result1 = mysql_query($sql1);	
        $result1 = bmysqli_query($conn, $sql1);

        $sql2    = "DELETE FROM program_jangka_menengah WHERE row_id=" . $prog_rowid;
        // $result2 = mysql_query($sql2);		
        $result2 = bmysqli_query($conn, $sql2);

        // $sql = "DELETE FROM program_jangka_menengah WHERE row_id=".$param1->ROW_ID;
        // $result		= mysql_query($sql);			// True/Resource on success, False on error
        // $num_result = mysql_affected_rows();	// Returns the number of affected rows on success, and -1 if the last query failed

        // if ($num_result > 0) {
        // 	// delete indikator program, delete kegiatan terkait program

        // 	// $tes["status"] = "error2";
        // 	// delete kegiatan
        // }else{
        // 	$tes["status"] = "error2";
        // }
      }
    } elseif ($lvl == "indiprog") {
      if ($action == "add") {
        $indiprog      = trim($param1->INDIPROG_INDIKATOR_PROGRAM);
        // $indiprog			= trim($param1->INDIPROG_INDIKATOR_PROGRAM);
        $satuanindiprog   = trim($param1->INDIPROG_SATUAN_INDIKATOR_PROGRAM);
        $prtid            = $param1->INDIPROG_PRT_ID;
        $opd_id          = $param1->INDIPROG_OPD_ID;
        $sub_opd_id      = $param1->INDIPROG_SUB_OPD_ID;
        $prgfull       = $param1->INDIPROG_PRG_FULL;
        $kawal        = $param1->INDIPROG_KINERJA_AWAL_PROGRAM;
        $kakhir        = $param1->INDIPROG_TARGET_AKHIR_KINERJA_PROGRAM;
        $kthn1        = $param1->INDIPROG_TARGET_KINERJA_PROG_TAHUN1;
        $kthn2        = $param1->INDIPROG_TARGET_KINERJA_PROG_TAHUN2;
        $kthn3        = $param1->INDIPROG_TARGET_KINERJA_PROG_TAHUN3;
        $kthn4        = $param1->INDIPROG_TARGET_KINERJA_PROG_TAHUN4;
        $kthn5        = $param1->INDIPROG_TARGET_KINERJA_PROG_TAHUN5;


        if (strlen($indiprog) == 0 or strlen($satuanindiprog) == 0) {
          $tes["status"] = "INDIKATOR DAN SATUAN HARUS DIISI";
        } else {
          $sql2 = "";
          // indikator untuk level program dan kegiatan harus berbeda tidak boleh ada yang sama kecuali  untuk program dan kegiatan rutin (konfirmasi lagi)
          // $sql2="SELECT * FROM indikator_program_jangka_menengah WHERE prt_id=".$param1->INDIPROG_PRT_ID." AND Indikator_program ='".$indiprog."'";
          $sql2 = "SELECT * FROM indikator_program_jangka_menengah WHERE Indikator_program ='" . $indiprog . "'";

          // $result2 = mysql_query($sql2);
          $result2 = bmysqli_query($conn, $sql2);
          // num rows
          // $numrows2 = mysql_num_rows($result2);
          $numrows2 = bmysqli_num_rows($result2);

          $sql4 = "";
          $sql4 = "SELECT * FROM indikator_kegiatan_jangka_menengah WHERE Indikator_kegiatan ='" . $indiprog . "'";

          // $result2 = mysql_query($sql2);
          $result4 = bmysqli_query($conn, $sql4);
          // num rows
          // $numrows2 = mysql_num_rows($result2);
          $numrows4 = bmysqli_num_rows($result4);

          if ($numrows2 == 0 && $numrows4 == 0) {
            // $tes["status"] = "INDIKATOR BLM ADA ".$numrows2." ".$sql2;
            //tambah indikator 

            $sql3 = "INSERT INTO indikator_program_jangka_menengah (proses_renstra, Indikator_program,satuan_indikator_program, opd_id, sub_opd_id, urs_id, bid_urs_id, prog_id, prg_full,prt_id,kinerja_awal_program,target_akhir_kinerja_program,target_kinerja_prog_tahun1,target_kinerja_prog_tahun2, target_kinerja_prog_tahun3, target_kinerja_prog_tahun4, target_kinerja_prog_tahun5) VALUES (1, '" . $indiprog . "','" . $satuanindiprog . "'," . $opd_id . "," . $sub_opd_id . "," . substr($prgfull, 0, 2) . "," . substr($prgfull, 2, 2) . "," . substr($prgfull, 4, 2) . "," . $prgfull . "," . $prtid . ",'" . $kawal . "','" . $kakhir . "','" . $kthn1 . "','" . $kthn2 . "','" . $kthn3 . "','" . $kthn4 . "','" . $kthn5 . "')";

            // $tes["status"]  = $sql3;
            // $result3		= mysql_query($sql3);			// True/Resource on success, False on error
            $result3     = bmysqli_query($conn, $sql3);
            $num_result3  = bmysqli_affected_rows($conn);  // Returns the number of affected rows on success, and -1 if the last query failed

            if ($num_result3 < 0) {
              $tes["status"] = "Tambah indikator Program gagal";
            }
          } else {
            $tes["status"] = "INDIKATOR SUDAH ADA/DIGUNAKAN";
          }
        }
        // $tes["status"] ="masuk di add ".strlen($indiprog);
      } elseif ($action == "edit") {
        // $tes["status"] ="masuk di edit indikator";

        $indiprog      = trim($param1->INDIPROG_INDIKATOR_PROGRAM);
        $satuanindiprog   = trim($param1->INDIPROG_SATUAN_INDIKATOR_PROGRAM);
        $row_id         = $param1->INDIPROG_ROW_ID;
        $prtid            = $param1->INDIPROG_PRT_ID;
        $opd_id          = $param1->INDIPROG_OPD_ID;
        $sub_opd_id      = $param1->INDIPROG_SUB_OPD_ID;
        $prgfull       = $param1->INDIPROG_PRG_FULL;
        $kawal        = $param1->INDIPROG_KINERJA_AWAL_PROGRAM;
        $kakhir        = $param1->INDIPROG_TARGET_AKHIR_KINERJA_PROGRAM;
        $kthn1        = $param1->INDIPROG_TARGET_KINERJA_PROG_TAHUN1;
        $kthn2        = $param1->INDIPROG_TARGET_KINERJA_PROG_TAHUN2;
        $kthn3        = $param1->INDIPROG_TARGET_KINERJA_PROG_TAHUN3;
        $kthn4        = $param1->INDIPROG_TARGET_KINERJA_PROG_TAHUN4;
        $kthn5        = $param1->INDIPROG_TARGET_KINERJA_PROG_TAHUN5;

        if (strlen($indiprog) == 0 or strlen($satuanindiprog) == 0) {
          $tes["status"] = "INDIKATOR DAN SATUAN HARUS DIISI";
        } else {
          $sql2 = "";
          // $sql2="SELECT * FROM indikator_program_jangka_menengah WHERE row_id <> ".$row_id." AND prt_id=".$prtid." AND Indikator_program ='".$indiprog."'";
          $sql2 = "SELECT * FROM indikator_program_jangka_menengah WHERE row_id <> " . $row_id . " AND Indikator_program ='" . $indiprog . "'";

          // $result2 = mysql_query($sql2);
          $result2  = bmysqli_query($conn, $sql2);
          // num rows
          // $numrows2 = mysql_num_rows($result2);
          $numrows2 = bmysqli_num_rows($result2);

          if ($numrows2 == 0) {
            // $tes["status"] = "INDIKATOR BLM ADA ".$numrows2." ".$sql2;
            //tambah indikator 

            $sql3 = "UPDATE indikator_program_jangka_menengah SET Indikator_program='" . $indiprog . "',satuan_indikator_program='" . $satuanindiprog . "', kinerja_awal_program='" . $kawal . "',target_akhir_kinerja_program='" . $kakhir . "',target_kinerja_prog_tahun1='" . $kthn1 . "',target_kinerja_prog_tahun2='" . $kthn2 . "',target_kinerja_prog_tahun3='" . $kthn3 . "',target_kinerja_prog_tahun4='" . $kthn4 . "',target_kinerja_prog_tahun5='" . $kthn5 . "' WHERE row_id=" . $row_id;

            // $tes["status"]  = $sql3;
            // $result3		= mysql_query($sql3);			// True/Resource on success, False on error
            $result3     = bmysqli_query($conn, $sql3);
            $num_result3  = bmysqli_affected_rows($conn);  // Returns the number of affected rows on success, and -1 if the last query failed

            if ($num_result3 < 0) {
              $tes["status"] = "Edit Indikator Program Gagal";
            }
          } else {
            $tes["status"] = "INDIKATOR SUDAH ADA/DIGUNAKAN";
          }
        }
        // akhir
      } elseif ($action == "delete") {
        // $row_id =0;
        $row_id         = $param1->INDIPROG_ROW_ID;

        $sql2 = "DELETE FROM indikator_program_jangka_menengah WHERE row_id=" . $row_id;
        // $result2		= mysql_query($sql2);			// True/Resource on success, False on error
        $result2     = bmysqli_query($conn, $sql2);
        $num_result2   = bmysqli_affected_rows($conn);  // Returns the number of affected rows on success, and -1 if the last query failed

        if ($num_result2 > 0) {
          // proses setelah delete jika ada

        } else {
          $tes["status"] = "Proses Hapus Gagal";
        }

        // $tes["status"] = "masuk di delete indikator ".$row_id;
      }
    } elseif ($lvl == "kegiatan") {
      if ($action == "add") {
        $prtid     = $param1->KEG_PRT_ID;
        $opd_id      = $param1->KEG_OPD_ID;
        $sub_opd_id  = $param1->KEG_SUB_OPD_ID;
        $prgfull   = $param1->KEG_PRG_FULL;
        $kegfull   = $param1->KEG_KEG_FULL;
        $deskripsi   = $param1->KEG_DESKRIPSI;

        if (strlen($kegfull) == 0 or strlen($sub_opd_id) == 0) {
          $tes["status"] = "KEGIATAN HARUS DIISI";
        } elseif (strlen($kegfull) == 9) {
          // $tes["status"] = "masuk di kegiatan add cek duplicate";
          // cek duplicate 

          $sqltes = "SELECT * FROM kegiatan_jangka_menengah WHERE sub_opd_id= " . $sub_opd_id . " AND keg_full = " . $kegfull;
          // $tes["sqltes"] = $sqltes;
          // $result		= mysql_query($sqltes);			// True/Resource on success, False on error
          $result   = bmysqli_query($conn, $sqltes);
          $num_result = bmysqli_affected_rows($conn);  // Returns the number of affected rows on success, and -1 if the last query failed
          if ($num_result == 0) {
            // $tes["status"] = "Proses tambah kegiatan";
            // Proses tambah kegiatan
            // Kl murni set proses_renstra = 1 dan kl renstra perubahan set proses_p_renstra =1
            // sekarang renstra murni

            $sql = "INSERT INTO kegiatan_jangka_menengah (proses_renstra, prt_id, opd_id, sub_opd_id, prg_full, urs_id, bid_urs_id, prog_id, keg_kode, keg_id, keg_full, deskripsi) VALUES (1, " . $prtid . "," . $opd_id . "," . $sub_opd_id . "," . $prgfull . "," . substr($kegfull, 0, 2) . "," . substr($kegfull, 2, 2) . "," . substr($kegfull, 4, 2) . "," . substr($kegfull, 6, 1) . "," . substr($kegfull, 7, 2) . "," . $kegfull . ",'" . $deskripsi . "')";

            // $sql =  "INSERT INTO kegiatan_jangka_menengah (proses_renstra, prt_id, opd_id, sub_opd_id, prg_full, urs_id, bid_urs_id, prog_id, keg_kode, keg_id,keg_full, deskripsi) VALUES (1, ".$prtid.",".$opd_id.",".$sub_opd_id.",".$prgfull.",".substr($kegfull,0,2);
            // $tes["status"] = $sql;

            // $result1		= mysql_query($sql);			// True/Resource on success, False on error
            $result1     = bmysqli_query($conn, $sql);
            $num_result1  = bmysqli_affected_rows($conn);  // Returns the number of affected rows on success, and -1 if the last query failed
            if ($num_result1 == 0) {
              // $tes["status"] = "Tambah kegiatan gagal";
            }
          } else {
            $tes["status"] = "KEGIATAN SUDAH ADA";
          }
        }

        // $tes["status"] = "masuk di kegiatan add";
      } elseif ($action == "delete") {
        // delete kegiatan

        $row_id         = $param1->KEG_ROW_ID;
        $prtid         = $param1->KEG_PRT_ID;

        $sql        = "DELETE FROM kegiatan_jangka_menengah WHERE row_id=" . $row_id;
        // $result		= mysql_query($sql);			// True/Resource on success, False on error
        $result   = bmysqli_query($conn, $sql);
        $num_result = bmysqli_affected_rows($conn);  // Returns the number of affected rows on success, and -1 if the last query failed

        if ($num_result > 0) {
          // proses delete indikator kegiatan
          $sql1 = "DELETE FROM indikator_kegiatan_jangka_menengah WHERE prt_id=" . $row_id;
          // $result1		= mysql_query($sql1);			// True/Resource on success, False on error
          $result1 = bmysqli_query($conn, $sql1);

          // delete sub kegiatan
          $sql2    = "SELECT row_id FROM subkegiatan_jangka_menengah WHERE prt_id=" . $row_id;
          // $result2  = mysql_query($sql2);
          $result2  = bmysqli_query($conn, $sql2);
          // $numrows2 = mysql_num_rows($result2);
          $numrows2 = bmysqli_num_rows($result2);

          if ($numrows2 > 0) {
            for ($i = 0; $i < $numrows2; $i++) {
              // $row = mysql_fetch_object($result2);
              $row = bmysqli_fetch_object($result2);

              //delete indikator sub kegiatan 
              $sql3     = "DELETE FROM indikator_subkegiatan_jangka_menengah WHERE prt_id=" . $row->row_id;
              // $result3	= mysql_query($sql3);			// True/Resource on success, False on error		
              $result3 = bmysqli_query($conn, $sql3);
            }
          }

          // delete sub kegiatan
          $sql4      = "DELETE FROM subkegiatan_jangka_menengah WHERE prt_id=" . $row_id;
          // $result4	 = mysql_query($sql4);			// True/Resource on success, False on error
          $result4 = bmysqli_query($conn, $sql4);
          // $num_result4 = mysql_affected_rows();	// Returns the number of affected rows on success, and -1 if the last query failed


          // update program
          $sql2 = "SELECT SUM(target_akhir_pagu_kegiatan) AS target_akhir_pagu, sum(target_pagu_keg_tahun1) AS thn1, sum(target_pagu_keg_tahun2) AS thn2, sum(target_pagu_keg_tahun3) AS thn3, sum(target_pagu_keg_tahun4) AS thn4, sum(target_pagu_keg_tahun5) AS thn5 FROM kegiatan_jangka_menengah WHERE prt_id = " . $prtid;
          // $result2  = mysql_query($sql2);
          $result2  = bmysqli_query($conn, $sql2);
          // $numrows2 = mysql_num_rows($result2);
          $numrows2 = bmysqli_num_rows($result2);

          $takhir = 0;
          $thn1   = 0;
          $thn2   = 0;
          $thn3   = 0;
          $thn4   = 0;
          $thn5   = 0;

          if ($numrows2 > 0) {
            for ($i = 0; $i < $numrows2; $i++) {
              // $row = mysql_fetch_object($result2);	
              $row = bmysqli_fetch_object($result2);
              $thn1  = $row->thn1;
              $thn2  = $row->thn2;
              $thn3  = $row->thn3;
              $thn4  = $row->thn4;
              $thn5  = $row->thn5;
              $takhir  = $thn1 + $thn2 + $thn3 + $thn4 + $thn5;
            }

            $sql4 = "UPDATE program_jangka_menengah SET";
            $sql4 .= " ";
            $sql4 .= "target_akhir_pagu_program='" . $takhir . "',";
            $sql4 .= "target_pagu_prog_tahun1='" . $thn1 . "',";
            $sql4 .= "target_pagu_prog_tahun2='" . $thn2 . "',";
            $sql4 .= "target_pagu_prog_tahun3='" . $thn3 . "',";
            $sql4 .= "target_pagu_prog_tahun4='" . $thn4 . "',";
            $sql4 .= "target_pagu_prog_tahun5='" . $thn5 . "'";
            $sql4 .= " ";
            $sql4 .= "WHERE row_id='" . $prtid . "'";
            // $result4		= mysql_query($sql4);
            $result4 = bmysqli_query($conn, $sql4);
          }
        } else {
          $tes["status"] = "Proses Hapus Gagal";
        }

        // $tes["status"] = "masuk di delete kegiatan ".$row_id."   ".$prtid;
      }
    } elseif ($lvl == "indikeg") {
      if ($action == "add") {
        // $tes["status"] = "masuk di add indikeg";
        $indikeg      = trim($param1->INDIKEG_INDIKATOR_KEGIATAN);
        $satuanindikeg     = trim($param1->INDIKEG_SATUAN_INDIKATOR_KEGIATAN);
        $prtid            = $param1->INDIKEG_PRT_ID;
        $opd_id          = $param1->INDIKEG_OPD_ID;
        $sub_opd_id      = $param1->INDIKEG_SUB_OPD_ID;
        $prgfull       = $param1->INDIKEG_PRG_FULL;
        $kegfull       = $param1->INDIKEG_KEG_FULL;
        $kawal        = $param1->INDIKEG_KINERJA_AWAL_KEGIATAN;
        $kakhir        = $param1->INDIKEG_TARGET_AKHIR_KINERJA_KEGIATAN;
        $kthn1        = $param1->INDIKEG_TARGET_KINERJA_KEG_TAHUN1;
        $kthn2        = $param1->INDIKEG_TARGET_KINERJA_KEG_TAHUN2;
        $kthn3        = $param1->INDIKEG_TARGET_KINERJA_KEG_TAHUN3;
        $kthn4        = $param1->INDIKEG_TARGET_KINERJA_KEG_TAHUN4;
        $kthn5        = $param1->INDIKEG_TARGET_KINERJA_KEG_TAHUN5;


        if (strlen($indikeg) == 0 or strlen($satuanindikeg) == 0) {
          $tes["status"] = "INDIKATOR DAN SATUAN HARUS DIISI";
        } else {
          $sql2 = "";
          // $sql2="SELECT * FROM indikator_kegiatan_jangka_menengah WHERE prt_id=".$prtid." AND Indikator_kegiatan ='".$indikeg."'";
          $sql2 = "SELECT * FROM indikator_kegiatan_jangka_menengah WHERE prt_id=" . $prtid . " AND Indikator_kegiatan ='" . $indikeg . "'";

          // $result2 = mysql_query($sql2);
          $result2 = bmysqli_query($conn, $sql2);
          // num rows
          // $numrows2 = mysql_num_rows($result2);
          $numrows2 = bmysqli_num_rows($result2);

          // cek indikator program apakah sudah ada? kl tidak bisa dimasukkan lagi
          $sql4 = "";
          $sql4 = "SELECT * FROM indikator_program_jangka_menengah WHERE Indikator_program ='" . $indikeg . "'";

          // $result2 = mysql_query($sql2);
          $result4 = bmysqli_query($conn, $sql4);
          // num rows
          // $numrows2 = mysql_num_rows($result2);
          $numrows4 = bmysqli_num_rows($result4);

          if ($numrows2 == 0 && $numrows4 == 0) {
            // $tes["status"] = "INDIKATOR BLM ADA ".$numrows2." ".$sql2;
            //tambah indikator 
            $sql3 = "INSERT INTO indikator_kegiatan_jangka_menengah SET";
            $sql3 .= " ";
            $sql3 .= "proses_renstra='1',";
            $sql3 .= "Indikator_kegiatan='" . $indikeg . "',";
            $sql3 .= "satuan_indikator_kegiatan='" . $satuanindikeg . "',";
            $sql3 .= "opd_id='" . $opd_id . "',";
            $sql3 .= "sub_opd_id='" . $sub_opd_id . "',";
            $sql3 .= "urs_id='" . substr($kegfull, 0, 2) . "',";
            $sql3 .= "bid_urs_id='" . substr($kegfull, 2, 2) . "',";
            $sql3 .= "prog_id='" . substr($kegfull, 4, 2) . "',";
            $sql3 .= "keg_kode='" . substr($kegfull, 6, 1) . "',";
            $sql3 .= "keg_id='" . substr($kegfull, 7, 2) . "',";
            $sql3 .= "prg_full='" . $prgfull . "',";
            $sql3 .= "keg_full='" . $kegfull . "',";
            $sql3 .= "prt_id='" . $prtid . "',";
            $sql3 .= "kinerja_awal_kegiatan='" . $kawal . "',";
            $sql3 .= "target_akhir_kinerja_kegiatan='" . $kakhir . "',";
            $sql3 .= "target_kinerja_keg_tahun1='" . $kthn1 . "',";
            $sql3 .= "target_kinerja_keg_tahun2='" . $kthn2 . "',";
            $sql3 .= "target_kinerja_keg_tahun3='" . $kthn3 . "',";
            $sql3 .= "target_kinerja_keg_tahun4='" . $kthn4 . "',";
            $sql3 .= "target_kinerja_keg_tahun5='" . $kthn5 . "'";

            // $tes["status"]  = $sql3;
            // $result3		= mysql_query($sql3);			// True/Resource on success, False on error
            $result3     = bmysqli_query($conn, $sql3);
            $num_result3  = bmysqli_affected_rows($conn);  // Returns the number of affected rows on success, and -1 if the last query failed

            if ($num_result3 == 0) {
              $tes["status"] = "Tambah indikator Kegiatan gagal";
            }
          } else {
            $tes["status"] = "INDIKATOR SUDAH ADA";
          }
        }
      } elseif ($action == "edit") {
        // $tes["status"] = "masuk di edit indikeg";

        $indikeg      = trim($param1->INDIKEG_INDIKATOR_KEGIATAN);
        $satuanindikeg     = trim($param1->INDIKEG_SATUAN_INDIKATOR_KEGIATAN);
        $row_id            = $param1->INDIKEG_ROW_ID;
        $prtid            = $param1->INDIKEG_PRT_ID;
        $opd_id          = $param1->INDIKEG_OPD_ID;
        $sub_opd_id      = $param1->INDIKEG_SUB_OPD_ID;
        $prgfull       = $param1->INDIKEG_PRG_FULL;
        $kegfull       = $param1->INDIKEG_KEG_FULL;
        $kawal        = $param1->INDIKEG_KINERJA_AWAL_KEGIATAN;
        $kakhir        = $param1->INDIKEG_TARGET_AKHIR_KINERJA_KEGIATAN;
        $kthn1        = $param1->INDIKEG_TARGET_KINERJA_KEG_TAHUN1;
        $kthn2        = $param1->INDIKEG_TARGET_KINERJA_KEG_TAHUN2;
        $kthn3        = $param1->INDIKEG_TARGET_KINERJA_KEG_TAHUN3;
        $kthn4        = $param1->INDIKEG_TARGET_KINERJA_KEG_TAHUN4;
        $kthn5        = $param1->INDIKEG_TARGET_KINERJA_KEG_TAHUN5;

        if (strlen($indikeg) == 0 or strlen($satuanindikeg) == 0) {
          $tes["status"] = "INDIKATOR DAN SATUAN HARUS DIISI";
        } else {
          $sql2 = "";
          $sql2 = "SELECT * FROM indikator_kegiatan_jangka_menengah WHERE row_id <> " . $row_id . " AND prt_id=" . $prtid . " AND Indikator_kegiatan ='" . $indikeg . "'";
          // $result2 = mysql_query($sql2);
          $result2 = bmysqli_query($conn, $sql2);
          // num rows
          // $numrows2 = mysql_num_rows($result2);
          $numrows2 = bmysqli_num_rows($result2);

          if ($numrows2 == 0) {

            //tambah indikator 
            $sql3 = "UPDATE indikator_kegiatan_jangka_menengah SET";
            $sql3 .= " ";
            $sql3 .= "Indikator_kegiatan='" . $indikeg . "',";
            $sql3 .= "satuan_indikator_kegiatan='" . $satuanindikeg . "',";
            $sql3 .= "kinerja_awal_kegiatan='" . $kawal . "',";
            $sql3 .= "target_akhir_kinerja_kegiatan='" . $kakhir . "',";
            $sql3 .= "target_kinerja_keg_tahun1='" . $kthn1 . "',";
            $sql3 .= "target_kinerja_keg_tahun2='" . $kthn2 . "',";
            $sql3 .= "target_kinerja_keg_tahun3='" . $kthn3 . "',";
            $sql3 .= "target_kinerja_keg_tahun4='" . $kthn4 . "',";
            $sql3 .= "target_kinerja_keg_tahun5='" . $kthn5 . "'";
            $sql3 .= " ";
            $sql3 .= "WHERE row_id='" . $row_id . "'";

            // $tes["status"]  = $sql3;
            // $result3		= mysql_query($sql3);			// True/Resource on success, False on error
            $result3     = bmysqli_query($conn, $sql3);
            $num_result3  = bmysqli_affected_rows($conn);  // Returns the number of affected rows on success, and -1 if the last query failed

            if (!$result3) {
              $tes["status"] = "Edit Indikator Kegiatan Gagal";
            }
          } else {
            $tes["status"] = "INDIKATOR SUDAH ADA";
          }
        }
      } elseif ($action == "delete") {
        // $tes["status"] = "masuk di delete indikeg";

        $row_id            = $param1->INDIKEG_ROW_ID;
        $sql2 = "DELETE FROM indikator_kegiatan_jangka_menengah WHERE row_id=" . $row_id;
        // $result2		= mysql_query($sql2);			// True/Resource on success, False on error
        $result2 = bmysqli_query($conn, $sql2);
        $num_result2   = bmysqli_affected_rows($conn);  // Returns the number of affected rows on success, and -1 if the last query failed

        if ($num_result2 > 0) {
          // proses child

        } else {
          $tes["status"] = "Proses Hapus Gagal";
        }
      }
    } elseif ($lvl == "subkeg") {
      if ($action == "add") {
        // $tes["status"] = "masuk di add sub keg";
        $prtid     = $param1->SUBKEG_PRT_ID;
        $prtprtid   = $param1->SUBKEG_PRTPRT_ID;
        $opd_id      = $param1->SUBKEG_OPD_ID;
        $sub_opd_id  = $param1->SUBKEG_SUB_OPD_ID;
        $kegfull   = $param1->SUBKEG_KEG_FULL;
        $prgfull   = substr($kegfull, 0, 6);
        $subkegfull  = $param1->SUBKEG_SUBKEG_FULL;
        $deskripsi   = $param1->SUBKEG_DESKRIPSI;
        $pagu1    = $param1->SUBKEG_TARGET_PAGU_SUBKEG_TAHUN1;
        $pagu2    = $param1->SUBKEG_TARGET_PAGU_SUBKEG_TAHUN2;
        $pagu3    = $param1->SUBKEG_TARGET_PAGU_SUBKEG_TAHUN3;
        $pagu4    = $param1->SUBKEG_TARGET_PAGU_SUBKEG_TAHUN4;
        $pagu5    = $param1->SUBKEG_TARGET_PAGU_SUBKEG_TAHUN5;
        $target_akhir_pagu = $pagu1 + $pagu2 + $pagu3 + $pagu4 + $pagu5;

        if (strlen($subkegfull) == 0 or strlen($sub_opd_id) == 0) {
          $tes["status"] = "SUB KEGIATAN HARUS DIISI";
        } elseif (strlen($subkegfull) == 12) {
          // $tes["status"] = "masuk di sub kegiatan add cek duplicate";
          // cek duplicate 

          $sqltes = "SELECT * FROM subkegiatan_jangka_menengah WHERE sub_opd_id= " . $sub_opd_id . " AND subkeg_full = " . $subkegfull;
          // $tes["sqltes"] = $sqltes;
          // $result		= mysql_query($sqltes);			// True/Resource on success, False on error
          $result = bmysqli_query($conn, $sqltes);
          $num_result = bmysqli_affected_rows($conn);  // Returns the number of affected rows on success, and -1 if the last query failed
          if ($num_result == 0) {
            // $tes["status"] = "Proses tambah kegiatan";
            // Proses tambah kegiatan
            // Kl murni set proses_renstra = 1 dan kl renstra perubahan set proses_p_renstra =1
            // sekarang renstra murni				


            $sql3 = "INSERT INTO subkegiatan_jangka_menengah SET";
            $sql3 .= " ";
            $sql3 .= "proses_renstra='1',";
            $sql3 .= "prt_id='" . $prtid . "',";
            $sql3 .= "prtprt_id='" . $prtprtid . "',";
            $sql3 .= "opd_id='" . $opd_id . "',";
            $sql3 .= "sub_opd_id='" . $sub_opd_id . "',";
            $sql3 .= "urs_id='" . substr($subkegfull, 0, 2) . "',";
            $sql3 .= "bid_urs_id='" . substr($subkegfull, 2, 2) . "',";
            $sql3 .= "prog_id='" . substr($subkegfull, 4, 2) . "',";
            $sql3 .= "keg_kode='" . substr($subkegfull, 6, 1) . "',";
            $sql3 .= "keg_id='" . substr($subkegfull, 7, 2) . "',";
            $sql3 .= "subkeg_id='" . substr($subkegfull, 9, 3) . "',";
            $sql3 .= "prg_full='" . $prgfull . "',";
            $sql3 .= "keg_full='" . $kegfull . "',";
            $sql3 .= "subkeg_full='" . $subkegfull . "',";
            $sql3 .= "deskripsi='" . $deskripsi . "',";
            $sql3 .= "target_akhir_pagu_subkegiatan='" . $target_akhir_pagu . "',";
            $sql3 .= "target_pagu_subkeg_tahun1='" . $pagu1 . "',";
            $sql3 .= "target_pagu_subkeg_tahun2='" . $pagu2 . "',";
            $sql3 .= "target_pagu_subkeg_tahun3='" . $pagu3 . "',";
            $sql3 .= "target_pagu_subkeg_tahun4='" . $pagu4 . "',";
            $sql3 .= "target_pagu_subkeg_tahun5='" . $pagu5 . "'";

            // $result1		= mysql_query($sql3);			// True/Resource on success, False on error
            $result1 = bmysqli_query($conn, $sql3);
            $num_result1  = bmysqli_affected_rows($conn);  // Returns the number of affected rows on success, and -1 if the last query failed
            if ($num_result1 > 0) {
              // update lvl kegiatan							
              $sql2 = "SELECT SUM(target_akhir_pagu_subkegiatan) AS target_akhir_pagu, sum(target_pagu_subkeg_tahun1) AS thn1, sum(target_pagu_subkeg_tahun2) AS thn2, sum(target_pagu_subkeg_tahun3) AS thn3, sum(target_pagu_subkeg_tahun4) AS thn4, sum(target_pagu_subkeg_tahun5) AS thn5 FROM subkegiatan_jangka_menengah WHERE prt_id = " . $prtid;
              // $result2  = mysql_query($sql2);
              $result2 = bmysqli_query($conn, $sql2);
              // $numrows2 = mysql_num_rows($result2);
              $numrows2 = bmysqli_num_rows($result2);

              $takhir = 0;
              $thn1   = 0;
              $thn2   = 0;
              $thn3   = 0;
              $thn4   = 0;
              $thn5   = 0;

              if ($numrows2 > 0) {
                for ($i = 0; $i < $numrows2; $i++) {
                  // $row = mysql_fetch_object($result2);	
                  $row = bmysqli_fetch_object($result2);
                  $thn1  = $row->thn1;
                  $thn2  = $row->thn2;
                  $thn3  = $row->thn3;
                  $thn4  = $row->thn4;
                  $thn5  = $row->thn5;
                  $takhir  = $thn1 + $thn2 + $thn3 + $thn4 + $thn5;
                }
                $sql4 = "UPDATE kegiatan_jangka_menengah SET";
                $sql4 .= " ";
                $sql4 .= "target_akhir_pagu_kegiatan='" . $takhir . "',";
                $sql4 .= "target_pagu_keg_tahun1='" . $thn1 . "',";
                $sql4 .= "target_pagu_keg_tahun2='" . $thn2 . "',";
                $sql4 .= "target_pagu_keg_tahun3='" . $thn3 . "',";
                $sql4 .= "target_pagu_keg_tahun4='" . $thn4 . "',";
                $sql4 .= "target_pagu_keg_tahun5='" . $thn5 . "'";
                $sql4 .= " ";
                $sql4 .= "WHERE row_id='" . $prtid . "'";
                // $result4		= mysql_query($sql4);
                $result4 = bmysqli_query($conn, $sql4);
              }


              // akhir update kegiatan

              // update program
              $sql2 = "SELECT SUM(target_akhir_pagu_kegiatan) AS target_akhir_pagu, sum(target_pagu_keg_tahun1) AS thn1, sum(target_pagu_keg_tahun2) AS thn2, sum(target_pagu_keg_tahun3) AS thn3, sum(target_pagu_keg_tahun4) AS thn4, sum(target_pagu_keg_tahun5) AS thn5 FROM kegiatan_jangka_menengah WHERE prt_id = " . $prtprtid;
              // $result2  = mysql_query($sql2);
              $result2  = bmysqli_query($conn, $sql2);
              // $numrows2 = mysql_num_rows($result2);
              $numrows2 = bmysqli_num_rows($result2);

              $takhir = 0;
              $thn1   = 0;
              $thn2   = 0;
              $thn3   = 0;
              $thn4   = 0;
              $thn5   = 0;

              if ($numrows2 > 0) {
                for ($i = 0; $i < $numrows2; $i++) {
                  // $row = mysql_fetch_object($result2);	
                  $row = bmysqli_fetch_object($result2);
                  $thn1  = $row->thn1;
                  $thn2  = $row->thn2;
                  $thn3  = $row->thn3;
                  $thn4  = $row->thn4;
                  $thn5  = $row->thn5;
                  $takhir  = $thn1 + $thn2 + $thn3 + $thn4 + $thn5;
                }

                $sql4 = "UPDATE program_jangka_menengah SET";
                $sql4 .= " ";
                $sql4 .= "target_akhir_pagu_program='" . $takhir . "',";
                $sql4 .= "target_pagu_prog_tahun1='" . $thn1 . "',";
                $sql4 .= "target_pagu_prog_tahun2='" . $thn2 . "',";
                $sql4 .= "target_pagu_prog_tahun3='" . $thn3 . "',";
                $sql4 .= "target_pagu_prog_tahun4='" . $thn4 . "',";
                $sql4 .= "target_pagu_prog_tahun5='" . $thn5 . "'";
                $sql4 .= " ";
                $sql4 .= "WHERE row_id='" . $prtprtid . "'";
                // $result4		= mysql_query($sql4);
                $result4 = bmysqli_query($conn, $sql4);
              }
            } else {
              $tes["status"] = "Tambah sub kegiatan gagal";
            }
          } else {
            $tes["status"] = "SUB KEGIATAN SUDAH ADA ";
          }
        }
      } elseif ($action == "edit") {
        $rowid     = $param1->SUBKEG_ROW_ID;
        $prtid     = $param1->SUBKEG_PRT_ID;
        $prtprtid   = $param1->SUBKEG_PRTPRT_ID;
        $pagu1    = $param1->SUBKEG_TARGET_PAGU_SUBKEG_TAHUN1;
        $pagu2    = $param1->SUBKEG_TARGET_PAGU_SUBKEG_TAHUN2;
        $pagu3    = $param1->SUBKEG_TARGET_PAGU_SUBKEG_TAHUN3;
        $pagu4    = $param1->SUBKEG_TARGET_PAGU_SUBKEG_TAHUN4;
        $pagu5    = $param1->SUBKEG_TARGET_PAGU_SUBKEG_TAHUN5;
        $target_akhir_pagu = $pagu1 + $pagu2 + $pagu3 + $pagu4 + $pagu5;


        $sql3 = "UPDATE subkegiatan_jangka_menengah SET";
        $sql3 .= " ";
        $sql3 .= "target_akhir_pagu_subkegiatan='" . $target_akhir_pagu . "',";
        $sql3 .= "target_pagu_subkeg_tahun1='" . $pagu1 . "',";
        $sql3 .= "target_pagu_subkeg_tahun2='" . $pagu2 . "',";
        $sql3 .= "target_pagu_subkeg_tahun3='" . $pagu3 . "',";
        $sql3 .= "target_pagu_subkeg_tahun4='" . $pagu4 . "',";
        $sql3 .= "target_pagu_subkeg_tahun5='" . $pagu5 . "'";
        $sql3 .= " ";
        $sql3 .= "WHERE row_id='" . $rowid . "'";
        // $tes["sqltes"]  = $sql;
        // $result1		= mysql_query($sql3);			// True/Resource on success, False on error
        $result1 = bmysqli_query($conn, $sql3);
        $num_result1  = bmysqli_affected_rows($conn);  // Returns the number of affected rows on success, and -1 if the last query failed
        if ($result1) {
          // update lvl kegiatan							
          $sql2 = "SELECT SUM(target_akhir_pagu_subkegiatan) AS target_akhir_pagu, sum(target_pagu_subkeg_tahun1) AS thn1, sum(target_pagu_subkeg_tahun2) AS thn2, sum(target_pagu_subkeg_tahun3) AS thn3, sum(target_pagu_subkeg_tahun4) AS thn4, sum(target_pagu_subkeg_tahun5) AS thn5 FROM subkegiatan_jangka_menengah WHERE prt_id = " . $prtid;
          // $result2  = mysql_query($sql2);
          $result2 = bmysqli_query($conn, $sql2);
          // $numrows2 = mysql_num_rows($result2);
          $numrows2 = bmysqli_num_rows($result2);

          $takhir = 0;
          $thn1   = 0;
          $thn2   = 0;
          $thn3   = 0;
          $thn4   = 0;
          $thn5   = 0;

          if ($numrows2 > 0) {
            for ($i = 0; $i < $numrows2; $i++) {
              // $row = mysql_fetch_object($result2);
              $row = bmysqli_fetch_object($result2);
              $thn1  = $row->thn1;
              $thn2  = $row->thn2;
              $thn3  = $row->thn3;
              $thn4  = $row->thn4;
              $thn5  = $row->thn5;
              $takhir  = $thn1 + $thn2 + $thn3 + $thn4 + $thn5;
            }
            $sql4 = "UPDATE kegiatan_jangka_menengah SET";
            $sql4 .= " ";
            $sql4 .= "target_akhir_pagu_kegiatan='" . $takhir . "',";
            $sql4 .= "target_pagu_keg_tahun1='" . $thn1 . "',";
            $sql4 .= "target_pagu_keg_tahun2='" . $thn2 . "',";
            $sql4 .= "target_pagu_keg_tahun3='" . $thn3 . "',";
            $sql4 .= "target_pagu_keg_tahun4='" . $thn4 . "',";
            $sql4 .= "target_pagu_keg_tahun5='" . $thn5 . "'";
            $sql4 .= " ";
            $sql4 .= "WHERE row_id='" . $prtid . "'";
            // $result4		= mysql_query($sql4);
            $result4 = bmysqli_query($conn, $sql4);
          }

          // update program
          $sql2 = "SELECT SUM(target_akhir_pagu_kegiatan) AS target_akhir_pagu, sum(target_pagu_keg_tahun1) AS thn1, sum(target_pagu_keg_tahun2) AS thn2, sum(target_pagu_keg_tahun3) AS thn3, sum(target_pagu_keg_tahun4) AS thn4, sum(target_pagu_keg_tahun5) AS thn5 FROM kegiatan_jangka_menengah WHERE prt_id = " . $prtprtid;
          // $result2  = mysql_query($sql2);
          $result2 = bmysqli_query($conn, $sql2);
          // $numrows2 = mysql_num_rows($result2);
          $numrows2 = bmysqli_num_rows($result2);

          $takhir = 0;
          $thn1   = 0;
          $thn2   = 0;
          $thn3   = 0;
          $thn4   = 0;
          $thn5   = 0;

          if ($numrows2 > 0) {
            for ($i = 0; $i < $numrows2; $i++) {
              // $row = mysql_fetch_object($result2);	
              $row = bmysqli_fetch_object($result2);
              $thn1  = $row->thn1;
              $thn2  = $row->thn2;
              $thn3  = $row->thn3;
              $thn4  = $row->thn4;
              $thn5  = $row->thn5;
              $takhir  = $thn1 + $thn2 + $thn3 + $thn4 + $thn5;
            }

            $sql4 = "UPDATE program_jangka_menengah SET";
            $sql4 .= " ";
            $sql4 .= "target_akhir_pagu_program='" . $takhir . "',";
            $sql4 .= "target_pagu_prog_tahun1='" . $thn1 . "',";
            $sql4 .= "target_pagu_prog_tahun2='" . $thn2 . "',";
            $sql4 .= "target_pagu_prog_tahun3='" . $thn3 . "',";
            $sql4 .= "target_pagu_prog_tahun4='" . $thn4 . "',";
            $sql4 .= "target_pagu_prog_tahun5='" . $thn5 . "'";
            $sql4 .= " ";
            $sql4 .= "WHERE row_id='" . $prtprtid . "'";
            // $result4		= mysql_query($sql4);
            $result4 = bmysqli_query($conn, $sql4);
          }
          // $tes["status"] = "Edit Sub Kegiatan ";

        } else {
          $tes["status"] = "Edit Sub Kegiatan Gagal ";
        }
      } elseif ($action == "delete") {
        // $tes["status"] = "delete sub kegiatan ";
        $rowid     = $param1->SUBKEG_ROW_ID;
        $prtid     = $param1->SUBKEG_PRT_ID;
        $prtprtid   = $param1->SUBKEG_PRTPRT_ID;

        $sql     = "DELETE FROM subkegiatan_jangka_menengah WHERE row_id=" . $rowid;
        // $result		= mysql_query($sql);			// True/Resource on success, False on error
        $result   = bmysqli_query($conn, $sql);
        $num_result = bmysqli_affected_rows($conn);  // Returns the number of affected rows on success, and -1 if the last query failed

        if ($num_result > 0) {
          // delete indikator sub kegiatan
          $sql2     = "DELETE FROM indikator_subkegiatan_jangka_menengah WHERE prt_id=" . $rowid;
          // $result2	= mysql_query($sql2);			// True/Resource on success, False on error
          $result2 = bmysqli_query($conn, $sql2);


          // update lvl kegiatan	
          $sql2 = "SELECT SUM(target_akhir_pagu_subkegiatan) AS target_akhir_pagu, sum(target_pagu_subkeg_tahun1) AS thn1, sum(target_pagu_subkeg_tahun2) AS thn2, sum(target_pagu_subkeg_tahun3) AS thn3, sum(target_pagu_subkeg_tahun4) AS thn4, sum(target_pagu_subkeg_tahun5) AS thn5 FROM subkegiatan_jangka_menengah WHERE prt_id = " . $prtid;
          // $result2  = mysql_query($sql2);
          $result2 = bmysqli_query($conn, $sql2);
          // $numrows2 = mysql_num_rows($result2);
          $numrows2 = bmysqli_num_rows($result2);

          $takhir = 0;
          $thn1   = 0;
          $thn2   = 0;
          $thn3   = 0;
          $thn4   = 0;
          $thn5   = 0;

          if ($numrows2 > 0) {
            for ($i = 0; $i < $numrows2; $i++) {
              // $row = mysql_fetch_object($result2);
              $row = bmysqli_fetch_object($result2);
              $thn1  = $row->thn1;
              $thn2  = $row->thn2;
              $thn3  = $row->thn3;
              $thn4  = $row->thn4;
              $thn5  = $row->thn5;
              $takhir  = $thn1 + $thn2 + $thn3 + $thn4 + $thn5;
            }
            $sql4 = "UPDATE kegiatan_jangka_menengah SET";
            $sql4 .= " ";
            $sql4 .= "target_akhir_pagu_kegiatan='" . $takhir . "',";
            $sql4 .= "target_pagu_keg_tahun1='" . $thn1 . "',";
            $sql4 .= "target_pagu_keg_tahun2='" . $thn2 . "',";
            $sql4 .= "target_pagu_keg_tahun3='" . $thn3 . "',";
            $sql4 .= "target_pagu_keg_tahun4='" . $thn4 . "',";
            $sql4 .= "target_pagu_keg_tahun5='" . $thn5 . "'";
            $sql4 .= " ";
            $sql4 .= "WHERE row_id='" . $prtid . "'";
            // $result4		= mysql_query($sql4);
            $result4 = bmysqli_query($conn, $sql4);
          }

          // update program
          $sql2 = "SELECT SUM(target_akhir_pagu_kegiatan) AS target_akhir_pagu, sum(target_pagu_keg_tahun1) AS thn1, sum(target_pagu_keg_tahun2) AS thn2, sum(target_pagu_keg_tahun3) AS thn3, sum(target_pagu_keg_tahun4) AS thn4, sum(target_pagu_keg_tahun5) AS thn5 FROM kegiatan_jangka_menengah WHERE prt_id = " . $prtprtid;
          // $result2  = mysql_query($sql2);
          $result2  = bmysqli_query($conn, $sql2);
          // $numrows2 = mysql_num_rows($result2);
          $numrows2 = bmysqli_num_rows($result2);

          $takhir = 0;
          $thn1   = 0;
          $thn2   = 0;
          $thn3   = 0;
          $thn4   = 0;
          $thn5   = 0;

          if ($numrows2 > 0) {
            for ($i = 0; $i < $numrows2; $i++) {
              // $row = mysql_fetch_object($result2);	
              $row = bmysqli_fetch_object($result2);
              $thn1  = $row->thn1;
              $thn2  = $row->thn2;
              $thn3  = $row->thn3;
              $thn4  = $row->thn4;
              $thn5  = $row->thn5;
              $takhir  = $thn1 + $thn2 + $thn3 + $thn4 + $thn5;
            }

            $sql4 = "UPDATE program_jangka_menengah SET";
            $sql4 .= " ";
            $sql4 .= "target_akhir_pagu_program='" . $takhir . "',";
            $sql4 .= "target_pagu_prog_tahun1='" . $thn1 . "',";
            $sql4 .= "target_pagu_prog_tahun2='" . $thn2 . "',";
            $sql4 .= "target_pagu_prog_tahun3='" . $thn3 . "',";
            $sql4 .= "target_pagu_prog_tahun4='" . $thn4 . "',";
            $sql4 .= "target_pagu_prog_tahun5='" . $thn5 . "'";
            $sql4 .= " ";
            $sql4 .= "WHERE row_id='" . $prtprtid . "'";
            // $result4		= mysql_query($sql4);
            $result4 = bmysqli_query($conn, $sql4);
          }
        } else {
          $tes["status"] = "Proses Hapus Sub Kegiatan Gagal";
        }
      }
    } elseif ($lvl == "indisubkeg") {
      if ($action == "add") {
        // $tes["status"] = "add indikator sub kegiatan";
        $indisubkeg      = trim($param1->INDISUBKEG_INDIKATOR_SUBKEGIATAN);
        $satuanindisubkeg  = trim($param1->INDISUBKEG_SATUAN_INDIKATOR_SUBKEGIATAN);
        $prtid            = $param1->INDISUBKEG_PRT_ID;
        $opd_id          = $param1->INDISUBKEG_OPD_ID;
        $sub_opd_id      = $param1->INDISUBKEG_SUB_OPD_ID;
        $subkegfull     = $param1->INDISUBKEG_SUBKEG_FULL;
        $kawal        = $param1->INDISUBKEG_KINERJA_AWAL_SUBKEGIATAN;
        $kakhir        = $param1->INDISUBKEG_TARGET_AKHIR_KINERJA_SUBKEGIATAN;
        $kthn1        = $param1->INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN1;
        $kthn2        = $param1->INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN2;
        $kthn3        = $param1->INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN3;
        $kthn4        = $param1->INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN4;
        $kthn5        = $param1->INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN5;


        if (strlen($indisubkeg) == 0 or strlen($satuanindisubkeg) == 0) {
          $tes["status"] = "INDIKATOR DAN SATUAN HARUS DIISI";
        } else {
          $sql2 = "";
          $sql2 = "SELECT * FROM indikator_subkegiatan_jangka_menengah WHERE prt_id=" . $prtid . " AND Indikator_subkegiatan ='" . $indisubkeg . "'";

          // $result2 = mysql_query($sql2);
          $result2  = bmysqli_query($conn, $sql2);
          // num rows
          // $numrows2 = mysql_num_rows($result2);
          $numrows2 = bmysqli_num_rows($result2);

          if ($numrows2 == 0) {
            // $tes["status"] = "INDIKATOR BLM ADA ".$numrows2." ".$sql2;
            //tambah indikator 
            $sql3 = "INSERT INTO indikator_subkegiatan_jangka_menengah SET";
            $sql3 .= " ";
            $sql3 .= "proses_renstra='1',";
            $sql3 .= "Indikator_subkegiatan='" . $indisubkeg . "',";
            $sql3 .= "satuan_indikator_subkegiatan='" . $satuanindisubkeg . "',";
            $sql3 .= "opd_id='" . $opd_id . "',";
            $sql3 .= "sub_opd_id='" . $sub_opd_id . "',";
            $sql3 .= "urs_id='" . substr($subkegfull, 0, 2) . "',";
            $sql3 .= "bid_urs_id='" . substr($subkegfull, 2, 2) . "',";
            $sql3 .= "prog_id='" . substr($subkegfull, 4, 2) . "',";
            $sql3 .= "keg_kode='" . substr($subkegfull, 6, 1) . "',";
            $sql3 .= "keg_id='" . substr($subkegfull, 7, 2) . "',";
            $sql3 .= "subkeg_id='" . substr($subkegfull, 9, 3) . "',";
            $sql3 .= "prg_full='" . substr($subkegfull, 0, 6) . "',";
            $sql3 .= "keg_full='" . substr($subkegfull, 0, 9) . "',";
            $sql3 .= "subkeg_full='" . $subkegfull . "',";
            $sql3 .= "prt_id='" . $prtid . "',";
            $sql3 .= "kinerja_awal_subkegiatan='" . $kawal . "',";
            $sql3 .= "target_akhir_kinerja_subkegiatan='" . $kakhir . "',";
            $sql3 .= "target_kinerja_subkeg_tahun1='" . $kthn1 . "',";
            $sql3 .= "target_kinerja_subkeg_tahun2='" . $kthn2 . "',";
            $sql3 .= "target_kinerja_subkeg_tahun3='" . $kthn3 . "',";
            $sql3 .= "target_kinerja_subkeg_tahun4='" . $kthn4 . "',";
            $sql3 .= "target_kinerja_subkeg_tahun5='" . $kthn5 . "'";

            // $tes["status"]  = $sql3;
            // $result3		= mysql_query($sql3);			// True/Resource on success, False on error
            $result3 = bmysqli_query($conn, $sql3);
            $num_result3  = bmysqli_affected_rows($conn);  // Returns the number of affected rows on success, and -1 if the last query failed

            if ($num_result3 == 0) {
              $tes["status"] = "Tambah Indikator Sub Kegiatan gagal";
            }
          } else {
            $tes["status"] = "INDIKATOR SUDAH ADA";
          }
        }
      } elseif ($action == "edit") {
        // $tes["status"] = "edit indikator sub kegiatan";

        $indisubkeg      = trim($param1->INDISUBKEG_INDIKATOR_SUBKEGIATAN);
        $satuanindisubkeg  = trim($param1->INDISUBKEG_SATUAN_INDIKATOR_SUBKEGIATAN);
        $rowid            = $param1->INDISUBKEG_ROW_ID;
        $prtid            = $param1->INDISUBKEG_PRT_ID;
        $opd_id          = $param1->INDISUBKEG_OPD_ID;
        $sub_opd_id      = $param1->INDISUBKEG_SUB_OPD_ID;
        $subkegfull     = $param1->INDISUBKEG_SUBKEG_FULL;
        $kawal        = $param1->INDISUBKEG_KINERJA_AWAL_SUBKEGIATAN;
        $kakhir        = $param1->INDISUBKEG_TARGET_AKHIR_KINERJA_SUBKEGIATAN;
        $kthn1        = $param1->INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN1;
        $kthn2        = $param1->INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN2;
        $kthn3        = $param1->INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN3;
        $kthn4        = $param1->INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN4;
        $kthn5        = $param1->INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN5;

        if (strlen($indisubkeg) == 0 or strlen($satuanindisubkeg) == 0) {
          $tes["status"] = "INDIKATOR DAN SATUAN HARUS DIISI";
        } else {
          $sql2 = "";
          $sql2 = "SELECT * FROM indikator_subkegiatan_jangka_menengah WHERE row_id <> " . $rowid . " AND prt_id=" . $prtid . " AND Indikator_subkegiatan ='" . $indisubkeg . "'";
          // $result2 = mysql_query($sql2);
          $result2 = bmysqli_query($conn, $sql2);
          // num rows
          // $numrows2 = mysql_num_rows($result2);
          $numrows2 = bmysqli_num_rows($result2);

          if ($numrows2 == 0) {

            //tambah indikator 
            $sql3 = "UPDATE indikator_subkegiatan_jangka_menengah SET";
            $sql3 .= " ";
            $sql3 .= "Indikator_subkegiatan='" . $indisubkeg . "',";
            $sql3 .= "satuan_indikator_subkegiatan='" . $satuanindisubkeg . "',";
            $sql3 .= "kinerja_awal_subkegiatan='" . $kawal . "',";
            $sql3 .= "target_akhir_kinerja_subkegiatan='" . $kakhir . "',";
            $sql3 .= "target_kinerja_subkeg_tahun1='" . $kthn1 . "',";
            $sql3 .= "target_kinerja_subkeg_tahun2='" . $kthn2 . "',";
            $sql3 .= "target_kinerja_subkeg_tahun3='" . $kthn3 . "',";
            $sql3 .= "target_kinerja_subkeg_tahun4='" . $kthn4 . "',";
            $sql3 .= "target_kinerja_subkeg_tahun5='" . $kthn5 . "'";
            $sql3 .= " ";
            $sql3 .= "WHERE row_id='" . $rowid . "'";

            // $tes["status"]  = $sql3;
            // $result3		= mysql_query($sql3);			// True/Resource on success, False on error
            $result3 = bmysqli_query($conn, $sql3);
            $num_result3  = bmysqli_affected_rows($conn);  // Returns the number of affected rows on success, and -1 if the last query failed

            if (!$result3) {
              $tes["status"] = "Edit Indikator Sub Kegiatan Gagal";
            }
          } else {
            $tes["status"] = "INDIKATOR SUDAH ADA";
          }
        }
      } elseif ($action == "delete") {
        // $tes["status"] = "delete Indikator sub Kegiatan";

        $row_id            = $param1->INDISUBKEG_ROW_ID;
        $sql2 = "DELETE FROM indikator_subkegiatan_jangka_menengah WHERE row_id=" . $row_id;
        // $result2		= mysql_query($sql2);			// True/Resource on success, False on error
        $result2     = bmysqli_query($conn, $sql2);
        $num_result2   = bmysqli_affected_rows($conn);  // Returns the number of affected rows on success, and -1 if the last query failed

        if ($num_result2 > 0) {
          // proses child

        } else {
          $tes["status"] = "Proses Hapus Gagal";
        }
      }
    }
  } else {
    $tes["status"] = "KARENA STATUS DATA " . $sts_renstra;
  }
} else {
  $tes["status"] = "bermasalah";
}






// // echo $tes;
echo json_encode($tes);
