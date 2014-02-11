<?php
	session_start();
	function random_generate() 
	{
	   	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	   	$randomString = '';
	   	for ($i = 0; $i < 10; $i++) 
	   	{
	        $randomString .= $characters[rand(0, strlen($characters) - 1)];
	    }
	   	return $randomString;
	}
	//	echo 'Entered enterreq.php';
	$x=random_generate();
	$company=$_REQUEST['company'];
	$address=$_REQUEST['address'];
	$name=$_REQUEST['name'];
	$phone=$_REQUEST['phone'];
	$mailid=$_REQUEST['mailid'];
	$req=$_REQUEST['req'];
	
	$temp=fopen('tempfiles/temptoclassify.txt',"w+");
	fwrite($temp,$req);
	fclose($temp);

	//system("sudo alohomora | chmod 666 tempfiles/temptoclassify.txt");

	system("./classify < tempfiles/temptoclassify.txt > tempfiles/ansfile.txt");

	$ansfile=fopen("tempfiles/ansfile.txt","r");
	//system("sudo alohomora | chmod 666 tempfiles/ansfile.txt");
	$cat=fread($ansfile,filesize("tempfiles/ansfile.txt"));
	fclose($ansfile);



	include('connect.php');
	
	//Insert in database
	$query="INSERT INTO `resume`.`requirements`(`uid`,`company`,`address`,`name`,`phone`,`mailid`,`category`) values('$x','$company','$address','$name','$phone','$mailid','$cat');";
	$res=mysqli_query($dbc,$query);
	
	//File creation
	$file=fopen('requirements/'.$x.'.txt','w+');
	fwrite($file,"Company name : ".$company."\r\n");
	fwrite($file,"Address : ".$address."\r\n");
	fwrite($file,"Name : ".$name."\r\n");
	fwrite($file,"Phone : ".$phone."\r\n");
	fwrite($file,"Email id : ".$mailid."\r\n");
	fwrite($file,"Requirements : ".$req."\r\n");
	//fwrite($file,$req);

	system("echo alohomora | chmod 666 requirements/".$x.'.txt');
	fclose($file);
	
	//	echo 'success';

	$_SESSION['reqentry']=1;
	$_SESSION['uid']=$x;
	header('location:employer.php');

?>