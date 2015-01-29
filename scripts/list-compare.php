<!DOCTYPE html>
<html lang="en">
  <head>
<!--
		Created by Daniel Iversen - www.nexle.dk & www.nexle.dk/daniel
-->  	
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Free Online (Name) Text List comparison tool</title>
    <style>
    textarea {
   		width: 100%;
   		height: 600px;
	}
	#resultsbox {
    	background-color:#CCFFFF;
	}


    </style>
    <title></title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

</head>
<body>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-5573482-2', 'auto');
  ga('send', 'pageview');

</script>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand">Daniel Iversen</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="http://www.nexle.dk">Blog</a></li>
            <li><a href="http://www.nexle.dk/daniel">Resume</a></li>
            <li><a href="https://au.linkedin.com/in/danieliversen">LinkedIn</a></li>
            <li><a href="http://www.twitter.com/daniel_iversen">Twitter</a></li>
          </ul>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
		<h1>Free Online (Name) Text List comparison tool</h1>

        <p>This little tool solves a real problem of being able to loosely compare and find matches between 2 seperate lists of names, lines or words. While modern text editors can compare files for literal technical matching lines they are not good at "rough"/fuzzy matches (they can usually do case insensitive matches but thats it).</p>
        <p>The tool compares two sets of data, each line is compared (order of lines is irrelevant we will compare each line in each set to each line in the other set), considering near-matches, fuzzy logic and more in for you to find out of there are similarities between the two sets. The tool caters for case-insensitive data, ordering and uses techniques like Metaphone, Levenshtein, factual matching and other algorithms.</p>
        <p>For example:
			<ul>"Daniel Iversen" matches "Daniel Iverson"</ul>
			<ul>"Nexle Consulting" matches "Nexle Consulting Inc</ul>
			<ul>"Aple" matches "APPLE"</ul>
			<ul>"Park St., Sydney NSW" matches "12/32 Park Street Sydney New South Wales"</ul>
			<ul>Etc.</ul>
		Fill in the boxes below to get started and have fun! If the tool helped you in some cool or important way it would be nice if you dropped me a line on email address "daniel (at) nexle (dot) dk" :-)
        </p>

      </div>
    </div>

    <div class="container">














<?php


if(isset($_POST["list1"])) 
{ 


	$characterlimit = 75000; 
	$left_size = strlen($_POST['list1']);
	$right_size = strlen($_POST['list2']);

	if($left_size > $characterlimit){
		echo "ERROR: Set on left side is too large, left hand size is $left_size and right hand size is $right_size, but only 75,000 characters max supported per set (contact <a href='www.nexle.dk/daniel'>Daniel Iversen</a> for an increase)!";
		exit;
	}

	if($right_size > $characterlimit){
		echo "ERROR: Set on right side is too large, left hand size is $left_size and right hand size is $right_size, but only 75,000 characters max supported per set (contact <a href='www.nexle.dk/daniel'>Daniel Iversen</a> for an increase)!";
		exit;
	}

	?>

      <div class="row" id="resultsbox">
        <div class="col-md-12">
        	<h2>Your comparison results:</h2>
        	<ul>
	<?php
		//  Compare Strings ...  Return Matching Text and Differences with Product IDs...

		//  From MySql...
		$productID1 = 'abc123';
		//$productName1 = "EcoPlus Premio Jet 600";   
		$productName1 = $_POST["list1"];

		$productID2 = 'xyz789';
		//$productName2 = "EcoPlus Premio Jet 800";   
		$productName2 = $_POST["list2"];





		//explode all separate lines into an array
		$CompanyList1 = explode("\r\n", $productName1);

		//trim all lines contained in the array.
		$CompanyList1 = array_filter($CompanyList1, 'trim');

		//loop through the lines
		foreach($CompanyList1 as $Company1){
			//echo "11111 - $Company1";

			//explode all separate lines into an array
			$CompanyList2 = explode("\r\n", $productName2);

			//trim all lines contained in the array.
			$CompanyList2 = array_filter($CompanyList2, 'trim');

			//loop through the lines
			foreach($CompanyList2 as $Company2){
				//echo "11111 - $Company2";

				compareNames($Company1, $Company2);		
			}

		}
		?>
		</ul>
    </div>
    </div>
		<?php
}
		    



	function compareNames($name1, $name2)
	{   


		//print "starting...<br/>";

			$couldbesame = false;



	    	if(trim($name1)==trim($name2))
	    	{
	    		//echo "<li><i>(100% match)</i> | <strong>" . $name1 . "</strong> | is identical to | " . $name2 . "</li>" . PHP_EOL; //print value	
	    		echo "<li><strong>" . $name1 . "</strong> | is identical to | " . $name2 . "</li>" . PHP_EOL; //print value	
	    		return;
	    	}
	    	else
	    	{
	    		//echo $Company1 . " does not match " . $Company2 . "<br>" . PHP_EOL; //print value	
	    	}



			$known = $name1;
			$query = $name2;

			/*
			if (soundex($known) == soundex($query)) {
			  print "soundex | $known | sounds like | $query<br>";
	    		return;
			} else {
			  //print "soundex: $known doesn't sound like $query<br>";
			}
			*/
			if (metaphone($known) == metaphone($query)) {
			  //print "<li><i>(metaphone)</i> | <strong>$known</strong> | sounds like | $query</li>";
			  echo "<li><strong>$known</strong> | sounds like | $query</li>";
	    		return;
			} else {
			  //print "metaphone: $known doesn't sound like $query<br>";
			}

			$common = similar_text($name1, $name2, $percent);
			if($percent>85){
	    		//echo "<li><i>(similarity)</i> | <strong>" . $name1 . "</strong> | has $percent in common with | " . $name2 . "</li>" . PHP_EOL; //print value	
	    		echo "<li><strong>" . $name1 . "</strong> | has $percent in common with | " . $name2 . "</li>" . PHP_EOL; //print value	
			}

	}

	function issetor(&$var, $default = false) 
	{
    	return isset($var) ? $var : $default;
	}




?>













      <div class="row">
        <div class="col-md-12">
          <h2>Compare lists</h2>
          <p>Please paste 2 different sets of names (people names, company names, etc - whatever you want to compare) in the boxes below and click the button to start processing.</p>


		    <form action="http://www.nexle.dk/tools/list-compare/?submitted=true" method="post">
		    	<table width="100%" border="0">
		    			<tr height="600">
		    				<td><strong>List 1 (left)</strong><br/><textarea name="list1" placeholder="Paste/insert list of names in here"><?=issetor($_POST["list1"]) ?></textarea></td>
		    				<td><strong>List 2 (right)</strong><br/><textarea name="list2" placeholder="Paste/insert list of names in here"><?=issetor($_POST["list2"]) ?></textarea></td>
		    			</tr>
		    	</table>

		        <input class="btn btn-lg btn-sucess"  type="submit" value="Submit list for comparison results"/>
		    </form>


        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
			<p>&nbsp;</p>
			<p>This PHP page/code is hosted online for use on <a href="http://www.nexle.dk/tools/list-compare/">www.nexle.dk/tools/list-compare/</a> and is also available for free download on <a href="https://github.com/danieliversen/MiscStuff/tree/master/scripts">Daniel Iversen's GitHub repo</a></p>
        </div>
      </div>
      <hr>

      <footer>
        <p>&copy; Daniel Iversen 1999-2015, All rights reserved.</p>
      </footer>
    </div> <!-- /container -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>
