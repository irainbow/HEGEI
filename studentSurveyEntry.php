<?php
	$title="HEGEI - Data Entry Form";
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
			
			// The first bit, $("form") gives a jQuery object for all <form/> elements on the page.
			// The call to validate() enables basic validation on the form
			$("form").validate();
		
			$("input[name=gf]").change(function(){
				if (this.value=="1"){
					$("#greenFeeAmount").show();
				}
				else {
					$("#greenFeeAmount").hide();
				}
					
			});	
		});
			
	</script>
	<?php
		$school_id = $_GET['school_id']; //Retrieves ID from posted entrypage
		$school = find_school($school_id);
	?>
</head>
<body>
      	<div id="wrapper">
			<form action="entryProcess.php" method="post">
				<input class="required" type="hidden" name="school_id" id="school_id" value="<?php echo $school_id?>" /> 
			
				<div class="form-section">
				<h1>Student Sustainability Knowledge and Interest Survey</h1> 
				<p>
					Feel free to decline to state any fill-in-the blank answers. This is supposed to be short, easy, and non-invasive! We'll keep all your info anonymous, even if you do give us your email, and we'll only ever publish/share or present aggregate data from the overall study, not your one entry. Thanks so much for filing this out for us, you're the best!
				</p>
				<h2>For <em><?= $school['name'] ?></em></h2>
				<h2> General Information </h2>
				<div class="small_note"> * = Required Field</div>
					<div class="form-item">
					<ol><!--Question 1 -->
						<li> 
							<label for="number_of_students">Number of Students:</label>
							<input class="required number" type="text" name="students"/>
						</li>  <!--Question 2 -->
					<div id="greenFeeQuestion">
						<li><label for="gf"> <!--Question 5 -->Does your school have a student green/sustainability fee?</label></li>
							<ul>
								<li><label><input type="radio" name="gf" value="1"/> Yes </label></li>
								<li><label><input type="radio" name="gf" value="0"/> No </label></li>
							</ul>	
						<div id="greenFeeAmount" style="display:none;">
							<label for="green_fee_amount"><!--Question 6--> How much is it, per student, per year?</label>
				 			<label><input class="required number" type="text" name="green_fee_amount" id="green_fee_amount" /></label> USD
						</div> <!--Closes greenFeeAmount div-->
					</div> <!--Closes greenFeeQuestion div-->
									<div class="factbox">
	Did you know? Student Green Fees can correlate directly with renewable energy purchased by institutions reporting to the ACUPCC, making green fees one of the most important aspects of sustainability at a college or university.
									</div>				 		
				 		<li><label for="sustco"><!--Question 7--> Does your school have a sustainability director or coordinator, either for students or administration?</label></li>
							<ul>
								<li><label><input type="radio" name="sustco" value="1"</input> Yes </label></li>
								<li><label><input type="radio" name="sustco" value="0"</input> No </label></li>
							</ul>
							
				 	<h2> Renewable Energy </h2>
	
				 		<li><label for="renewperc"><!--8--> What percentage of your institution's energy use is derived from renewable sources?</label></li> 
				 			<input class="required number" type="text" name="renewperc" size="1em"/> 
						<li><label for="renewable_type"><!--9--> Kinds of renewable energy used (Check any that make up more than 10% of total usage)</label>
							<ul>
								<span class="at-least-one-child-required" id="renewable_type">
									<li><label><input type="checkbox" name="wind" value="1" /> Wind </label>
									<li><label><input type="checkbox" name="solar" value="1" /> Solar </label> 
									<li><label><input type="checkbox" name="geothermal" value="1" /> Geothermal</label>
									<li><label><input type="checkbox" name="hydro" value="1" /> Hydro-electric </label>
									<li><label><input type="checkbox" name="biofuels" value="1" /> Biofuels (Please Specify)<input type=text name="biofuels_type"/></label><!--I want to make this required, dependent on the checkbox before it-->
									<li><label><input type="checkbox" name="other" value="1" /> Other (Please Specify)<input type=text name="other_type"/></label>
								</span>
							</ul>
						<li><label for="renewablepurchase" > How does your institution obtain the majority of the renewable energy described above?<!--10--></label>
								<ul>
									<li><input type="radio" name="renewablepurchase" id="utilitysupply" value="0" /> a. It is part of the fuel mix provided to all customers by the utility from which we purchase our electricity</li></label>
									<li><label><input type="radio" name="renewablepurchase" id="greenmix" value="1"/> b. It is part of the “Green” fuel mix option provided at a special price by the utility from which we purchase our electricity</li></label>
									<li><label><input type="radio" name="renewablepurchase" id="REC" value="2" />  c. It is in the form of Renewable Energy Certificates</li></label>
									<li><label><input type="radio" name="renewablepurchase" id="offsite" value="3"/> d. It is from a project, which either through land or funding, our institution has sponsored, for the purpose of providing energy to our institution.</li></label>
									<li><label><input type="radio" name="renewablepurchase" id="onsite" value="4"/> e. It is from an on-site project designed to produce electricity, but also to potentially serve educational purposes as well.</li></label>
									<li><label><input type="radio" name="renewablepurchase" id="noinfo" value="no info"/>  f. No information</li></label>
								</ul>
						</li>
						<li> <!--12--> Who is your commercial electricity provider?
							<input type="text" name="elecprov" class="required"/>
						</li>
						<li> <!--13--> What is your institution’s total electrical footprint in mWh?
							<input type="text" name="elecfp"/>
						</li>
						<li> <!--14--> What percent, if any, of your own electrical power does your institution generate?
							<input type="text" name="selfgen" class="number"/>
						</li>
						<li>
							<!--15--> Describe how this power is generated? 
							<input type="text" name="selfgen_description" /> <!--Make this required if answer to question 13 is more than 0-->
						</li>
				<h2> Green Building: </h2>
						<li><label for="green_policy"><!--16-->Is your institution committed to a formal green building policy, such as LEED standards?</label></li>
							<ul>
								<li><label><input type="radio" name="green_policy" value="4" /> a. Yes, for all new buildings but not major renovations.</li>
								<li><label><input type="radio" name="green_policy" value="3" />  b. Yes, for all new buildings and major renovations</li>
								<li><label><input type="radio" name="green_policy" value="2" />  c. No, we plan on implementing one soon</li>
								<li><label><input type="radio" name="green_policy" value="1" />  d. No, we have considered it, but not implemented it.</li>
								<li><label><input type="radio" name="green_policy" value="0" /> e. No, we have never considered such a policy</li>
							</ul>
						</li>
						<li><!--17-->What is the level of requirement for this green building policy?
							<ul>
								<li><label><input type="radio" name="green_policy_req" value="lcertified" /> a. LEED Certified</label></li>
								<li><label><input type="radio" name="green_policy_req" value="lsilver" />  b. LEED Silver</label></li>
								<li><label><input type="radio" name="green_policy_req" value="lgold" />  c. LEED Gold</label></li>
								<li><label><input type="radio" name="green_policy_req" value="lplatinum" />  d. LEED Platinum</label>
								<li><label><input type="radio" name="green_policy_req a" value="another" /> e.  Another Green Building policy not specifically associated with LEED (please specify)</label><input type="text" name="othergreenpolicy" /></li>
							</ul>
						</li>
						<li><!--18-->Does the policy require that buildings built to these standards seek certification?
							<ul>
								<li><label><input class="required" type="radio" name="certreq" value="yes"/> Yes </label></li>
								<li><label><input class="required" type="radio" name="certreq" value="no" /> No </label></li>
								<li><label><input class="required" type="radio" name="certreq" value="unknown" /> I don't know </label></li>
							</ul>
						</li>
						<li><!--19-->Is your institution subject to any state standards regarding LEED standards for building construction and use?
							<ul>
								<li><label><input type="radio" name="satereq" class="required" value="yes"/> Yes </label></li>
								<li><label><input type="radio" name="satereq" class="required" value="no" /> No </label></li>
							</ul>
						</li>
						<li><label for="buildingNumber" /><!--20-->Approximately how many buildings does your campus have?</label>
							<input class="required" name="buildingNumber" type="text"/>
						</li>
						<li><!--21-->How many buildings are certified to meet the following green-building criteria?
							<ul>
								<li><label for="lcertifiedNumber"/> 1. Leed Certified: </label><input type="text" name="lcertifiedNumber" size=4px class="required"</li>
								<li><label for="lsilverNumber" /> 2. Leed Silver: </label><input type="text" name="lsilverNumber" size=4px class="required"/> </li>
								<li><label for="lgoldNumber"/> 3. Leed Gold: </label><input type="text" name="lgoldNumber" size=4px class="required"/> </li>
								<li><label for="lplatinumNumber"/> 4. Leed Platinum:</label> <input type="text" name="lplatinumNumber" size=4px class="required"/> </li> 
								<li><label for="nonleedNumber"/>5. Non-LEED Green Building Standard:</label> <input type="text" name="nonleedNumber" size=4px class="required"/> </li>				
							</ul>
						</li>
						<li><!--22-->How many buildings meet the following green-building criteria, but are not certified?
							<ul>
								<li><label for="lcertifiedncNumber"/> 1. Leed Certified: </label><input type="text" name="lcertifiedncNumber" size=4px class="required"</li>
								<li><label for="lsilverncNumber" /> 2. Leed Silver: </label><input type="text" name="lsilverncNumber" size=4px class="required"/> </li>
								<li><label for="lgoldncNumber"/> 3. Leed Gold: </label><input type="text" name="lgoldncNumber" size=4px class="required"/> </li>
								<li><label for="lplatinumncNumber"/> 4. Leed Platinum:</label> <input type="text" name="lplatinumncNumber" size=4px class="required"/> </li> 
								<li><label for="nonleedncNumber"/>5. Non-LEED Green Building Standard:</label> <input type="text" name="nonleedncNumber" size=4px class="required"/> </li>
							</ul>
						</li>
					</ol>
				</div>
			<button type="submit">Submit Form</button> 
		</form>
	</body>
</html>
		
	
	
