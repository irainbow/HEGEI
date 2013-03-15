<?php
$username="hegei_rw";
$password="penguinssleepundergreenumbrealls";
$database="hegei";

mysql_connect("localhost", $username, $password) or die(mysql_error());
mysql_select_db($database) or die(mysql_error());

function find_school($school_id) {
	$result = mysql_query("SELECT * FROM School WHERE id = $school_id") or die(mysql_error());
	if ($result) {
		return mysql_fetch_array( $result );
	} else {
		return null;
	}
}

function create_school($name, $state, $zip, $private_ownership) {
	$query = "
	INSERT INTO `School` (
		name,
		state,
		zip,
		private_ownership
	) VALUES (
		'$name',
		'$state',
		'$zip',
		'$private_ownership'
	)";
		
	mysql_query($query) or die(mysql_error());
	return mysql_insert_id();
}
function list_schools(){
	$list_schools_query ="SELECT * from School";
	$list_schools_results = mysql_query($list_schools_query) or die(mysql_error());
	$results = array();
	while ($row = mysql_fetch_assoc($list_schools_results)) { 
		$results[] = $row;
	}
	return $results;
}


?>