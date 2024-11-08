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

    function sendOrderUpdateNotificationWithPHPMailer($orderId, $userEmail, $status)
    {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();  // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Set the SMTP server to send through
            $mail->SMTPAuth = true;  // Enable SMTP authentication
            $mail->Username = 'prince.sharma@innofied.com';  // SMTP username
            $mail->Password = 'sirz suer qton fjyq';    // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Enable TLS encryption
            $mail->Port = 587;  // TCP port to connect to (587 is commonly used for TLS)

            // Recipients
            $mail->setFrom(
                'prince.sharma@innofied.com',
                'no-reply@innofied.com'
            );
            $mail->addAddress($userEmail);  // Add recipient's email address

            // Content
            $mail->isHTML(true);  // Set email format to HTML

            // Set subject based on order status
            $mail->Subject = "Order Status Update - Order #$orderId";

            // Customize the body based on the status
            switch ($status) {
                case 'Placed':
                    $mail->Body = "<p>Dear Customer,</p>
                               <p>Your order ID #$orderId has been successfully placed.</p>
                               <p>We will notify you when your order is processed and dispatched.</p>";
                    break;
                case 'Dispatched':
                    $mail->Body = "<p>Dear Customer,</p>
                               <p>Your order ID #$orderId has been dispatched and is on its way to you.</p>
                               <p>We will keep you updated on further progress.</p>";
                    break;
                case 'Shipped':
                    $mail->Body = "<p>Dear Customer,</p>
                               <p>Your order ID #$orderId has been shipped and is on the way to the delivery location.</p>
                               <p>Thank you for your patience, and we will notify you once it's out for delivery.</p>";
                    break;
                case 'Out for delivery':
                    $mail->Body = "<p>Dear Customer,</p>
                               <p>Your order ID #$orderId is now out for delivery.</p>
                               <p>You should expect your order to arrive soon. Thank you for your patience.</p>";
                    break;
                case 'Delivered':
                    $mail->Body = "<p>Dear Customer,</p>
                               <p>Your order ID #$orderId has been successfully delivered.</p>
                               <p>Thank you for shopping with us!</p>";
                    break;
                case 'Cancelled':
                    $mail->Body = "<p>Dear Customer,</p>
                               <p>We regret to inform you that your order ID #$orderId has been cancelled.</p>
                               <p>If you have any questions, please contact us.</p>";
                    break;
                default:
                    $mail->Body = "<p>Dear Customer,</p>
                               <p>Your order ID #$orderId has been updated to status: $status.</p>
                               <p>We will keep you informed about the next steps.</p>";
                    break;
            }

            // Send the email
            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
