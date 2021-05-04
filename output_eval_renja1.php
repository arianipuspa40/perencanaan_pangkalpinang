<?php
session_start();
$temp_session             = array();

if (isset($_SESSION["USER_SETTING"]["LOGIN"])) {
  $temp_session["SESSION"]     = $_SESSION["USER_SETTING"];
} else {
  header("location:index.php");
}

// koneksi db sudah di panggil di file perencanaan_renstra_entri_murni.php
// connecting to db
require_once("dbconn.php");
$sql = "";

// if (strlen($param_opd) == 11){	
// 	$sql="SELECT * FROM bidang_opd where opd_id="." ".$param_opd;

// }else{
// 	$sql="SELECT * FROM bidang_opd";
// }
// $sql="SELECT * FROM program_jangka_menengah WHERE opd_id='".$temp_session["SESSION"]["OPD_ID"]."' ORDER BY prg_full";
$sql = "SELECT * FROM program_jangka_menengah ORDER BY urs_id, bid_urs_id, sub_opd_id, prog_id";

$result = bmysqli_query($conn, $sql);
// num rows
$numrows = bmysqli_num_rows($result);

// echo "string";
$html = '
<html>
<head>
<style>
body {font-family: sans-serif;
	font-size: 10pt;
}
p {	margin: 0pt; }
table.items {
	border: 0.1mm solid #000000;
}
td { vertical-align: top; }
.items td {
	border-left: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
table tbody td { background-color: #ffffff;	
	font-variant: sans-serif;
}
table thead td { background-color: #5DA7E9;
	text-align: center;
	border: 0.1mm solid #000000;
}

.items td.blanktotal {
	background-color: #EEEEEE;
	border: 0.1mm solid #000000;
	background-color: #FFFFFF;
	border: 0mm none #000000;
	border-top: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
.items td.totals {
	text-align: right;
	border: 0.1mm solid #000000;
}
.items td.cost {
	text-align: "." center;
}
</style>';

// date_default_timezone_set('UTC');
$html .= '

</head>
<body>
<!--mpdf
<htmlpagefooter name="myfooter">
<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
halaman {PAGENO} dari {nb}                  
</div>
</htmlpagefooter>

<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
<sethtmlpagefooter name="myfooter" value="on" />
mpdf-->

<div style="text-align: center"><h3>Indikasi Rencana Program Prioritas yang disertai Kebutuhan Pendanaan<br>Kota Pangkalpinang Tahun 2018 - 2023<br></h3></div>
<div style="text-align: right"><br><small>' . date("Y-m-d ") . '</small></div>

<table class="items" width="120%" style="font-size: 7pt; border-collapse: collapse; " cellpadding="8">

<thead>
<!--
{DATE j-m-Y}
<tr>
	
	<td rowspan="2" ><br></td>
    <td rowspan="2"><br>Sasaran</td>
    <td rowspan="2"><br>Program/ Kegiatan/Sub Kegiatan</td>
    <td rowspan="2">Indikator Kinerja Program (outcome)/ Kegiatan (output)/Sub kegiatan</td>
    <td rowspan="2" colspan="2">Target Renstra Perangkat<br>Daerah pada Tahun 2023</td>
    <th rowspan="2" colspan="2">Realisasi Capaian Kinerja<br>Renstra Perangkat Daerah<br>sampai dengan Renja<br>Perangkat Daerah Tahun 2020</th>
    <th rowspan="2" colspan="2">Target Kinerja dan Anggaran<br>Renja Perangkat Daerah Tahun<br>berjalan 2021</th>
<tr>
-->

<tr>
    <td rowspan="3" width="5%"><h3>Kode</h3></td>
    <td rowspan="3" width="15%"><h3>Bidang Urusan Pemerintahan dan Program Prioritas Pembangunan</h3></td>
    <td rowspan="3" width="12%"><h3>Indikator Kinerja Program (outcome)</h3></td>
    <td rowspan="3" width="5%"><h3>Kondisi Kinerja  Awal RPJMD</h3></td>
    <td colspan="10" width="46%"><h3>Target</h3></td>
    <td colspan="2" rowspan="2" width="10%"><h3>Kondisi Kinerja pada akhir periode RPJMD</h3></td>
    <td rowspan="3" width="7%"><h3>Perangkat Daerah Penanggung Jawab</h3></td>

</tr>
<tr>
    <td colspan="2"><h4>Tahun-1</h4></td>
    <td colspan="2"><h4>Tahun-2</h4></td>
    <td colspan="2"><h4>Tahun-3</h4></tdh>
    <td colspan="2"><h4>Tahun-4</h4></tdh>
    <td colspan="2"><h4>Tahun-5</h4></tdh> 
</tr>
<tr>
    <td><h4><h4>K</h4></td>
    <td><h4>Rp</h4></td>
    <td><h4>K</h4></td>
    <td><h4>Rp</h4></td>
    <td><h4>K</h4></td>
    <td><h4>Rp</h4></td>
    <td><h4>K</h4></td>
    <td><h4>Rp</h4></td>
    <td><h4>K</h4></td>
    <td><h4>Rp</h4></td>
    <td><h4>K</h4></td>
    <td><h4>Rp</h4></td>
</tr>
</thead>
<tbody>
<!-- ITEMS HERE -->';
function getUrsDesc($kode)
{
  // indikator program
  $sql_urs  = "";
  // $sql_urs	="SELECT * FROM master_program where urs_id='".$kode."' AND lvl=1";
  $sql_urs  = "SELECT * FROM indikator_program_jangka_menengah";
  $result_urs = bmysqli_query($conn, $sql_urs);
  // $result_urs = bmysqli_query($conn,$sql_urs);
  // $row_urs 	= bmysqli_fetch_object($result_urs);
  // num rows
  // $numrows_urs = bmysqli_num_rows($result_urs);
  // return $row_urs->deskripsi;
  return "oek";
}



$lvl_urs = "";
$lvl_urs_bidang = "";
$lvl_opd = "";
$testing = "";
$des_opd = "";

for ($i = 0; $i < $numrows; $i++) {
  // $row = mysql_fetch_object($result);	

  $row = bmysqli_fetch_object($result);
  // $cc  = getUrsDesc($testing);
  if ($lvl_urs != $row->urs_id) {
    // $testing = "beda";
    $lvl_urs = $row->urs_id;

    // get deskripsi urs
    $sql_urs  = "";
    $sql_urs  = "SELECT * FROM master_program where urs_id='" . $row->urs_id . "' AND lvl=1";
    $result_urs = bmysqli_query($conn, $sql_urs);
    $row_urs   = bmysqli_fetch_object($result_urs);

    // get total lvl urusan
    $sql_urs2  = "";
    $sql_urs2  = "SELECT SUM(target_pagu_prog_tahun1) AS thn1, SUM(target_pagu_prog_tahun2) AS thn2, SUM(target_pagu_prog_tahun3) AS thn3, SUM(target_pagu_prog_tahun4) AS thn4, SUM(target_pagu_prog_tahun5) AS thn5, SUM(target_akhir_pagu_program) AS thn_akhir FROM program_jangka_menengah WHERE urs_id='" . $row->urs_id . "'";
    $result_urs2 = bmysqli_query($conn, $sql_urs2);
    $row_urs2   = bmysqli_fetch_object($result_urs2);


    // get urs total

    $html .= '
			<tr>
			<td align="justify" style="font-weight:bold">' . $row->urs_id . '</td>
			<td align="justify" colspan="3" style="font-weight:bold">' . strtoupper($row_urs->deskripsi) . '</td>
			<td colspan="2" align="right" style="font-weight:bold">' . number_format($row_urs2->thn1, 0, ',', '.') . '</tdh>
			<td colspan="2" align="right" style="font-weight:bold">' . number_format($row_urs2->thn2, 0, ',', '.') . '</tdh>
			<td colspan="2" align="right" style="font-weight:bold">' . number_format($row_urs2->thn3, 0, ',', '.') . '</tdh>
			<td colspan="2" align="right" style="font-weight:bold">' . number_format($row_urs2->thn4, 0, ',', '.') . '</tdh>
			<td colspan="2" align="right" style="font-weight:bold">' . number_format($row_urs2->thn5, 0, ',', '.') . '</tdh>
			<td colspan="2" align="right" style="font-weight:bold">' . number_format($row_urs2->thn_akhir, 0, ',', '.') . '</tdh> 
			
			<td style="font-weight:bold"></tdh> 
			</tr>';
  }

  if ($lvl_urs_bidang != $row->bid_urs_id) {
    // $testing = "beda";
    $lvl_urs_bidang = $row->bid_urs_id;

    // get deskripsi urs bidang
    $sql_bid  = "";
    $sql_bid  = "SELECT * FROM master_program where urs_id='" . $row->urs_id . "' AND bid_urs_id='" . $row->bid_urs_id . "' AND lvl=2";
    $result_bid = bmysqli_query($conn, $sql_bid);
    $row_bid   = bmysqli_fetch_object($result_bid);

    // get total lvl urs bidang
    $sql_bid2   = "";
    $sql_bid2   = "SELECT SUM(target_pagu_prog_tahun1) AS thn1, SUM(target_pagu_prog_tahun2) AS thn2, SUM(target_pagu_prog_tahun3) AS thn3, SUM(target_pagu_prog_tahun4) AS thn4, SUM(target_pagu_prog_tahun5) AS thn5, SUM(target_akhir_pagu_program) AS thn_akhir FROM program_jangka_menengah WHERE urs_id='" . $row->urs_id . "' AND bid_urs_id='" . $row->bid_urs_id . "'";
    $result_bid2 = bmysqli_query($conn, $sql_bid2);
    $row_bid2    = bmysqli_fetch_object($result_bid2);

    $html .= '
			<tr>
			<td align="justify" style="font-weight:bold">' . $row->urs_id . '.' . $row->bid_urs_id . '</td>
			<td align="justify" colspan="3" style="font-weight:bold">' . strtoupper($row_bid->deskripsi) . '</td>
			<td colspan="2" align="right" style="font-weight:bold">' . number_format($row_bid2->thn1, 0, ',', '.') . '</tdh>
			<td colspan="2" align="right" style="font-weight:bold">' . number_format($row_bid2->thn2, 0, ',', '.') . '</tdh>
			<td colspan="2" align="right" style="font-weight:bold">' . number_format($row_bid2->thn3, 0, ',', '.') . '</tdh>
			<td colspan="2" align="right" style="font-weight:bold">' . number_format($row_bid2->thn4, 0, ',', '.') . '</tdh>
			<td colspan="2" align="right" style="font-weight:bold">' . number_format($row_bid2->thn5, 0, ',', '.') . '</tdh>
			<td colspan="2" align="right" style="font-weight:bold">' . number_format($row_bid2->thn_akhir, 0, ',', '.') . '</tdh> 
			<td style="font-weight:bold"></tdh> 
			</tr>';
  }

  if ($lvl_opd != $row->opd_id) {
    $testing = "beda";
    $lvl_opd = $row->opd_id;

    // get deskripsi opd
    $sql_opd  = "";
    $sql_opd  = "SELECT * FROM opd where opd_id='" . $row->opd_id . "'";
    $result_opd = bmysqli_query($conn, $sql_opd);
    $row_opd   = bmysqli_fetch_object($result_opd);

    // get total lvl opd
    $sql_opd2   = "";
    $sql_opd2   = "SELECT SUM(target_pagu_prog_tahun1) AS thn1, SUM(target_pagu_prog_tahun2) AS thn2, SUM(target_pagu_prog_tahun3) AS thn3, SUM(target_pagu_prog_tahun4) AS thn4, SUM(target_pagu_prog_tahun5) AS thn5, SUM(target_akhir_pagu_program) AS thn_akhir FROM program_jangka_menengah WHERE urs_id='" . $row->urs_id . "' AND bid_urs_id='" . $row->bid_urs_id . "' AND opd_id='" . $row->opd_id . "'";
    $result_opd2 = bmysqli_query($conn, $sql_opd2);
    $row_opd2    = bmysqli_fetch_object($result_opd2);

    // set deskripsi opd
    $des_opd = $row_opd->deskripsi_opd;
    $html .= '
			<tr>
			<td align="justify" style="font-weight:bold"></td>
			<td align="justify" colspan="3" style="font-weight:bold">' . strtoupper($row_opd->deskripsi_opd) . '</td>
			<td colspan="2" align="right" style="font-weight:bold">' . number_format($row_opd2->thn1, 0, ',', '.') . '</tdh>
			<td colspan="2" align="right" style="font-weight:bold">' . number_format($row_opd2->thn2, 0, ',', '.') . '</tdh>
			<td colspan="2" align="right" style="font-weight:bold">' . number_format($row_opd2->thn3, 0, ',', '.') . '</tdh>
			<td colspan="2" align="right" style="font-weight:bold">' . number_format($row_opd2->thn4, 0, ',', '.') . '</tdh>
			<td colspan="2" align="right" style="font-weight:bold">' . number_format($row_opd2->thn5, 0, ',', '.') . '</tdh>
			<td colspan="2" align="right" style="font-weight:bold">' . number_format($row_opd2->thn_akhir, 0, ',', '.') . '</tdh> 
			<td style="font-weight:bold"></tdh> 
			</tr>';
  }

  // indikator program
  $sql_indi_prog = "";
  // $sql_indi_prog	="SELECT * FROM indikator_program_jangka_menengah where prt_id=01";
  $sql_indi_prog = "SELECT * FROM indikator_program_jangka_menengah where prt_id='" . $row->row_id . "'";
  $result_indi_prog = bmysqli_query($conn, $sql_indi_prog);
  // num rows
  $numrows_indi_prog = bmysqli_num_rows($result_indi_prog);


  if ($numrows_indi_prog > 0) {
    for ($i2 = 0; $i2 < $numrows_indi_prog; $i2++) {
      $row_indi_prog = bmysqli_fetch_object($result_indi_prog);
      // echo $i2;
      if ($i2 == 0) {
        $html .= ' 
					<tr>
					<td align="justify">' . $row->prg_full . '</td>
					<td align="justify">' . $row->deskripsi . '</td>
					<td align="justify">' . $row_indi_prog->Indikator_program . ' (Dengan Satuan:' . $row_indi_prog->satuan_indikator_program . ')</td>
					<td align="right">' . $row_indi_prog->kinerja_awal_program . '</td>
					<td align="right">' . $row_indi_prog->target_kinerja_prog_tahun1 . '</td>
					<td align="right">' . number_format($row->target_pagu_prog_tahun1, 0, ',', '.') . '</td>				
					<td align="right">' . $row_indi_prog->target_kinerja_prog_tahun2 . '</td>
					<td align="right">' . number_format($row->target_pagu_prog_tahun2, 0, ',', '.') . '</td>
					<td align="right">' . $row_indi_prog->target_kinerja_prog_tahun3 . '</td>
					<td align="right">' . number_format($row->target_pagu_prog_tahun3, 0, ',', '.') . '</td>
					<td align="right">' . $row_indi_prog->target_kinerja_prog_tahun4 . '</td>
					<td align="right">' . number_format($row->target_pagu_prog_tahun4, 0, ',', '.') . '</td>
					<td align="right">' . $row_indi_prog->target_kinerja_prog_tahun5 . '</td>
					<td align="right">' . number_format($row->target_pagu_prog_tahun5, 0, ',', '.') . '</td>
					<td align="right">' . $row_indi_prog->target_akhir_kinerja_program . '</td>
					<td align="right">' . number_format($row->target_akhir_pagu_program, 0, ',', '.') . '</td>
					<td align="justify">' . $des_opd . '</td>
					</tr>';
      } else {
        $html .= ' 
					<tr>					
					<td align="justify"></td>
					<td align="justify"></td>
					<td align="justify">' . $row_indi_prog->Indikator_program . ' (Dengan Satuan:' . $row_indi_prog->satuan_indikator_program . ')</td>
					<td align="right">' . $row_indi_prog->kinerja_awal_program . '</td>
					<td align="right">' . $row_indi_prog->target_kinerja_prog_tahun1 . '</td>
					<td align="right"></td>				
					<td align="right">' . $row_indi_prog->target_kinerja_prog_tahun2 . '</td>
					<td align="right"></td>	
					<td align="right">' . $row_indi_prog->target_kinerja_prog_tahun3 . '</td>
					<td align="right"></td>	
					<td align="right">' . $row_indi_prog->target_kinerja_prog_tahun4 . '</td>
					<td align="right"></td>	
					<td align="right">' . $row_indi_prog->target_kinerja_prog_tahun5 . '</td>
					<td align="right"></td>	
					<td align="right">' . $row_indi_prog->target_akhir_kinerja_program . '</td>
					<td align="right"></td>	
					<td align="justify">' . $des_opd . '</td>
					</tr>';
      }
    }
  } else {
    $html .= ' 
			<tr>
			<td align="justify">' . $row->prg_full . '</td>
			<td align="justify">' . $row->deskripsi . '</td>
			<td align="justify"></td>
			<td align="justify"></td>
			<td align="justify"></td>
			<td align="right">' . number_format($row->target_pagu_prog_tahun1, 0, ',', '.') . '</td>
			<td align="right"></td>	
			<td align="right">' . number_format($row->target_pagu_prog_tahun2, 0, ',', '.') . '</td>
			<td align="right"></td>	
			<td align="right">' . number_format($row->target_pagu_prog_tahun3, 0, ',', '.') . '</td>
			<td align="right"></td>	
			<td align="right">' . number_format($row->target_pagu_prog_tahun4, 0, ',', '.') . '</td>
			<td align="right"></td>	
			<td align="right">' . number_format($row->target_pagu_prog_tahun5, 0, ',', '.') . '</td>
			<td align="right"></td>	
			<td align="right">' . number_format($row->target_akhir_pagu_program, 0, ',', '.') . '</td>
			<td align="justify">' . $des_opd . '</td>
			</tr>';
  }
}

// get total lvl urusan
$sql_total  = "";
$sql_total  = "SELECT SUM(target_pagu_prog_tahun1) AS thn1, SUM(target_pagu_prog_tahun2) AS thn2, SUM(target_pagu_prog_tahun3) AS thn3, SUM(target_pagu_prog_tahun4) AS thn4, SUM(target_pagu_prog_tahun5) AS thn5, SUM(target_akhir_pagu_program) AS thn_akhir FROM program_jangka_menengah";
$result_total = bmysqli_query($conn, $sql_total);
$row_total   = bmysqli_fetch_object($result_total);


$html .= ' 		
<!-- END ITEMS HERE -->
<tr>
<td class="blanktotal" colspan="3" rowspan="6"></td>
<td class="totals"><b>TOTAL:</b></td>
<td colspan="2" align="right" style="font-weight:bold">' . number_format($row_total->thn1, 0, ',', '.') . '</tdh>
<td colspan="2" align="right" style="font-weight:bold">' . number_format($row_total->thn2, 0, ',', '.') . '</tdh>
<td colspan="2" align="right" style="font-weight:bold">' . number_format($row_total->thn3, 0, ',', '.') . '</tdh>
<td colspan="2" align="right" style="font-weight:bold">' . number_format($row_total->thn4, 0, ',', '.') . '</tdh>
<td colspan="2" align="right" style="font-weight:bold">' . number_format($row_total->thn5, 0, ',', '.') . '</tdh>
<td colspan="2" align="right" style="font-weight:bold">' . number_format($row_total->thn_akhir, 0, ',', '.') . '</tdh> 
</tbody>
</table>
</body>
</html>
';

$path = (getenv('MPDF_ROOT')) ? getenv('MPDF_ROOT') : __DIR__;
require_once $path . '/vendor/autoload.php';
$ukuran_kertas = 'A4-L';
$mpdf = new \Mpdf\Mpdf([
  'margin_left' => 20,
  'margin_right' => 15,
  'margin_top' => 10,
  'margin_bottom' => 25,
  'margin_header' => 10,
  'margin_footer' => 10,
  'format' => $ukuran_kertas
]);

$mpdf->SetProtection(array('print'));
$mpdf->SetTitle("Output RPJMD");
$mpdf->SetAuthor("firo coronaconsulting");
$mpdf->SetWatermarkText("KOTA PANGKALPINANG");
$mpdf->showWatermarkText = true;
$mpdf->watermark_font = 'sans-serif';
$mpdf->watermarkTextAlpha = 0.1;
$mpdf->SetDisplayMode('fullpage');

$mpdf->WriteHTML($html);
$mpdf->Output();
