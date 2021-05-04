<?php
// connecting to db
require("dbconn.php");

// post data
$ROW_ID 		 											= $_GET['ROW_ID'];

// delete data
$sql  = "DELETE FROM opd";
$sql .= " ";
$sql .= "WHERE row_id='".$ROW_ID."'";

$result			= mysql_query($sql);			// True/Resource on success, False on error
$num_result = mysql_affected_rows();	// Returns the number of affected rows on success, and -1 if the last query failed

if ($num_result > 0) {
	$data = array();
	$data["status"] = "success";
	
	// echoing JSON response output
	header('Content-type: application/json');
	echo json_encode($data);
} else {
	$data = array();
	$data["status"] = "error";
	
	// echoing JSON response output
	header('Content-type: application/json');
	echo json_encode($data);
}

?>