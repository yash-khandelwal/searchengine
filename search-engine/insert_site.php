<!DOCTYPE html>
<html>
	<head>
		<title>Search Engine</title>
	</head>
	<body bgcolor="gray">
		<form action="insert_site.php" method="post" enctype="multipart/form-data">
			<table bgcolor="orange" width="500" border="2" cellspacing="2" align="center">
				<tr>
					<td colspan="5"><h2 align="center">Inserting new website:</h2></td>
				</tr>
				<tr>
					<td align="right"><b>Site Name:</b></td>
					<td><input type="text" name="site_name"/></td>
				</tr>
				<tr>
					<td align="right"><b>Site Link:</b></td>
					<td><input type="text" name="site_link"/></td>
				</tr>
				<tr>
					<td align="right"><b>Site Keywords:</b></td>
					<td><input type="text" name="site_keywords"/></td>
				</tr>
				<tr>
					<td align="right"><b>Site Description:</b></td>
					<td><textarea colspan="25" rows="2" name="site_desc"></textarea></td>
				</tr>
				<tr>
					<td align="right"><b>Site Image:</b></td>
					<td><input type="file" name="site_image"/></td>
				</tr>
				<tr>
					<td align="center" colspan="5"><input type="submit" name="submit" value="Add Site Now"/></td>
				</tr>
			</table>
		</form>
	</body>
</html>
<?php
	$conn = mysqli_connect("localhost","root","","search");
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	echo "Connected successfully";
	mysqli_select_db($conn,"search");
	
	if(isset($_POST['submit']))
	{
		$site_name=$_POST['site_name'];
		$site_link=$_POST['site_link'];
		$site_keywords=$_POST['site_keywords'];
		$site_desc=$_POST['site_desc'];
		$site_image=$_FILES['site_image']['name'];
		$site_image_tmp=$_FILES['site_image']['tmp_name'];
		
		if($site_name=='' OR $site_link=='' OR $site_keywords=='' OR $site_desc=='')
		{
			echo"<script>alert('please fill all the fields')</script>";
			exit();
		}
		
		$insert_query="insert into sites(site_name,site_link,site_keywords,site_desc,site_image) value('$site_name','$site_link','$site_keywords','$site_desc','$site_image')";
		
		move_uploaded_file($site_image_tmp,"images/{$site_image}");
		
		if(mysqli_query($conn,$insert_query,MYSQLI_STORE_RESULT)){
			echo "<script>alert('Data inserted into the table')</script>";
		}
		else{
			echo "<script>alert('data is not inserted')</script>";
			exit();
		}
	}
?>