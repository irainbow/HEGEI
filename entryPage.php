<?php
	$title="HEGEI Join Database";
	include("header.php");
	
?>
			<!-- Import jQuery -->
			<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
			
			<!-- Import jQuery Validation Plugin -->
			<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.8.1/jquery.validate.min.js"></script>
			
			<!-- Javascript code block which is executed when the page is loading -->
			<script type="text/javascript">
				$(function(){
					// This function will get executed once the page is loaded
					
					// Add a * after required input elements
					$("label.required").after("*");
										
					// Enable validation on the form, as per the jQuery form validation documentation at
					// http://docs.jquery.com/Plugins/Validation
					
					// The first bit, $("form") gives you a jQuery object for all <form/> elements on the page.
					// The call to validate() enables basic validation on the form
					$("#createSchoolForm").validate();
					
					$("#createNewSchoolButton").click(function(){
						$("#selectSchoolPanel, #choicePanel").hide();
						$("#createSchoolPanel").show();
					});
					
					$("#updateSchoolButton").click(function(){
						$("#createSchoolPanel, #choicePanel").hide();
						$("#selectSchoolPanel").show();
					});
				});
			</script>
			
			<!-- In-page styles, useful for adding new styles without modifying an existing file, but you should probably have a style.css eventually -->
		</head>
		<body>	
			<h1>Green Energy Index Survey</h1> 
			<h2>School Information</h2>
			
			<div id="choicePanel">
				Welcome! Please indicate whether you would like to update an existing record, or create new one			
				<div>
					<button type="button" id="createNewSchoolButton">Create a New School</button>
					<button type="button" id="updateSchoolButton">Update an Existing School</button>
				</div>
			</div>
			
			<div id="createSchoolPanel" style="display: none;">
				<form action="create_school.php" method="POST" id="createSchoolForm">
					<div>
						<label for="school_name">School Name: </label>
						<input class="required" type="text" name="school_name" id="school_name" /> 
					</div>
					
					<div>
						<label for="state">State: </label>
						<select name="state" id="state" class="required">
							<option value="AL">Alabama</option>
							<option value="AK">Alaska</option>
							<option value="AZ">Arizona</option>
							<option value="AR">Arkansas</option>
							<option value="CA">California</option>
							<option value="CO">Colorado</option>
							<option value="CT">Connecticut</option>
							<option value="DE">Delaware</option>
							<option value="DC">District of Columbia</option>
							<option value="FL">Florida</option>
							<option value="GA">Georgia</option>
							<option value="HI">Hawaii</option>
							<option value="ID">Idaho</option>
							<option value="IL">Illinois</option>
							<option value="IN">Indiana</option>
							<option value="IA">Iowa</option>
							<option value="KS">Kansas</option>
							<option value="KY">Kentucky</option>
							<option value="LA">Louisiana</option>
							<option value="ME">Maine</option>
							<option value="MD">Maryland</option>
							<option value="MA">Massachusetts</option>
							<option value="MI">Michigan</option>
							<option value="MN">Minnesota</option>
							<option value="MS">Mississippi</option>
							<option value="MO">Missouri</option>
							<option value="MT">Montana</option>
							<option value="NE">Nebraska</option>
							<option value="NV">Nevada</option>
							<option value="NH">New Hampshire</option>
							<option value="NJ">New Jersey</option>
							<option value="NM">New Mexico</option>
							<option value="NY">New York</option>
							<option value="NC">North Carolina</option>
							<option value="ND">North Dakota</option>
							<option value="OH">Ohio</option>
							<option value="OK">Oklahoma</option>
							<option value="OR">Oregon</option>
							<option value="PA">Pennsylvania</option>
							<option value="RI">Rhode Island</option>
							<option value="SC">South Carolina</option>
							<option value="SD">South Dakota</option>
							<option value="TN">Tennessee</option>
							<option value="TX">Texas</option>
							<option value="UT">Utah</option>
							<option value="VT">Vermont</option>
							<option value="VA">Virginia</option>
							<option value="WA">Washington</option>
							<option value="WV">West Virginia</option>
							<option value="WI">Wisconsin</option>
							<option value="WY">Wyoming</option>
						</select>
					</div>

					<div>
						<label for="zip">ZIP: </label>
						<input class="required" type="text" name="zip" id="zip" /> 
					</div>
					
					<div>
						<input type="checkbox" name="private_ownership" id="private_ownership" />
						<label for="private_ownership">
							Privately Owned
						</label>
					</div>
					
					<button type="submit">Continue to Data Entry</button>
				</form>
			</div>

			<div id="selectSchoolPanel" style="display: none;">
				<form action="surveyEntry.php" method="GET">

	<select name="school_id">
	<?php
		foreach (list_schools() as $row){
	?>
	    <option value="<?=$row['id'] ?>"><?=$row['name'] ?></option>
<?php } ?></select>
					<button type="submit">Continue to Data Entry</button>
				</form>
			</div>
		</body>
	</html>
		
	
	
