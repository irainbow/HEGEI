<?php
	$title="HEGEI - Student Green Fees";
	require("db.php");

$private_only_query = $_GET['private_only_query'];
$public_only_query = $_GET['public_only_query'];
$state_query = $_GET['state_query'];
$green_fee_query = $_GET['green_fee_query'];
$sustainablity_director_query = $_GET['sustainablity_director_query'];
$school_size_tiny = $_GET['school_size_tiny'];
$school_size_small = $_GET['school_size_small'];
$school_size_medium = $_GET['school_size_medium'];
$school_size_large = $_GET['school_size_large'];
$school_size_huge = $_GET['school_size_huge'];
$renew_percent_query = $_GET['renew_precent_query'];
$green_building_policy_query = $_GET['green_building_policy_query'];

$queryText = "SELECT * from newform_hegei";
$whereClauses = array();

if($green_fee_query=="true"){
	$whereClauses[] = "gf=1";
}
if($sustainablity_director_query=="true"){
	$whereClauses[] = "sustco='1'";
}
if($private_only_query=="true"){
	$whereClauses[] = "ownership='private'";
}
if(isset($renew_percent_query) && $renew_percent_query){
	$whereClauses[] = 
"(" . 
    implode(" OR ", array_map(function($percent){list($min, $max) = explode("-", $percent);return "(renewperc > ".floatval($min)." AND renewperc <= ".floatval($max).")";
},explode(",", $renew_percent_query)))
. ")";
}	
if($public_only_query=="true"){
	$whereClauses[] = "ownership='public'";
}
if($green_building_policy_query=="true"){
	$whereClauses[] = "green_policy_req='1' OR green_policy_req='2'";
}
if(isset($state_query) && $state_query){
	$whereClauses[] = "state IN (" . implode(",", array_map(function($state){ return "'" . mysql_real_escape_string($state) . "'"; }, explode(",", $state_query))) . ")";
}
   
$sizeClauses = array();

if(isset($school_size_tiny) && $school_size_tiny){
	$sizeClauses[] = "students <= 1000";
}
if(isset($school_size_small) && $school_size_small){
	$sizeClauses[] = "students >= 1000 && students < 5001";
}
if(isset($school_size_medium) && $school_size_medium){
	$sizeClauses[] = "students >= 5001 && students < 15001";
}
if(isset($school_size_large) && $school_size_large){
	$sizeClauses[] = "students >= 15001 && students < 25001";
}
if(isset($school_size_huge) && $school_size_huge){
	$sizeClauses[] = "students >= 25001";
}

if ($sizeClauses) {
	$whereClauses[] = "(( " . join(") OR (", $sizeClauses) . " ))";
}

// Add the where clauses to the query, if any were defined

if ($whereClauses) {
	$queryText .= " WHERE " . join(" AND ", $whereClauses);
}
//echo "QUERY TEXT STARTS HERE:" . " " . $queryText . " " . " QUERY TEXT ENDS HERE.";

mysql_connect("localhost",$username,$password) or die(mysql_error());
//echo "Connected to MySQL<br />";

mysql_select_db($database) or die(mysql_error());
//echo "Connected to Database<br />";


// Execute the query and assign the results to a variable
$queryResults = mysql_query($queryText) or die(mysql_error());

function generateEnergyTypeList($row)
 {
 	// Put your array code here
 	$renweable_type_output = array();

	if($row["wind"]=="1"){
		$renewable_type_output[] = "Wind";
	}
	if($row["solar"]=="1"){
		$renewable_type_output[] = "Solar";
	}
	if($row["geothermal"]=="1"){
		$renewable_type_output[] = "Geothermal";
	}
	if($row["hydro"]=="1"){
		$renewable_type_output[] = "Hydro";
	}
	if($row["biofuels"]=="1"){
		$renewable_type_output[] = "Biofuels";
	}
	if($row["other"]=="1"){
		$renewable_type_output[] = "Other";
	}
 	
 	return implode(", ", $renewable_type_output);
 }
 	
?>

<table>
    <thead>
        <tr>
            <th>School Name</th>
            <th>Number of Students</th>
            <th>State</th>
            <th>Ownership</th>
            <th>Green Fee</th>
            <th>Green Fee Amount</th>
            <th>Sustainability Coordinator</th>
            <th>Renewable Percent</th>
            <th>Renewable Energy Types</th>
        </tr>
    </thead>
    
    <tbody>
		<?php			
			// Iterate through each returned row, create an associative array (column name -> value for this row) and assign it to $row
			while ($row = mysql_fetch_assoc($queryResults)) {
				?>
					<tr>
			            <td><?=$row["school_name"]?></td>
			            <td><?=$row["students"]?></td>
			            <td><?=$row["state"]?></td>
			            <td><?=$row["ownership"]?></td>
			            <td><?=$row["gf"]?></td>
			            <td><?=$row["green_fee_amount"]?></td>
			            <td><?=$row["sustco"]?></td>
			            <td><?=$row["renewperc"]?></td>
			           	<td><?=generateEnergyTypeList($row)?></td>
			        </tr>
				<?php
			}
		?>
    </tbody>
</table>


<?php

// Clean up the "result handle" produced by mysql_query
mysql_free_result($queryResults);

mysql_close();

?>
