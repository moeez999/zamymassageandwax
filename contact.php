<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Check if form data is sent
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                            
        $mail->Host = 'localhost'; 
        $mail->SMTPAuth = false;                     
     
        $mail->SMTPSecure = 'none';                  
        $mail->Port = 25;                          

        // Recipients
        $mail->setFrom('zamy@zamymassageandwax.co.uk', 'Zamy Massage and Wax');
        $mail->addAddress('Zamaryr@hotmail.com'); 

        // Content
        $mail->isHTML(true);                       
        $mail->Subject = 'New Appointment Request';

        // Retrieve form data
        $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : 'N/A';
        $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : 'N/A';
        $date = isset($_POST['date']) ? htmlspecialchars($_POST['date']) : 'N/A';
        $time = isset($_POST['time']) ? htmlspecialchars($_POST['time']) : 'N/A';
        $service = isset($_POST['service']) ? htmlspecialchars($_POST['service']) : 'N/A';

        // Email body
        $mail->Body    = "
            <h2>New Appointment Request</h2>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Date:</strong> $date</p>
            <p><strong>Time:</strong> $time</p>
            <p><strong>Service:</strong> $service</p>
        ";
        $mail->AltBody = "
            New Appointment Request\n
            Name: $name\n
            Email: $email\n
            Date: $date\n
            Time: $time\n
            Service: $service
        ";

        $mail->send();
        echo 'Email sent successfully.';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo 'No form data received.';
}
?>