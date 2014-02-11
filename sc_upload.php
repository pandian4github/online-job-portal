<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
<script type="text/javascript" src="script/jquery-latest.js"></script>

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

require_once 'scribd.php';

//Connecting to Database//
//$db=mysqli_connect('localhost','root','','compiler') or die('Error in connecting');

//print_r($_FILES);
echo"<br>";

$fileName=$_FILES['doc']['name'];
$file_info=pathinfo($fileName);

$fileExt=$file_info['extension'];
$fileLoc=$_FILES['doc']['tmp_name'];
$fileSize=$_FILES['doc']['size'];

/*Upload it to the Scribd

What is needed ? 1) Scribd API KEy, Scribd Secret Key
				 2) Construct a Scribd Object with that (All the methods are given in "Scribd.php"
				 3) Use the scribd Object to call the upload Function
				 4) The function Will return "doc_id" and "access_key" for that doc
				 5) Then use "script" to display it
				 
*/

//Creating Scribd Object//

$api="7fs5j960mfy4seft72lbj";
$secret="7fs5j960mfy4seft72lbj";

$scribd=new Scribd($api,$secret);
//Object Created

//print_r($scribd);

$doc_type=$fileExt;
$access=null;
$rev_id=null;

$data=$scribd->upload($fileLoc,$doc_type,$access,$rev_id);

if($data)
{
//	echo "<center>File Uploaded Successfully</center>";
 // $result=$scribd->getDownloadUrl(133452555,$doc_type);
 // $result=file_get_contents($result['download_link']);
	$docid=$data['doc_id'];
	$akey=$data['access_key'];
	$type="txt";
	sleep(60);
	$content=$scribd->getDownloadUrl($docid,$type);
	$content=$content['download_link'];
	$content=file_get_contents($content);
//	echo $content;

	$x=random_generate();
	$cat='';

	$temp=fopen('tempfiles/temptoclassify.txt',"w+");
	fwrite($temp,$content);
	system("./classify < tempfiles/temptoclassify.txt > tempfiles/ansfile.txt");
	fclose($temp);

	system("sudo alohomora | chmod 777 tempfiles/temptoclassify.txt");	

	$ansfile=fopen("tempfiles/ansfile.txt","r");
	$cat=fread($ansfile,filesize("tempfiles/ansfile.txt"));
	system("sudo alohomora | chmod 777 tempfiles/ansfile.txt");
	fclose($ansfile);

	include('connect.php');
	
	$query="INSERT INTO `resume`.`resume`(`uid`,`category`) values('$x','$cat');";
	$res=mysqli_query($dbc,$query) or die("Error in query");

	$filename="resumes/".$x.".txt";

	system("chmod 777 ".$filename);

	$file=fopen($filename,"w+");
	fwrite($file,$content);

	fclose($file);
	
	system("echo alohomora | chmod 777 resumes/".$x.'.txt');

	$_SESSION['upload']=1;
	$_SESSION['uid']=$x;
	header('location:employee.php');
}


?>
