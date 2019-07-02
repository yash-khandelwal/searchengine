<!DOCTYPE html>
<html>

	<head>
		<title>Result page</title>
		<style type="text/css">
			.results {margin-left:12%;margin-right:12%; margin-top:10px;}
		</style>
		
	</head>
	
	<body bgcolor="#f5deb3">
		
		<form action="/result.php" method="get">
			
			<span><b>Write your Keyword:</b></span>
			<input type="text" name="user_keyword" size="120" />
			<input type="submit" name="result" value="Search Now"/>
		</form>
		<a href="search.html"><button>Go Back</button></a>
		
<?php
	$conn = mysqli_connect("localhost","root","","search");
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	else 
		//echo "h";
	mysqli_select_db($conn,"search");
	
	if(isset( $_POST['search'] )){
		$get_value = $_POST['user_query'];
		if($get_value==''){
	
		echo "<center><b>Please go back, and write something in the search box!</b></center>";
		exit();
		}
		//echo "  something   ";
		$result_query = "SELECT * FROM sites where site_keywords LIKE '%$get_value%'";
		
		$run_result = mysqli_query($conn,$result_query);
		
		if(mysqli_num_rows($run_result)<1){
			echo "<center><b>Oops! sorry, nothing was found in the database!</b></center>";
			exit();
		}
		//$i=0;
		while($row_result = mysqli_fetch_array($run_result,MYSQLI_ASSOC)){
			
			$site_name=$row_result['site_name'];
			$site_link=$row_result['site_link'];
			$site_desc=$row_result['site_desc'];
			$site_image=$row_result['site_image'];
			//echo "$i";
			//$i++;
		echo"<div class='results'>
		
			<h2>$site_name</h2>
			<a href='$site_link' target='_blank'>$site_link</a>
			<p align='justify'>$site_desc</p>
			<img src='images/$site_image' width='100' height='100' />
		
		</div>";
		
		}
	}
	
?>
	</body>

</html>