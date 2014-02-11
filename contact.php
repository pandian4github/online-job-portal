<?php 
session_start(); 
//if(!isset($_SESSION['hrloggedin']))
//{
//	header("location:login.php");
//}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Resume classification</title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-fileupload.css">
<link rel="stylesheet" type="text/css" href="index.css">
<link rel="stylesheet" type="text/css" href="common.css">

<script type="text/javascript" src="bootstrap/js/bootstrap-fileupload.js"></script>
<script type="text/javascript">
function showerror(i)
{
	var error=["nameerror","rollnoerror","phoneerror","mailiderror","batcherror"];
	var x=document.getElementById(error[i]);
	x.className="visible";
}
</script>
</head>
<body>

	<?php include("sitelayout.php"); ?>
	<div class="span8" id="main-content">
		<br/>
		<div id='navbar'>
			<ul class="nav nav-pills">
				<li><a href="index.php">Home</a></li>
				<li><a href="desc.php">Description</a></li>
				<li><a href="employer.php">Employer</a></li>
				<li><a href="employee.php">Employee</a></li>
				<li class="active"><a href="#">Contact</a></li>
			</ul>
		</div>
		<center><span id="entryhead">Contact</span></center>
		<p>
			<b>Origin : </b>
		</p>
		<p>
			This app has been developed as a part of 6th semester compilers project by students of College of Engineering, Guindy under the guidance of Dr.Rajeswari, Assistant Professor, Department of Computer Science, Anna university. If you have any query regarding the app or if you have any feedback to provide you are most welcome to contact us.
		</p>
		<p>
			<b>Contact : </b>
		</p>
		<p>
			<ul>
				<li>R.Pandian - pandian4mail@gmail.com</li>
				<li>N.Ashwin  - ash.fastfire@gmail.com</li>
				<li>M.Sathish - sathish.mohan@gmail.com</li>
			</ul>
		</p>
		<br/>


	</div>
	<?php include('sitelayout2.php'); include('footer.php'); ?>
	<?php
	if(isset($_SESSION['passchanged']))
		if($_SESSION['passchanged']==1)
		{
			echo "<script type='text/javascript'> alert('Password changed !'); </script>";
			$_SESSION['passchanged']=0;
		}
	if(isset($_SESSION['updatesuccess']))
		if($_SESSION['updatesuccess']==1)
		{
			echo "<script type='text/javascript'> alert('Updated successfully !'); </script>";
			$_SESSION['updatesuccess']=0;
		}
	if(isset($_SESSION['entrysuccess']))
		if($_SESSION['entrysuccess']==1)
		{
			echo "<script type='text/javascript'> alert('Entry successful'); </script>";
			$_SESSION['entrysuccess']=0;
		}
			$_SESSION['entryerror']=0;
				
		?>
</body>
</html>
