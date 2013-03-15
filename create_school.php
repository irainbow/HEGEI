<?php
	require("db.php");
	
	$school_id = create_school(
		$_POST['school_name'],
		$_POST['state'],
		$_POST['ownership'],
		isset($_POST['private_ownership']) ? "Y" : "N"
	);
	
	header("Location: surveyEntry.php?school_id=$school_id");
?>