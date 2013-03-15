<?php
	$title="Search Database";
	include("headernoside.php");
?>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/css/jquery.dataTables.css"/>
	<script>
		$(function(){
			$("#searchButton").click(function(){
				$.ajax({ //asycronous javaScript and XML
					type: "GET", 
					url: "newRetrievalProcess.php", //process file
					data: $("#queryForm").serialize(), //take all the input in the form and make an associative array 
					dataType: "html", 
					success: function(resultHtml) { 
						$("#resultsContainer").html(resultHtml);
					}
				});
			});
			
			$(".checkbox-container .check-all").click(function(){
				$(this).parents(".checkbox-container").find("input[type=checkbox]").not(".check-all").attr("checked", $(this).attr("checked") ? "checked" : null);
			});
			
			function updateStateInput() {
				$("#state_query").val($(".state-selector input:checked").not(".check-all").map(function(){ return $(this).val(); }).toArray().join(","));
			}
			$(".state-selector input").click(updateStateInput);
			
			function updateRenewableInput() {
				$("#renew_percent_query").val($(".renewpercent-selector input:checked").not(".check-all").map(function(){ return $(this).val(); }).toArray().join(","));
			}
			$(".renewpercent-selector input").click(updateRenewableInput);
			
			
			$(".checkbox-container input[type=checkbox]").not(".check-all").click(function(){ //in checkbox container, find all input elements which are not a check-all element, and when clicked, do this function
				var allChecked = true;
					$(this).parents(".checkbox-container").find("input[type=checkbox]").not(".check-all").each(function(){ 
						allChecked &= $(this).is(":checked");
				});
				
				$(this).parents(".checkbox-container").find(".check-all").attr("checked", allChecked ? "checked" : null);
				updateStateInput();
			});
		});
	</script>

