<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailService
{

    function sendOrderNotificationWithPHPMailer($orderId, $userEmail)
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();  // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Set the SMTP server to send through (replace with actual SMTP server)
            $mail->SMTPAuth = true;  // Enable SMTP authentication
            $mail->Username = 'prince.sharma@innofied.com';  // SMTP username
            $mail->Password = 'sirz suer qton fjyq';    // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Enable TLS encryption
            $mail->Port = 587;  // TCP port to connect to (587 is commonly used for TLS)

            //Recipients
            $mail->setFrom(
                'prince.sharma@innofied.com',
                'no-reply@innofied.com'
            );
            $mail->addAddress($userEmail);  // Add recipient's email address

            // Content
            $mail->isHTML(true);  // Set email format to HTML
            $mail->Subject = "Order Confirmation - Order #$orderId";  // Email subject
            $mail->Body    = "<p>Dear Customer,</p>
                          <p>Thank you for your order. Your order ID is #$orderId.</p>
                          <p>We will notify you once your order is processed.</p>";

            // Send the email
            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
