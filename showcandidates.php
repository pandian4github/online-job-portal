<?php
	$uid=$_REQUEST['uid'];
	
	include('connect.php');

	$query="SELECT `category` from `resume`.`requirements` where `uid`='$uid';";
	$res=mysqli_query($dbc,$query) or die("Error in query");
	$res=mysqli_fetch_array($res);
	$cat=$res['category'];

	$source='requirements/'.$uid.'.txt';
	$file=fopen($source,"r");
	$req=fread($file, 1000);
	fclose($file);

	$file=fopen('tempfiles/source.txt',"w+");
	system("echo alohomora | sudo chmod 777 tempfiles/source.txt");
	fwrite($file,$req);
	fclose($file);

	$query="SELECT `uid` from `resume`.`resume` where `category`='$cat';";
	$res=mysqli_query($dbc,$query);
	
	$name=array();
	$count=array();

	while(($r=mysqli_fetch_array($res))!=NULL)
	{
		$dest='resumes/'.$r['uid'].".txt";
		$file=fopen($dest,"r");
		$ress=fread($file,filesize($dest));
		fclose($file);

		$file=fopen('tempfiles/dest.txt',"w+");
		system("echo alohomora | sudo chmod 777 tempfiles/dest.txt");
		fwrite($file,$ress);
		fclose($file);

		system("./score > tempfiles/scoreans.txt");
		system("echo alohomora | sudo chmod 777 tempfiles/scoreans.txt");

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
<link rel="stylesheet" type="text/css" href="employer.css">
<link rel="stylesheet" type="text/css" href="common.css">

<script type="text/javascript" src="bootstrap/js/bootstrap-fileupload.js"></script>
<script type="text/javascript">
function changecontent(i)
{
	var d=document.getElementById('content');
	if(i==1)
	{
		d.innerHTML="<br/><p><b>Are you an employer ?</b></p><p>If you are an employer and if you are looking to hire some skillful persons for your company, you can very well utilise this app. What you are supposed to do is enter all your requirements in the field provided for eg, various technologies to be known by the employee etc. Once you enter the requirements and submit the form, you will be given an unique id. Using this id, after a week or so, you can come and check whether any matching resumes have been found. If any resumes are found, they will be displayed in the order of highest to lowest matching percentage. It will facilitate you to pick up the employees.</p><p><ul><li>If you need to submit your requirements and search for employees, click on <b>Enter requirements</b> tab.</li><li>If you have already submitted your requirements and if you want to look at all eligible candidates, click on <b>See eligible candidates</b> tab.</li></ul></p><br/>";
	}
	else
		if(i==2)
		{
			d.innerHTML="<form class='form-horizontal' method='get' id='entryform' action='enterreq.php'><div class='control-group'><label class='control-label' for='company'>Company name : </label><div class='controls'><input type='text' name='company'/></div></div><div class='control-group'><label class='control-label' for='address'>Address : </label><div class='controls'><textarea name='address'></textarea></div></div><div class='control-group'><label class='control-label' for='name'>Name of person : </label><div class='controls'><input type='text' name='name'/></div></div><div class='control-group'><label class='control-label' for='phone'>Contact number : </label><div class='controls'><input type='text' name='phone'/></div></div><div class='control-group'><label class='control-label' for='mailid'>Email id : </label><div class='controls'><input type='text' name='mailid'/></div></div><div class='control-group'><label class='control-label' for='req'>Requirements : </label><div class='controls'><textarea name='req'></textarea></div></div><div class='control-group'><div class='controls'><button type='submit' class='btn btn-success' name='submit'>Submit</button></div></div></form>";
		}
		else
		{
			d.innerHTML="<form class='form-horizontal' method='get' id='entryform' action='showcandidates.php'><div class='control-group'><label class='control-label' for='uid'>Enter your unique id : </label><div class='controls'><input type='text' name='uid'/></div></div><div class='control-group'><div class='controls'><button type='submit' class='btn btn-success' name='submit'>Show eligible candidates</button></div></div></form>";
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
				<li class="active"><a href="#">Employer</a></li>
				<li><a href="employee.php">Employee</a></li>
				<li><a href="contact.php">Contact</a></li>
			</ul>
		</div>
		<center><span id="entryhead">Employer</span></center>
		<br/>
		<center>
			<div class="btn-group">
				<button class="btn btn-primary" onclick="changecontent(1)">Home</button>
				<button class="btn btn-primary"onclick="changecontent(2)">Enter requirements</button>
				<button class="btn btn-primary"onclick="changecontent(3)">See eligible candidates</button>
			</div>
		</center>
		<div id='content'>
			<br/>
			<?php
				for($i=0;$i<count($name);$i++)
				{
					echo "<center><a class='btn btn-danger' href='resumes/".$name[$i].".txt' target='_blank'>Candidate : ".$i." - ".$count[$i]."</a></center>";
					echo "<br/>";
				}
			?>
			<br/>
		</div>


	</div>
	<?php include('sitelayout2.php'); include('footer.php'); ?>
</body>
</html>
