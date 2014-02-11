<?php 
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Resume classification</title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-fileupload.css">
<link rel="stylesheet" type="text/css" href="employee.css">
<link rel="stylesheet" type="text/css" href="common.css">

<script type="text/javascript" src="bootstrap/js/bootstrap-fileupload.js"></script>
<script type="text/javascript">
function changecontent(i)
{
	var d=document.getElementById('content');
	if(i==1)
	{
		d.innerHTML="<br/><p><b>Are you looking for a job ?</b></p><p>If you are looking for a job, you can upload your resume and you can mention all your achievements, field of interest etc. You will be given with an unique id. There are two ways in which you will be benefitted. You can use this unique id to search for companies which suit your talents and your field of interest. The companies will be displayed in the order of highest to lowest matching percentage. The other one is, if the company is looking for hiring employees, and if it finds your resume a matching one, the company will contact you for job offers. </p><p><ul><li>If you need to upload your resume and search for companies, click on <b>Upload resume</b> tab.</li><li>If you have already uploaded your resume and if you want to look at all matching companies, click on <b>Look for companies</b> tab. </li></ul></p><br/>";
	}
	else
		if(i==2)
		{
			d.innerHTML="<form class='form-horizontal' method='get' id='entryform' action='upload.php'><div class='control-group'><label class='control-label' for='name'>Name : </label><div class='controls'><input type='text' name='name'/></div></div><div class='control-group'><label class='control-label' for='address'>Address : </label><div class='controls'><textarea name='address'></textarea></div></div><div class='control-group'><label class='control-label' for='phone'>Contact number : </label><div class='controls'><input type='text' name='phone'/></div></div><div class='control-group'><label class='control-label' for='mailid'>Email id : </label><div class='controls'><input type='text' name='mailid'/></div></div><div class='control-group'><label class='control-label' for='lang'>Languages known : </label><div class='controls'><textarea name='lang'></textarea></div></div><div class='control-group'><label class='control-label' for='skills'>Technical skills : </label><div class='controls'><textarea name='skills'></textarea></div></div><div class='control-group'><label class='control-label' for='achieve'>Achievements : </label><div class='controls'><textarea name='achieve'></textarea></div></div><div class='control-group'><label class='control-label' for='interest'>Field of interest : </label><div class='controls'><textarea name='interest'></textarea></div></div><div class='control-group'><label class='control-label' for='other'>Other talents : </label><div class='controls'><textarea name='other'></textarea></div></div><div class='control-group'><label class='control-label' for='hobbies'>Hobbies : </label><div class='controls'><textarea name='hobbies'></textarea></div></div><div class='control-group'><div class='controls'><button type='submit' class='btn btn-success' name='submit'>Submit</button></div></div></form><br/><center>(OR)<br/><center><form method='post' enctype='multipart/form-data' action='sc_upload.php' ><input type='file' name='doc' id='file' /><br/><button type='submit' class='btn btn-danger' name='submit'>Upload</button></form></center>";
		}
		else
		{
			d.innerHTML="<form class='form-horizontal' method='get' id='entryform' action='showcompanies.php'><div class='control-group'><label class='control-label' for='uid'>Enter your unique id : </label><div class='controls'><input type='text' name='uid'/></div></div><div class='control-group'><div class='controls'><button type='submit' class='btn btn-success' name='submit'>Show eligible candidates</button></div></div></form>";
		}
}
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
				<li class="active"><a href="#">Employee</a></li>
				<li><a href="contact.php">Contact</a></li>
			</ul>
		</div>
		<center><span id="entryhead">Employee</span></center>
		<br/>
		<center>
			<div class="btn-group">
				<button class="btn btn-primary" onclick="changecontent(1)">Home</button>
				<button class="btn btn-primary"onclick="changecontent(2)">Upload resume</button>
				<button class="btn btn-primary"onclick="changecontent(3)">Look for companies</button>
			</div>
		</center>

		<div id='content'>
			<br/>
			<p>
				<b>Are you looking for a job ?</b>
			</p>
			<p>
				If you are looking for a job, you can upload your resume and you can mention all your achievements, field of interest etc. You will be given with an unique id. There are two ways in which you will be benefitted. You can use this unique id to search for companies which suit your talents and your field of interest. The companies will be displayed in the order of highest to lowest matching percentage. The other one is, if the company is looking for hiring employees, and if it finds your resume a matching one, the company will contact you for job offers. 
			</p>
			<p>
				<ul>
					<li>If you need to upload your resume and search for companies, click on <b>Upload resume</b> tab.</li>
					<li>If you have already uploaded your resume and if you want to look at all matching companies, click on <b>Look for companies</b> tab. </li>
				</ul>
			</p>
			<br/>
		</div>

	</div>
	<?php include('sitelayout2.php'); include('footer.php'); ?>
	<?php
	if(isset($_SESSION['upload']))
	{
		if($_SESSION['upload']==1)
		{
			echo "<script type='text/javascript'>alert('Thank you. Your resume has been recorded. Come again to see the list of matching companies.Please note your unique id : \"".$_SESSION['uid']."\". ');</script>";
			$_SESSION['uid']='';
		}
		$_SESSION['upload']=0;
	}
	?>

</body>
</html>
