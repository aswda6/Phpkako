<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  
  require 'PHPMailer/Exception.php';
  require 'PHPMailer/PHPMailer.php';
  require 'PHPMailer/SMTP.php';
  
  $mail = new PHPMailer(true);
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $email = $_POST['email'];
  
      try {
          // Server settings
          $mail->isSMTP();
          $mail->Host       = 'smtp.gmail.com';
          $mail->SMTPAuth   = true;
          $mail->Username   = 'wargame00101@gmail.com';
          $mail->Password   = 'brgslvpilwtkfbyv'; // Your App Password
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
          $mail->Port       = 587; // or 465 for SSL
  
          // Recipients
          $mail->setFrom('wargame00101@gmail.com', 'Your Name');
          $mail->addAddress($email); // Add the user's email
  
          // Content
          $mail->isHTML(true);
          $mail->Subject = 'Email Verification';
          $mail->Body    = 'Please verify your email by clicking this link: <a href="http://yourwebsite.com/verify.php?email=' . urlencode($email) . '">Verify Email</a>';
          $mail->AltBody = 'Please verify your email by copying this link: http://yourwebsite.com/verify.php?email=' . urlencode($email);
  
          $mail->send();
          echo 'Verification email has been sent to ' . htmlspecialchars($email);
      } catch (Exception $e) {
          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
  } else {
      echo 'Invalid request method.';
  }
  ?>
  