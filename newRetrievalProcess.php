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

$queryText = "SELECT * from SurveyResults JOIN School on School.id = SurveyResults.School_id";
$whereClauses = array();

$whereClauses[] = "current='Y'";

if($green_fee_query=="true"){
	$whereClauses[] = "gf=1";
}
if($sustainablity_director_query=="true"){
	$whereClauses[] = "sustco='1'";
}
if($private_only_query=="true"){
	$whereClauses[] = "private_ownership='Y'";
}
if(isset($renew_percent_query) && $renew_percent_query){
	$whereClauses[] = 
"(" . 
    implode(" OR ", array_map(function($percent){list($min, $max) = explode("-", $percent);return "(renewperc > ".floatval($min)." AND renewperc <= ".floatval($max).")";
},explode(",", $renew_percent_query)))
. ")";
}	
if($public_only_query=="true"){
	$whereClauses[] = "private_ownership='N'";
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
 	// array code here
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
 
function generateOwnershipType($row)
{
	if ($row["private_ownership"]=="Y") {
		return "Private";
	}
	else {
		return "Public";
	} 
}
 	
?>
<script>$(function(){
	$("#resultsTable").dataTable();
	})</script>
<table id="resultsTable" class="display">
    <thead>
        <tr>
            <th title="Name of School">School Name</th>
            <th title="Number of full-time enrolled students">Number of Students</th>
            <th title="state">State</th>
            <th title="Public or private">Ownership</th>
            <th title="Does the institution levy a green or sustainabilty fee as part of standard student fees?">Green Fee</th>
            <th title="How much is the student green fee, per fte student, per year?">Green Fee Amount</th>
            <th title="Does the institution employ a full-time sustainabiltiy director or coordinator?">Sustainability Coordinator</th>
            <th title="What percentage of the instituion's total footprint comes from renewable energy?">Renewable Percent</th>
            <th title="Which types of renewable energy are used?">Renewable Energy Types</th>
            <th title="Who is generating this renewable energy, and how is it being purchased?">Renewables Source</th>
        	<th title="Company that provides basic electricity service">Electricity Provider</th>
			<th title="total k-Wh/year consumed">Electric Footprint</th>
			<th title="Percentage of energy produced by the university or subsidary instituions">Self-Generated Percentage</th>
        	<th title="Further Description of any project wherein the institution generates its own energy"> Self-Gen Description</th>
            <th title="Calculated index accounting for multiple aspects of instituion's renewably energy implementation"> Renewable Index</th>
        	<th title="Existence of a policy requiring some level of leed or other Green Building certification for new buildings or major renovations"> Green Building Policy</th>
        	<th title="Level of green building standard required by policy"> Green Policy Level</th>
        	<th title="Does the green building policy require certification"> Certification Required</th>
        	<th title="Is the institution subjected to any state laws mandating a level of green building standards">State Requirement</th>
        	<th title="Number of Buildings on campus"> Building Number</th>
        	<th title="Number of Buildings on campus certified leed"> Leed certified</th>
        	<th title="Number of Buildings on campus certified leed silver"> Leed certified silver</th>
        	<th title="Number of Buildings on campus certified leed gold"> Leed certified gold</th>
        	<th title="Number of Buildings on campus certified leed platinum"> Leed certified platinum</th>
        	<th title="Number of Buildings on campus certified to meet a non-leed standard of green building"> Non-Leed Certified Green Buildings</th>
        	<th title="Number of Buildings on campus that meet a LEED 'certified' standards of  green building, but are not certified"> LEED Non-Certified Buildings</th>
        	<th title="Number of Buildings on campus that meet a LEED silver standard of green building, but are not certified"> LEED Silver Non-Certified Buildings</th>
        	<th title="Number of Buildings on campus that meet a LEED gold standard of green building, but are not certified"> LEED Gold Non-Certified Buildings</th>
        	<th title="Number of Buildings on campus that meet a LEED platinum standard of green building, but are not certified"> LEEd Platinum Non-Certified Buildings</th>
        	<th title="Number of Buildings on campus that meet a non-leed standard of green building, but are not certified to do so"> Non-Leed Non-Certified Green Buildings</th>
        	<th title="Index of renewabe energy implementation on this campus"> Renewable Energy Index </th>
        	<th title="Index of green building implementation on this campus"> Green Building Index </th>

        </tr>
    </thead>
    
    <tbody>
		<?php			
			// Iterate through each returned row, create an associative array (column name -> value for this row) and assign it to $row
			while ($row = mysql_fetch_assoc($queryResults)) {
				?>
					<tr>
			            <td><?=$row["name"]?></td>
			            <td><?=$row["students"]?></td>
			            <td><?=$row["state"]?></td>
			            <td><?=generateOwnershipType($row)?></td>
			            <td><?=$row["gf"]?></td>
			            <td><?=$row["green_fee_amount"]?></td>
			            <td><?=$row["sustco"]?></td>
			            <td><?=$row["renewperc"]?></td>
			           	<td><?=generateEnergyTypeList($row)?></td>
			           	<td><?=$row["renewablepurchase"]?></td>
			           	<td><?=$row["elecprov"]?></td>
			           	<td><?=$row["elecfp"]?></td> <!--unclear column name: elecfp=electric footprint-->
			           	<td><?=$row["selfgen"]?></td>  <!--unclear column name: selfgen=percentage electric footprint generated on-site/by university-->
			        	<td><?=$row["selfgen_description"]?></td>
			        	<td><?=$row["renewable_index"]?></td>
			        	<td><?=$row["green_policy"]?></td>
			        	<td><?=$row["green_policy_req"]?></td>
			        	<td><?=$row["certreq"]?></td>
			        	<td><?=$row["satereq"]?></td>
			        	<td><?=$row["buildingNumber"]?></td>
			        	<td><?=$row["lcertifiedNumber"]?></td>
			        	<td><?=$row["lsilverNumber"]?></td>
			        	<td><?=$row["lgoldNumber"]?></td>
			        	<td><?=$row["lplatinumNumber"]?></td>
			        	<td><?=$row["nonleedNumber"]?></td>
			        	<td><?=$row["lcertifiedncNumber"]?></td>
			        	<td><?=$row["lsilverncNumber"]?></td>
			        	<td><?=$row["lgoldncNumber"]?></td>
			        	<td><?=$row["lplatinumncNumber"]?></td>
			        	<td><?=$row["nonleedncNumber"]?></td>
			        	<td><?=$row["renewableIndex"]?></td>
			        	<td><?=$row["greenBuildingIndex"]?></td>
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
