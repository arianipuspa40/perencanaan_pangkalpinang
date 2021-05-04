<?php
// connecting to db
require("dbconn.php");

//user admin super, admin opd, user bidang (disini tidak diperlukan karena get data berdasarkan id parent)
//  parameter opd/sub opd

$opd_id = $_GET['opd_id'];
$lvl	= $_GET['lvl'];
$sql1="";

$tes["status"] = "success";

if ($lvl == "program_renstra_murni"){
	$sql="SELECT status_renstra FROM program_jangka_menengah WHERE opd_id='".$opd_id."'";

	$result = mysql_query($sql);
	// num rows
	$numrows = mysql_num_rows($result);

	if ($numrows > 0) {									
		//for ($i=0; $i<$numrows_des; $i++) {
			$row = mysql_fetch_object($result);								
			$tes["status"] = $row->status_renstra;						
		//}									

	} else {
		// no record found
	}
	
}

// // echo $tes;
echo json_encode($tes);

?>