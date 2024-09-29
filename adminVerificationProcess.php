<?php

include "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST["e"])) {



    $email = $_POST["e"];

    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email`='" . $email . "'");
    $admin_num = $admin_rs->num_rows;
    if (empty($email)) {
        echo ("Please Enter the Email");
    } else {
        # code...


        if ($admin_num > 0) {

            $code = uniqid();

            Database::iud("UPDATE `admin` SET `vcode`='" . $code . "' WHERE `email`='" . $email . "'");

            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'himansunethsara18@gmail.com';
            $mail->Password = 'zxba bifp oqdd taal';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('himansunethsara18@gmail.com', 'Admin Verification');
            $mail->addReplyTo('himansunethsara18@gmail.com', 'Admin Verification');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Trendy Tech : Admin Login Verification Code';
            $bodyContent = '<p style="color:grey;">This message is from Trendy Tech in response to your request of AdminVerification </p>
                            <h2 style="color:#0F52BA;">Your verification code is '.$code.'</h2>';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo 'Verification code sending failed.';
            } else {
                echo 'Success';
            }
        } else {
            echo ("You are not a valid user.");
        }
    }
} else {
    echo ("Email field should not be empty.");
}
