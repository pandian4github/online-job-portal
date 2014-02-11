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
		<center>
		<div id='navbar'>
			<ul class="nav nav-pills">
				<li class="active"><a href="#">Home</a></li>
				<li><a href="desc.php">Description</a></li>
				<li><a href="employer.php">Employer</a></li>
				<li><a href="employee.php">Employee</a></li>
				<li><a href="contact.php">Contact</a></li>
			</ul>
		</div>
		</center>
		<center><span id="entryhead">Home</span></center>
		<p>
			<b>What is Resume classification ?</b>
		</p>
		<p>
			This app eases the way in which a company recruits an employee or the way in which a person looks for a job.
		</p>
		<p>
			<b>What this app includes ?</b>
		</p>
		<p>
			The options available in this app are
			<ul>
				<li>Search for a job</li>
				<li>Recruit an employee</li>
				<li>Show all the eligible employees in the order of eligibility</li>
				<li>Show list of all companies that a person can apply for</li>
			</ul>
		</p>
		<p>
			<b>Features</b>
		</p>
		<p>
			Some of the main features of the app are : 
			<ul>
				<li>The details of the users and companies are stored online so that the user can access the information at anytime and anywhere.</li>
				<li>List all matching companies/employees ie, not just the highest matching one.</li>
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
