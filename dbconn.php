<?php
// mysql_connect("localhost", "root", "");
// mysql_select_db("monevpkp_online");
// echo "dbconn";

$versi = "mysqli";
// $versi = "mysql";


if ($versi === "mysqli"){
	$conn = mysqli_connect("localhost", "root","","new_pkp");

	function bmysqli_query($conn,$bquery){		
		return mysqli_query($conn, $bquery);
	}

	function bmysqli_num_rows($result){
		return mysqli_num_rows($result);
	}

	function bmysqli_fetch_object($result){
		return mysqli_fetch_object($result);
	}

	function bmysqli_free_result($result){
		return mysqli_free_result($result);
	}

	function bmysqli_affected_rows($conn){
		return mysqli_affected_rows($conn);
	}
	
}else{
	mysql_connect("localhost", "root", "");
	mysql_select_db("ktt");
	// dipertimbangkan untuk memiliki 2 parameter seperti di versi yang i ada tambahan parameter $conn
	// atau khusus fungsi bmysqli_query akan mengikuti koding yang ada jika yang dipakai 1 parameter maka tidak perlu diubah tetapi jika dibutuhkan 2 parameter maka diubah jadi 2 parameter
	// fungsi ini diaktifkan jika code menggunakan 1 parameter
	// function bmysqli_query($bquery){		
	// 	return mysql_query($bquery);
	// }

	
	function bmysqli_query($conn,$bquery){		
		return mysql_query($bquery);
	}

	function bmysqli_num_rows($result){
		return mysql_num_rows($result);
	}

	function bmysqli_fetch_object($result){
		return mysql_fetch_object($result);
	}

	function bmysqli_free_result($result){
		return mysql_free_result($result);
	}

	function bmysqli_affected_rows($conn){
		return mysql_affected_rows();
	}

}

?>