<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
	require("db.php");
?>

<html>
    <head>
        <title> 
        
        <?php if(isset($title)) {
        	print($title); 
        	} 
        ?> </title>
        <link rel="stylesheet" href="style.css" />
		<script src="http://code.jquery.com/jquery-1.6.3.min.js"></script>
	<header class="no_side">
				<h1>
					<img align="middle" class="small_logo" src="images/renewcyclenostroke.png" />
					Higher Education Green Energy Index
				</h1>
			</header>
	