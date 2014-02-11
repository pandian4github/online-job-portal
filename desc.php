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
				<li class="active"><a href="#">Description</a></li>
				<li><a href="employer.php">Employer</a></li>
				<li><a href="employee.php">Employee</a></li>
				<li><a href="contact.php">Contact</a></li>
			</ul>
		</div>
		<center><span id="entryhead">Description</span></center>
		<p>
			<b>Are you an employer ?</b>
		</p>
		<p>
			If you are an employer and if you are looking to hire some skillful persons for your company, you can very well utilise this app. What you are supposed to do is enter all your requirements in the field provided for eg, various technologies to be known by the employee etc. Once you enter the requirements and submit the form, you will be given an unique id. Using this id, after a week or so, you can come and check whether any matching resumes have been found. If any resumes are found, they will be displayed in the order of highest to lowest matching percentage. It will facilitate you to pick up the employees.
		</p>
		<p>
			<b>Are you looking for a job ?</b>
		</p>
		<p>
			If you are looking for a job, you can upload your resume and you can mention all your achievements, field of interest etc. You will be given with an unique id. There are two ways in which you will be benefitted. You can use this unique id to search for companies which suit your talents and your field of interest. The companies will be displayed in the order of highest to lowest matching percentage. The other one is, if the company is looking for hiring employees, and if it finds your resume a matching one, the company will contact you for job offers. 
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