<!-- Data Retrieval Form -->
	<div id="selectors_wrapper">
		<h2>Please select which data you would like to view</h2>
		<form method="get" id="queryForm"> 
			<div id="selectors">
					<div id="checkboxes">
				Show me only instutitions that...
					<ul>
						<li><input type="checkbox" name="green_fee_query" id="green_fee_query" value="true"> Have a Student Green/Sustainablity Fee </li>
						<li><input type="checkbox" name="sustainablity_director_query" id="sustainablity_director_query" value="true"> Have a Sustainablity Director/Coordinator</li>
						<li><input type="checkbox" name="private_only_query" id="private_only_query" value="true"> Are Privately Owned</li>
						<li><input type="checkbox" name="public_only_query" id="public_only_query" value="true"> Are Publicly Owned</li>
						<li><input type="checkbox" name="public_only_query" id="green_building_policy_query" value="true"> Are committed to a formal green building policy</li>
					</ul>
					</div> <!--close div "checkboxes" -->
					<div id="state" class="checkbox-container state-selector">
						State(s):
	    				<input type="hidden" name="state_query" id="state_query" />
		    			<ul>
	    					<li><label><input type="checkbox" class="check-all" /> All</label></li>		
							<li><label><input type="checkbox" value="AL"/> Alabama</label></li>
							<li><label><input type="checkbox" value="AK"/> Alaska</label></li>
							<li><label><input type="checkbox" value="AZ"/> Arizona</label></li>
							<li><label><input type="checkbox" value="AR"/> Arkansas</label></li>
							<li><label><input type="checkbox" value="CA"/> California</label></li>
							<li><label><input type="checkbox" value="CO"/> Colorado</label></li>
							<li><label><input type="checkbox" value="CT"/> Connecticut</label></li>
							<li><label><input type="checkbox" value="DE"/> Delaware</label></li>
							<li><label><input type="checkbox" value="DC"/> District of Columbia</label></li>
							<li><label><input type="checkbox" value="FL"/> Florida</label></li>
							<li><label><input type="checkbox" value="GA"/> Georgia</label></li>
							<li><label><input type="checkbox" value="HI"/> Hawaii</label></li>
							<li><label><input type="checkbox" value="ID"/> Idaho</label></li>
							<li><label><input type="checkbox" value="IL"/> Illinois</label></li>
							<li><label><input type="checkbox" value="IN"/> Indiana</label></li>
							<li><label><input type="checkbox" value="IA"/> Iowa</label></li>
							<li><label><input type="checkbox" value="KS"/> Kansas</label></li>
							<li><label><input type="checkbox" value="KY"/> Kentucky</label></li>
							<li><label><input type="checkbox" value="LA"/> Louisiana</label></li>
							<li><label><input type="checkbox" value="ME"/> Maine</label></li>
							<li><label><input type="checkbox" value="MD"/> Maryland</label></li>
							<li><label><input type="checkbox" value="MA"/> Massachusetts</label></li>
							<li><label><input type="checkbox" value="MI"/> Michigan</label></li>
							<li><label><input type="checkbox" value="MN"/> Minnesota</label></li>
							<li><label><input type="checkbox" value="MS"/> Mississippi</label></li>
							<li><label><input type="checkbox" value="MO"/> Missouri</label></li>
							<li><label><input type="checkbox" value="MT"/> Montana</label></li>
							<li><label><input type="checkbox" value="NE"/> Nebraska</label></li>
							<li><label><input type="checkbox" value="NV"/> Nevada</label></li>
							<li><label><input type="checkbox" value="NH"/> New Hampshire</label></li>
							<li><label><input type="checkbox" value="NJ"/> New Jersey</label></li>
							<li><label><input type="checkbox" value="NM"/> New Mexico</label></li>
							<li><label><input type="checkbox" value="NY"/> New York</label></li>
							<li><label><input type="checkbox" value="NC"/> North Carolina</label></li>
							<li><label><input type="checkbox" value="ND"/> North Dakota</label></li>
							<li><label><input type="checkbox" value="OH"/> Ohio</label></li>
							<li><label><input type="checkbox" value="OK"/> Oklahoma</label></li>
							<li><label><input type="checkbox" value="OR"/> Oregon</label></li>
							<li><label><input type="checkbox" value="PA"/> Pennsylvania</label></li>
							<li><label><input type="checkbox" value="RI"/> Rhode Island</label></li>
							<li><label><input type="checkbox" value="SC"/> South Carolina</label></li>
							<li><label><input type="checkbox" value="SD"/> South Dakota</label></li>
							<li><label><input type="checkbox" value="TN"/> Tennessee</label></li>
							<li><label><input type="checkbox" value="TX"/> Texas</label></li>
							<li><label><input type="checkbox" value="UT"/> Utah</label></li>
							<li><label><input type="checkbox" value="VT"/> Vermont</label></li>
							<li><label><input type="checkbox" value="VA"/> Virginia</label></li>
							<li><label><input type="checkbox" value="WA"/> Washington</label></li>
							<li><label><input type="checkbox" value="WV"/> West Virginia</label></li>
							<li><label><input type="checkbox" value="WI"/> Wisconsin</label></li>
							<li><label><input type="checkbox" value="WY"/> Wyoming</label></li></div>
						</ul>
					</div>
				<div id="size" class="checkbox-container">
				Size(s):
					<ul>
						<li><label><input type="checkbox" class="check-all" /> All</label></li>		
						<li><label><input type="checkbox" name="school_size_tiny" id="tiny" value="tiny"/> 1-1000</label></li>
						<li><label><input type="checkbox" name="school_size_small" id="small" value="small"/> 1001-5000</label></li>
						<li><label><input type="checkbox" name="school_size_medium" id="medium" value="medium"/> 5001-15000</label></li>
						<li><label><input type="checkbox" name="school_size_large" id="large" value="large"/> 15001-25000</label></li>
						<li><label><input type="checkbox" name="school_size_huge" id="huge" value="huge"/> 25001+</label></li>
					</ul>
				</div> <!--close "size" -->
				<div id="percent" class="checkbox-container renewpercent-selector">
				Percentage of Energy from Renewables:
				   <input type="hidden" name="renew_percent_query" id="renew_percent_query" />
						<ul>
						<li><label><input type="checkbox" class="check-all" /> All</label></li>	
						<li><label><input type="checkbox" value="0-10"/> 0-10</label></li>
						<li><label><input type="checkbox" value="10-20"/> 11-20</label></li>
						<li><label><input type="checkbox" value="20-30"/> 21-30</label></li>
						<li><label><input type="checkbox" value="30-40"/> 31-40</label></li>
						<li><label><input type="checkbox" value="40-50"/> 41-50</label></li>
						<li><label><input type="checkbox" value="50-60"/> 51-60</label></li>
						<li><label><input type="checkbox" value="60-70"/> 61-70</label></li>
						<li><label><input type="checkbox" value="70-80"/> 71-80</label></li>
						<li><label><input type="checkbox" value="80-90"/> 81-90</label></li>
						<li><label><input type="checkbox" value="90-100"/> 90-100</label></li>
						</ul>
				</div> <!--close "percent" -->
				<div id="renewable_index_min" class="checkbox-container">
				Renewable Index Above:
					<ul>
						<li><label><input type="checkbox" name="renew_index_5" id="renew_index_5" value="5"/> 5</label></li>
						<li><label><input type="checkbox" name="renew_index_10" id="renew_index_10" value="10"/> 10</label></li>
						<li><label><input type="checkbox" name="renew_index_15" id="renew_index_15" value="15"/> 15</label></li>
						<li><label><input type="checkbox" class="check-all" name="renew_index_20" id="renew_index_20" value="20"/> 20</label></li>
					</ul>
				</div> <!--close "renewable_index_min" -->
				<div id="renewable_type" class="checkbox-container">
				Kinds of Renewable Energy Used
					<ul>
						<li><label><input type="checkbox" class="check-all" /> All</label></li>	
						<li><label><input type="checkbox" name="renew_type_wind" id="renew_type_wind" value="wind"/> Wind</label></li>
						<li><label><input type="checkbox" name="renew_type_solar" id="renew_type_solar" value="solar"/> Solar</label></li>
						<li><label><input type="checkbox" name="renew_type_geothermal" id="renew_type_geothermal" value="geothermal"/> Geothermal</label></li>
						<li><label><input type="checkbox" name="renew_type_hydro" id="renew_type_hydro" value="hydro"/> Hydro-Electric</label></li>
						<li><label><input type="checkbox" name="renew_type_biofuels" id="renew_type_biofuels" value="biofuels"/> Biofuels</label></li>
						<li><label><input type="checkbox" name="renew_type_other" id="renew_type_other" value="other"/> Other</label></li>
					</ul>
				</div> <!--close "renewable_type" -->			
			<!--</ul> what's this doing here?-->
		</div> <!--close "selectors" -->
			<div id="search_button">
				<button type="button" id="searchButton">Search Database</button>
			</div>
			<div id="resultsContainer">
				<!--Results go here-->
	</div>  <!--close "selectors_wrapper" -->

<?php
$states_query = $_GET['states_query'];

echo $states_query;

include("footer.php");
?>





