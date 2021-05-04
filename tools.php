<?php
session_start();
$temp_session 						= array();

if(isset($_SESSION["USER_SETTING"]["LOGIN"])){
	$temp_session["SESSION"]	 	= $_SESSION["USER_SETTING"];
}else{
	header("location:index.php");
}

// koneksi db sudah di panggil di file perencanaan_renstra_entri_murni.php
// connecting to db
require_once("dbconn.php");

// $opd_array  = array();
// $opd_array ["2180000000100"] = "Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu";
// $opd_array ["2232240000100"] = "Dinas Perpustakaan dan Kearsipan";
// $opd_array ["3262190000100"] = "Dinas Pariwisata, Pemuda dan Oalahraga";
// $opd_array ["3272093250100"] = "Dinas Pertanian, Pangan, dan Perikanan";
// $opd_array ["3313302170100"] = "Dinas Perindustrian Perdagangan Koperasi dan UKM";
// $opd_array ["4010000000400"] = "Bagian Hukum";
// $opd_array ["4010000000600"] = "Bagian Administrasi Pembangunan dan Umum";
// $opd_array ["4011060000300"] = "Bagian Ekonomi dan Kesejahteraan Rakyat";
// $opd_array ["4012105010200"] = "Bagian Pemerintahan";
// $opd_array ["4012232240500"] = "Bagian Organsasi";
// $opd_array ["4012240000100"] = "Bagian Umum";
// $opd_array ["4020000000100"] = "Sekretariat DPRD";
// $opd_array ["5015050000100"] = "Badan Perencanaan Pembangunan Daerah dan Penelitian Pengembangan";
// $opd_array ["5027010000100"] = "Badan Pengelolaan Keuangan dan Aset Daerah";
// $opd_array ["5035040000100"] = "Badan Kepegawaian dan Pengembangan Sumber Daya Manusia";
// $opd_array ["6010000000100"] = "Inspektorat Kabupaten";
// $opd_array ["7011052130100"] = "Kecamatan Sesayap";
// $opd_array ["7011052130200"] = "Kecamatan Sesayap Hilir";
// $opd_array ["7011052130300"] = "Kecamatan Tana Lia";
// $opd_array ["7011052130400"] = "Kecamatan Betayau";
// $opd_array ["7011052130500"] = "Kecamatan Muruk Rian";
// $opd_array ["8011050000400"] = "Badan Kesatuan Bangsa dan Politik";
// $opd_array ["1012220000100"] = "Dinas Pendidikan dan Kebudayaan";
// $opd_array ["1022140000100"] = "Dinas Kesehatan";
// $opd_array ["1031040000100"] = "Dinas Pekerjaan Umum, Penataan Ruang, Perumahan dan Kawasan Permukiman";
// $opd_array ["1041050000200"] = "Dinas Pemadam Kebakaran Dan Penyelamatan";
// $opd_array ["1050000000100"] = "Badan Penanggulangan Bencana Daerah";
// $opd_array ["1050000000200"] = "Satuan polisi Pamong Praja";
// $opd_array ["1062082130100"] = "Dinas Sosial, Pemberdayaan Masyarakat dan Desa";
// $opd_array ["2073320000100"] = "Dinas Tenaga Kerja Dan Transmigrasi";
// $opd_array ["2110000000100"] = "Dinas Lingkungan Hidup";
// $opd_array ["2120000000100"] = "Dinas Kependudukan dan Pencatatan Sipil";
// $opd_array ["2150000000100"] = "Dinas Perhubungan";
// $opd_array ["2162202210100"] = "Dinas Komunikasi dan Informatika";
// $opd_array [""] = "";


//     012345678910 
// $opd_id = "22322400001";
//         012345678910 
$opd_id = "01234567891";
$urs1 = substr($opd_id,0,1);
$bid_urs1 = substr($opd_id,1,2);
$urs2 = substr($opd_id,3,1);
$bid_urs2 = substr($opd_id,4,2);
$urs3 = substr($opd_id,6,1);
$bid_urs3 = substr($opd_id,7,2);
$urutan_opd = substr($opd_id,9,2);

$sql_opd	="SELECT * FROM user";
$result_opd = bmysqli_query($conn,$sql_opd);
$numrows_opd = bmysqli_num_rows($result_opd);

for ($i2=0; $i2<$numrows_opd; $i2++) {
	$row_opd = bmysqli_fetch_object($result_opd);
	$opd_id  = $row_opd->sub_opd_id;
	$sql_opd2	  ="SELECT * FROM opd where sub_opd_id='".$opd_id."'";
	$result_opd2  = bmysqli_query($conn,$sql_opd2);
	$numrows_opd2 = bmysqli_num_rows($result_opd2);

	if ($numrows_opd2==0){
		// echo $opd_array [$opd_id];

		$sql = "INSERT INTO opd SET";
		$sql .= " ";
		$sql .= "urs1='". substr($opd_id,0,1)."',";
		$sql .= "bid_urs1='".substr($opd_id,1,2)."',";
		$sql .= "urs2='". substr($opd_id,3,1)."',";
		$sql .= "bid_urs2='".substr($opd_id,4,2)."',";
		$sql .= "urs3='".substr($opd_id,6,1)."',";
		$sql .= "bid_urs3='".substr($opd_id,7,2)."',";
		$sql .= "urutan_opd='". substr($opd_id,9,2)."',";
		$sql .= "opd_id='".$row_opd->opd_id."',";
		$sql .= "sub_opd_id='".$row_opd->sub_opd_id."',";
		$sql .= "deskripsi_opd='".$row_opd->deskripsi."',";
		$sql .= "status_aktif='5'";
		$result 	= bmysqli_query($conn,$sql);

	}	
}


// echo "halloman ";
// echo $urs1.".".$bid_urs1.".".$urs2.".".$bid_urs2.".".$urs3.".".$bid_urs3.".".$urutan_opd;