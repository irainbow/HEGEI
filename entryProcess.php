<?php
	include("db.php");

	$school_id = $_POST['school_id'];
	$students = $_POST['students'];
	$state = $_POST['state'];
	$ownership = $_POST['ownership'];
	$gf = $_POST['gf'];//green fee questions here
	$green_fee_amount = $_POST['green_fee_amount'];
	$sustco = $_POST['sustco'];
	$renewperc = $_POST['renewperc']; //renewable questions here
	$wind = $_POST['wind'];
	$solar = $_POST['solar'];
	$geothermal = $_POST['geothermal'];
	$hydro = $_POST['hydro'];
	$biofuels = $_POST['biofuels'];
	$biofuels_type = $_POST['biofuels_type'];
	$other = $_POST['other'];	
	$other_type = $_POST['other_type'];
	$renewablepurchase = $_POST['renewablepurchase'];
	$zip = $_POST['zip'];
	$elecprov = $_POST['elecprov'];
	$elecfp = $_POST['elecfp'];
	$selfgen = $_POST['selfgen'];
	$selfgen_description = $_POST['selfgen_description'];
	$green_policy = $_POST['green_policy']; //green building questions here
	$green_policy_req = $_POST['green_policy_req'];
	$certreq = $_POST['certreq'];
	$satereq = $_POST['satereq'];
	$buildingNumber = $_POST['buildingNumber'];
	$lcertifiedNumber = $_POST['lcertifiedNumber'];
	$lsilverNumber = $_POST['lsilverNumber'];
	$lgoldNumber = $_POST['lgoldNumber'];
	$lplatinumNumber = $_POST['lplatinumNumber']; 
	$nonleedNumber = $_POST['nonleedNumber'];
	$lcertifiedncNumber = $_POST['lcertifiedncNumber'];
	$lsilverncNumber = $_POST['lsilverncNumber'];
	$lgoldncNumber = $_POST['lgoldncNumber'];
	$lplatinumncNumber = $_POST['lplatinumncNumber'];
	$nonleedncNumber = $_POST['nonleedncNumber'];
	
$renewable_index = (floor($renewperc/5)+$renewablepurchase);
$green_building_index =($lcertifiedNumber + 2*($lsilverNumber) + 3*($lgoldNumber) + 4*($lplatinumNumber) + 2*($nonleedNumber) + .7*($lcertifiedncNumber) + 2*(.7*($lsilverncNumber)) + 3*(.7*($lgoldncNumber)) + 4*(.7*($lplatinumncNumber))+2*(.7*($nonleedncNumber)))/($buildingNumber/10);

mysql_connect("localhost",$username,$password) or die(mysql_error());
mysql_select_db($database) or die(mysql_error());

$currentreset = "update SurveyResults set current ='N' where School_id = $school_id";

mysql_query($currentreset)
or die(mysql_error());

// Insert data
$query = "
INSERT INTO SurveyResults (
	School_id,
	current,
	students,
	gf,
	green_fee_amount,
	sustco,
	renewperc,
	wind,
	solar,
	geothermal,
	hydro,
	biofuels,
	biofuels_type,
	other,
	other_type,
	renewablepurchase,
	elecprov,
	elecfp,
	selfgen,
	selfgen_description,
	renewable_index,
	date_created,
	green_policy,
	green_policy_req,
	certreq,
	satereq,
	buildingNumber,
	lcertifiedNumber,
	lsilverNumber,
	lgoldNumber,
	lplatinumNumber,
	nonleedNumber,
	lsilverncNumber,
	lgoldncNumber,
	lplatinumncNumber,
	nonleedncNumber,
	renewableIndex,
	greenBuildingIndex
) VALUES (
	'$school_id',
	'Y',
	'$students',
	'$gf',
	'$green_fee_amount',
	'$sustco',
	'$renewperc',
	'$wind',
	'$solar',
	'$geothermal',
	'$hydro',
	'$biofuels',
	'$other',
	'$other',
	'$other_type',
	'$renewablepurchase',
	'$elecprov',
	'$elecfp',
	'$selfgen',
	'$selfgen_description',
	'$renewable_index',
	CURRENT_TIMESTAMP,
	'$green_policy',
	'$green_policy_req',
	'$certreq',
	'$satereq',
	'$buildingNumber',
	'$lcertifiedNumber',
	'$lsilverNumber',
	'$lgoldNumber',
	'$lplatinumNumber',
	'$nonleedNumber',
	'$lsilverncNumber',
	'$lgoldncNumber',
	'$lplatinumncNumber',
	'$nonleedncNumber',
	'$renewable_index',
	'$green_building_index'
)";
	
mysql_query($query)
or die(mysql_error());

$green_building_average_query = "SELECT AVG(greenBuildingIndex) from hegei.SurveyResults";
$green_building_average_results = mysql_query($green_building_average_query) or die(mysql_error());
mysql_close();

return $green_building_average_results;

echo '<div id=wrapper><h1>Form Submission Results:</h1><ul><li>Your Form has submitted successfully! Thanks for your addition to our database.';
echo '<li>Your Renewable index is' . ' ' . $renewable_index . '</li>';
echo '<li>Your Green Building Index is' . ' ' . $green_building_index . '</li>';
echo '<li>The mean Green Building Index for our database is' . ' ' . $green_building_average_results . '</li></ul></div>';

?>