<?php
session_start();
include('smtp/PHPMailerAutoload.php');
$recv_email = $_GET['email'];
$user_type = $_GET['user_type'];

//5 digit OTP
$otp = rand(100000, 999999);
$receiverEmail = $recv_email ;   //"mdi52660@gmail.com";
$subject = "Email Verification";
$emailBody = "Your 6 Digit OTP Code: $otp";

if (smtp_mailer($receiverEmail, $subject, $emailBody)) {
    $_SESSION['otp'] = $otp; // Save OTP in session for verification
    $_SESSION['receiverEmail'] = $receiverEmail; // Save receiver email for verification
    header("Location:checkOTP.php?email=".$_GET['email']."&user_type=".$_GET['user_type']);
} else {
    echo "Failed to send OTP. Please try again later.";
}

function smtp_mailer($to, $subject, $msg)
{
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Username = "ismmayeen98@gmail.com"; //write sender email address
    $mail->Password = "jady sxyy azyb llfv"; //write app password of sender email
    $mail->SetFrom("ismmayeen98@gmail.com"); //write sender email address
    $mail->Subject = $subject;
    $mail->Body = $msg;
    $mail->AddAddress($to);
    $mail->SMTPOptions = array('ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => false
    ));
    return $mail->Send();
}
?>
