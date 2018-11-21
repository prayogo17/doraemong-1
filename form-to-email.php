<?php
error_reporting(E_ALL);
require 'PHPMailer/src/PHPMailer.php' ;
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';
if(!isset($_POST['submit']))
{
	//This page should not be accessed directly. Need to submit the form.
	header("Location: /fiver");//redirect to form page
}

$Account_type		=	$_POST['account'];
$Job_no				=	$_POST['jobNo'];
$Company_name		=	$_POST['CompanyName'];
$Contact_name		=	$_POST['ContactName'];
$Printer_model		=	$_POST['printerModel'];
$Printer_serial		=	$_POST['printerSerial'];
$Page_count_mono	=	$_POST['PageCountMono'];
$Page_count_colour	=	$_POST['PageCountColour'];
$Service_note		= 	$_POST['serviceNotes'];
$Status 			=	$_POST['status'];
$Signature64 		=	$_POST['signature'];
$name 				=	$_POST['name'];
$phone				=	$_POST['phone'];
////////////////////////////////////////////////////////////////////////////////////////////////
$Account_type 		="<strong>Account Type : </strong>".$Account_type."<br/>";
$Job_no				="[AGM Job# ".$Job_no."0] Job Entry";
$Company_name		="<strong>Company Name : </strong>".$Company_name."<br/>";
$Contact_name		="<strong>Contact Name : </strong>".$Contact_name."<br/>";
$Printer_model		="<strong>Printer Model : </strong>".$Printer_model."<br/>";
$Printer_serial		="<strong>Printer Serial : </strong>".$Printer_serial."<br/>";
$Page_count_mono	="<strong>Page Count Mono : </strong>".$Page_count_mono."<br/>";
$Page_count_colour	="<strong>Page Count Colour : </strong>".$Page_count_colour."<br/>";
$Service_note		="<strong>Service Note : </strong>".$Service_note."<br/>";
$Status				="<strong>Status : </strong>".$Status."<br/>";


$encoded_image = explode(",", $Signature64)[1];
$output_file=md5(uniqid(rand(), true)).".png";
$ifp = fopen($output_file, 'wb' ); 
fwrite( $ifp, base64_decode( $encoded_image));
fclose( $ifp ); 


$message=$Account_type.$Company_name.$Contact_name.$Printer_model.$Printer_serial.$Page_count_mono.$Page_count_colour.$Service_note.$Status;

$mail =  new PHPMailer\PHPMailer\PHPMailer();
    $mail->IsSMTP(); 
    $mail->SMTPAuth 	= true; 
    $mail->Host 		= "nugrohoprayogo.id";
    $mail->Port 		= 465;
    $mail->IsHTML(true);
    $mail->SMTPSecure 	= 'ssl';
    $mail->Username 	= "cs@nugrohoprayogo.id"; //username SMTP
    $mail->Password 	= "password123";           //password SMTP
	$mail->From    		= 'cs@nugrohoprayogo.id'; //sender email
	$mail->FromName 	= 'Nugroho Prayogo';      //sender name
	$mail->AddEmbeddedImage($output_file, 'signature');
	$mail->AddAddress('nugrohoprayogo97@gmail.com', 'Nugroho Prayogo');//recipient: email and name
	$mail->Subject  	=  $Job_no;
	$mail->Body     	=  "

	You have received a new message from the user : Prayogo <br/>"."Here is the message:<br/><br/><br/>".$message."<hr> <br><br>
<table style=' font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;'>
  <tr>
    <th style='border: 1px solid black;
    text-align: center;
    padding: 8px;'>Name</th>
    <th style='border: 1px solid black;
    text-align: center;
    padding: 8px;'>Phone Number</th>
    <th style='border: 1px solid black;
    text-align: center;
    padding: 8px;'>Signature</th>
    <th style='border: 1px solid black;
    text-align: center;
    padding: 8px;'>Time</th>
  </tr>
  <tr>
    <td style='width:25%;height:200px; border: 1px solid black;
    text-align: center;
    padding: 8px;'>".$name."</td>
    <td style='width:25%;height:200px; border: 1px solid black;
    text-align: center;
    padding: 8px;'>".$phone."</td>
    <td style='width:25%;height:200px; border: 1px solid black;
    text-align: center;
    padding: 8px;'><img src='cid:signature' width='150' height='150'></td>
    <td style='width:25%;height:200px; border: 1px solid black;
    text-align: center;
    padding: 8px;'>".date("Y-m-d H:i:s")."</td>
  </tr>
</table>
	";
	if(isset($_FILES['fileImage1'])){
 		$mail->AddAttachment($_FILES['fileImage1']['tmp_name'],$_FILES['fileImage1']['name']);
	}
	if(isset($_FILES['fileImage2'])){
		$mail->AddAttachment($_FILES['fileImage2']['tmp_name'],$_FILES['fileImage3']['name']);
	}
	
    if(isset($_FILES['fileImage3'])){
		$mail->AddAttachment($_FILES['fileImage3']['tmp_name'],$_FILES['fileImage3']['name']);
	}
	// if(isset($_POST['signature'])){
 //       $mail->AddAttachment($output_file,'signature.png');
	   
	// }
	

if($mail->Send()){
     echo "Email sent successfully";
      unlink($output_file);
	}else{
	 echo "Email failed to send";
	  unlink($output_file);
	}


?> 