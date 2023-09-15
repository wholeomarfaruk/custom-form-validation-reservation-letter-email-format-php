<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


//echo "<pre>";
//print_r($_POST);


$data= array();




if($_SERVER['REQUEST_METHOD']=['POST']){
    $email="";
    $fullName="";

    // $data= json_decode($_POST['data']);
    // echo "<pre>";
    // print_r($data);
    $requestdata= file_get_contents("php://input");
$obj= json_decode($requestdata, true);

    if(isset($obj['email']) && $obj['email'] !==""){
        $email= $obj['email'];
        if (isset($obj['fullName'])) {
            $fullName= $obj['fullName'];
            $phoneNumber= $obj['phoneNumber'];
            $date= $obj['date'];
            $starttime= $obj['starttime'];
            $endtime= $obj['endtime'];
            $numberOfPerson= $obj['numberOfPerson'];
            $incoming_address= $obj['incoming_address'];
            $msg= $obj['msg'];
            date_default_timezone_set("Asia/Dhaka");
            $mail_date= date("d-M-Y h:i:s A");
            $current_site= $_SERVER['SERVER_NAME'];

        }
       

        //Load Composer's autoloader
require '../lib/vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'wholeomarfaruk@gmail.com';                     //SMTP username
    $mail->Password   = 'nqrpyeuglvvkusmt';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom("$email", "$fullName");   
    $mail->addAddress("wholeomarfaruk@gmail.com", "Restaurant Table Reservetion Booking Letter");   //Add a recipient



    $html ='<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Restaurant Reservetion Booking Letter</title>
    </head>
    
    <body>
        <!-- mail content main frame  -->
        <div style="margin: 0; padding: 0; background-color: aliceblue; font-family: Arial, Helvetica, sans-serif; color: black;">
            <!-- Mail document header  -->
            <div style="width: 100%; display: inline-block; border-bottom: 2px solid #f58d17; text-align: center; ">
                <div style="    padding: 40px 20px 5px 20px;
                margin: 0 auto;
                width: 200px;
                text-align: center;"><img width="80%" src="cid:logo" alt=""></div>
                <h1 style="    text-transform: capitalize;
                margin: 0;
                padding: 0;
                color: tomato;">Restaurant Table Reservetion letter</h1>
                <p style="width: 80%; text-align: center; margin: 0 auto;
                padding: 0; font-size: 0.8em;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni facere labore itaque eius. At odit aspernatur laudantium voluptates harum non quam facilis ex ut blanditiis.</p>
            </div>
            <!-- inner content body  -->
            <div style="margin: 20px;">
                <form style="margin-right: 20%;">
                    <table style="border-left: 1px solid green ; border-collapse: collapse; letter-spacing: 2px; font-size: 0.8em; color: gray;">
                        <tbody style=" border-left: 1px solid green ; border-collapse: collapse;" >
                            <tr>
                                <td style="border-bottom: 1px solid green; border-collapse: collapse; width: 250px; padding: 10px 5px;">Full Name:</td>
                                <td style="border-bottom: 1px solid green; border-collapse: collapse; padding: 10px 5px;  font-style: italic;">'.$fullName.'</td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid green; border-collapse: collapse; width: 250px; padding: 10px 5px;">E-mail Address:</td>
                                <td style="border-bottom: 1px solid green; border-collapse: collapse; padding: 10px 5px; font-style: italic; text-decoration: none; color: initial; cursor: auto;"><a style="text-decoration: none; color: gray; cursor: auto;" href="#">'.$email.'</a></td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid green; border-collapse: collapse; width: 250px; padding: 10px 5px;">Phone Number:</td>
                                <td style="border-bottom: 1px solid green; border-collapse: collapse; padding: 10px 5px; font-style: italic;">'.$phoneNumber.'</td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid green; border-collapse: collapse; width: 250px; padding: 10px 5px;">Reservetion Date:</td>
                                <td style="border-bottom: 1px solid green; border-collapse: collapse; padding: 10px 5px; font-style: italic;">'.$mail_date.'</td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid green; border-collapse: collapse; width: 250px; padding: 10px 5px;">Event Date:</td>
                                <td style="border-bottom: 1px solid green; border-collapse: collapse; padding: 10px 5px; font-style: italic;">'.$date.'</td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid green; border-collapse: collapse; width: 250px; padding: 10px 5px;">Event Start Time:</td>
                                <td style="border-bottom: 1px solid green; border-collapse: collapse; padding: 10px 5px; font-style: italic;">'.$starttime.'</td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid green; border-collapse: collapse; width: 250px; padding: 10px 5px;">Event End Time:</td>
                                <td style="border-bottom: 1px solid green; border-collapse: collapse; padding: 10px 5px; font-style: italic;">'.$endtime.'</td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid green; border-collapse: collapse; width: 250px; padding: 10px 5px;">Number Of Guest:</td>
                                <td style="border-bottom: 1px solid green; border-collapse: collapse; padding: 10px 5px; font-style: italic;">'.$numberOfPerson.' Guest</td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid green; border-collapse: collapse; width: 250px; padding: 10px 5px;">They are From:</td>
                                <td style="border-bottom: 1px solid green; border-collapse: collapse; padding: 10px 5px; font-style: italic;">'.$incoming_address.'</td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid green; border-collapse: collapse; width: 250px; padding: 10px 5px;">Speccial Message:</td>
                                <td style="border-bottom: 1px solid green; border-collapse: collapse; padding: 10px 5px; font-style: italic;">'.$msg.'</td>
                            </tr>
                        </tbody>
                    </table>
                </form>
                <div style="margin-top: 20px;">
                    <h4 style="    text-transform: capitalize;
                    margin: 0;
                    padding: 0;">Cancellation Condition: </h4>
                    <div style="width: 100px; border-bottom: 2px solid #f58d17;"></div>
                    <p><span style="font-weight: 700;">Note:</span>  if you changed your mind then inform us before 48 hours. Otherwise reservation amount is not refundable.</p>
                </div>
    
            </div>
    
            <!-- Mail document Footer  -->
            <div style="margin-top: 50px; padding-bottom: 10px;">
                <!-- Reservation protocoll information -->
                <div  style="margin-top: 20px; text-align: center; width: 100%;">
                    <p style="font-style: italic; margin-bottom:0; font-size: 0.8em; color: rgb(61, 60, 60); display: flex; justify-content: space-between; text-align: center; padding: 2px 10px; align-items: center;"><span style="width: 33.33%;text-align: left;"><span style="font-weight: 700;">Letter Path: </span> '.$current_site.' </span><span style="width: 33.33%;text-align: center;"><span style="font-weight: 700;">Letter-Sent: </span> Contact form </span><span style="width: 33.33%;text-align: center;"><span style="font-weight: 700;">Mailing Date: </span> '.$mail_date.' (Asia/Dhaka)</span></p>
                </div>
                <div style="border-top: 5px solid #f58d17; text-align: center;">
                    <h4>For More info visit <a href="#" style="text-decoration: none; color: green; text-shadow:4px 5px 3px paleturquoise;" >www.Qrispy-Restaurant.com</a></h4>
                    <p><span style="font-weight: 700;">Hotline:</span> <a href="tel:+8801684285963" style="text-decoration: none; color: green; text-shadow:4px 5px 3px paleturquoise;">+88 01684-285963</a></p>
                </div>
            </div>
    
        </div>
        
    </body>
    </html>';

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Restaurant Table Reservetion Booking Letter';
    $mail->Body    = $html;
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->addEmbeddedImage(dirname(__FILE__).'\Qrispy_dark.png','logo');

   $mail->send();

    $data['status']='success';
    $data['result']= array(
        "fullName"=>$fullName,
        "email"=>$email,
        "phoneNumber"=>$phoneNumber,
        "date"=>$date,
        "starttime"=>$starttime,
        "endtime"=>$phoneNumber,
        "numberOfPerson"=>$numberOfPerson,
        "incoming_address"=>$incoming_address,
        "msg"=>$msg,
        "mail_date"=>$mail_date,
        "current_site"=>$current_site
    );
    
} catch (Exception $e) {
    $data['status']='error';
    $data['error']="Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

    }else{
        $data['status']='error';
        $data['error']='Email not found';
    }

}else{
    $data['status']='error';
    $data['error']='Your not allowed';

}

echo json_encode($data);
