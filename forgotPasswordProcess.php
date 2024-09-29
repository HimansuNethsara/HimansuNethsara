<?php

require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_GET["e"])){

    $email = $_GET["e"];

    $rs = Database::search("SELECT* FROM `users` WHERE `email`='".$email."'");
    $n = $rs->num_rows;

    if($n == 1){

        $code = uniqid();

        Database::iud("UPDATE `users` SET `verification_code`='".$code."' WHERE `email`='".$email."'");

        $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'himansunethsara18@gmail.com';
            $mail->Password = 'zxba bifp oqdd taal';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('himansunethsara18@gmail.com', 'Reset Password');
            $mail->addReplyTo('himansunethsara18@gmail.com', 'Reset Password');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Trendy Tech : Forgot Password Verification Code';
            $bodyContent = '<p style="color:grey;">This message is from Trendy Tech in response to your request of forgot password </p>
                            <h2 style="color:#0F52BA;">Your verification code is '.$code.'</h2>';
            $mail->Body    = $bodyContent;

            if(!$mail->send()){
                echo ("Verification Code Sending Failed.");
            }else{
                echo ("success");
            }

    }else{
        echo ("Invalid Email Address.");
    }

}else{
    echo ("Please enter your Email Address First.");
}

?>