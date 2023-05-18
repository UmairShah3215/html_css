<!DOCTYPE html>
<html>
<head>
    <title>Sweet Alert Example</title>
    <!-- Include Sweet Alert CSS and JavaScript files -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    
<?php 
 
// Recipient email address
$mailto =  'VSmida@amtstaffing.com';

// From
$fromemail = $_POST['inquiryEmail'];

// Email subject
$emailsubject = $_POST['subject'];

// Email body
$body = '<p><strong>Name:</strong> ' . htmlspecialchars($_POST['inquiryName']) . '</p>';
$body .= '<p><strong>Email:</strong> ' . htmlspecialchars($_POST['inquiryEmail']) . '</p>';
$body .= '<p><strong>Message:</strong></p><p>' . htmlspecialchars($_POST['message']) . '</p>';

// Email headers
$headers = 'From: ' . htmlspecialchars($_POST['inquiryEmail']) . "\r\n";
$headers .= 'Reply-To: ' . htmlspecialchars($_POST['inquiryEmail']) . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

// Send the email
// if (mail($mailto, $emailsubject, $body, $headers)) {
//   echo 'Email sent successfully.';
// } else {
//   echo 'An error occurred while sending the email.';
// }

    //SEND Mail
    if (mail($mailto, $emailsubject, $body, $headers)) {
        
        
  echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>";
  echo "<script>
          swal({
            icon: 'success',
            title: 'Form Submitted',
            text: 'Your request has been submitted successfully. Redirecting to Home page.',
          }).then(function() {
            window.location.href = 'https://www.amtstaffing.com';
          });
        </script>";

        // header("Location: index.html");
        // exit();
        

    } else {
        echo "mail send ... ERROR!";
        print_r( error_get_last() );
    }

        
?>

</body>
</html>
