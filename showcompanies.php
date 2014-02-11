<?php
	$uid=$_REQUEST['uid'];
	
	include('connect.php');

	$query="SELECT `category` from `resume`.`resume` where `uid`='$uid';";
	$res=mysqli_query($dbc,$query) or die("Error in query");
	$res=mysqli_fetch_array($res);
	$cat=$res['category'];

	$source='resumes/'.$uid.'.txt';
	$file=fopen($source,"r");
	$res=fread($file, filesize('resumes/'.$uid.'.txt'));
	fclose($file);

	$file=fopen('tempfiles/source.txt',"w+");
	system("echo alohomora | sudo chmod 777 tempfiles/source.txt");
	fwrite($file,$res);
	fclose($file);

	$query="SELECT `uid` from `resume`.`requirements` where `category`='$cat';";
	$res=mysqli_query($dbc,$query);
	
	$name=array();
	$count=array();

	while(($r=mysqli_fetch_array($res))!=NULL)
	{
		$dest='requirements/'.$r['uid'].".txt";
		//echo $dest;
		$file=fopen($dest,"r");
		$req=fread($file,filesize($dest));
		fclose($file);

		$file=fopen('tempfiles/dest.txt',"w+");
		//system("echo alohomora | sudo chmod 777 tempfiles/dest.txt");
		fwrite($file,$req);
		fclose($file);

		system("./score > tempfiles/scoreans.txt");
		//system("echo alohomora | sudo chmod 777 tempfiles/scoreans.txt");

		$file=fopen('tempfiles/scoreans.txt',"r");
		$cont=fread($file,filesize('tempfiles/scoreans.txt'));
		$score=intval($cont);
		fclose($file);

		array_push($name, $r['uid']);
		array_push($count, $score);
	}	

	//Sort the resumes based on scores
	for($i=0;$i<count($count);$i++)
		for($j=$i+1;$j<count($count);$j++)
			if($count[$i]<$count[$j])
			{
				$t=$count[$i];
				$count[$i]=$count[$j];
				$count[$j]=$t;
				$t=$name[$i];
				$name[$i]=$name[$j];
				$name[$j]=$t;
			}
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
			d.innerHTML="<form class='form-horizontal' method='get' id='entryform' action='upload.php'><div class='control-group'><label class='control-label' for='name'>Name : </label><div class='controls'><input type='text' name='name'/></div></div><div class='control-group'><label class='control-label' for='address'>Address : </label><div class='controls'><textarea name='address'></textarea></div></div><div class='control-group'><label class='control-label' for='phone'>Contact number : </label><div class='controls'><input type='text' name='phone'/></div></div><div class='control-group'><label class='control-label' for='mailid'>Email id : </label><div class='controls'><input type='text' name='mailid'/></div></div><div class='control-group'><label class='control-label' for='lang'>Languages known : </label><div class='controls'><textarea name='lang'></textarea></div></div><div class='control-group'><label class='control-label' for='skills'>Technical skills : </label><div class='controls'><textarea name='skills'></textarea></div></div><div class='control-group'><label class='control-label' for='achieve'>Achievements : </label><div class='controls'><textarea name='achieve'></textarea></div></div><div class='control-group'><label class='control-label' for='interest'>Field of interest : </label><div class='controls'><textarea name='interest'></textarea></div></div><div class='control-group'><label class='control-label' for='other'>Other talents : </label><div class='controls'><textarea name='other'></textarea></div></div><div class='control-group'><label class='control-label' for='hobbies'>Hobbies : </label><div class='controls'><textarea name='hobbies'></textarea></div></div><div class='control-group'><div class='controls'><button type='submit' class='btn btn-success' name='submit'>Submit</button></div></div></form><br/><center>(OR)<br/><br/><div class=\"fileupload fileupload-new\" data-provides=\"fileupload\"><div class=\"input-append\"><div class=\"uneditable-input span3\"><i class=\"icon-file fileupload-exists\"></i> <span class=\"fileupload-preview\"></span></div><span class=\"btn btn-file\"><span class=\"fileupload-new\">Select file</span><span class=\"fileupload-exists\">Change</span><input type=\"file\" /></span><a href=\"#\" class=\"btn fileupload-exists\" data-dismiss=\"fileupload\">Remove</a></div></div><button type='submit' class='btn btn-danger' name='submit'>Upload</button></center>";
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
			<br/>
			<?php
				for($i=0;$i<count($name);$i++)
				{
					echo "<center><a class='btn btn-danger' href='requirements/".$name[$i].".txt' target='_blank'>Company : ".$i." - ".$count[$i]."</a></center>";
					echo "<br/>";
				}
			?>
			<br/>
		</div>

	</div>
	<?php include('sitelayout2.php'); include('footer.php'); ?>

</body>
</html>
