<?php



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;             
use PHPMailer\PHPMailer\Exception;

//require 'vendor/autoload.php';

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';


// FORM DATA
    $name  = $_POST["name"];
    $surname  = $_POST["surname"];
    $email = $_POST["email"];
    $msg   = $_POST["message"];

    $msgbody= "
    <!DOCTYPE html>
<html>
<body style='margin:0; padding:0; background-color:#f4f6f8; font-family: Arial, sans-serif;'>

<table width='100%' cellpadding='0' cellspacing='0'>
  <tr>
    <td align='center'>

      <table width='600' cellpadding='0' cellspacing='0' style='background:#ffffff; margin-top:40px; border-radius:8px; overflow:hidden;'>

        <!-- HEADER -->
        <tr>
          <td style='background:#0d6efd; color:#ffffff; padding:20px; text-align:center;'>
            <h2 style='margin:0;'>New Contact Message</h2>
          </td>
        </tr>

        <!-- BODY -->
        <tr>
          <td style='padding:30px;'>

            <p style='font-size:16px; color:#333;'>
              You have received a new message from your website contact form.
            </p>

            <table width='100%' cellpadding='10' cellspacing='0' style='border-collapse:collapse;'>

              <tr style='background:#f9f9f9;'>
                <td><strong>Name:</strong></td>
                <td>".$name."</td>
              </tr>

              <tr>
                <td><strong>Surname:</strong></td>
                <td>".$surname."</td>
              </tr>

              <tr style='background:#f9f9f9;'>
                <td><strong>Email:</strong></td>
                <td>".$email."</td>
              </tr>

              <tr>
                <td><strong>Message:</strong></td>
                <td>".$msg."</td>
              </tr>

            </table>

          </td>
        </tr>

        <!-- FOOTER -->
        <tr>
          <td style='background:#f1f1f1; padding:15px; text-align:center; font-size:13px; color:#777;'>
            © 2026 RI-TECH | All rights reserved
          </td>
        </tr>

      </table>

    </td>
  </tr>
</table>

</body>
</html>
    
    ";



$mail = new PHPMailer(true);

try {
    // SMTP SETTINGS
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'mcaphelimanan@gmail.com';
    $mail->Password   = 'tnkwotjujotxbpie'; // NOT your normal password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    

    // EMAIL CONTENT
    $mail->setFrom($email, $name);
    $mail->addAddress('mcaphelimanan@gmail.com');

    $mail->isHTML(true);
    $mail->Subject = 'Contact Form Message';
    $mail->Body    = $msgbody;

    $mail->send();
    //echo  "<script> alert('Successfully sent message!');
       // window.open('contact.php','_self');
       // </script>";
		//;

        echo "email sent";
        exit();

} catch (Exception $e) {
    echo "Error: {$mail->ErrorInfo}";
}

?>