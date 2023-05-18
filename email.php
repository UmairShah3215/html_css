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
 
// Recipient 
// $to = 'send2aqeelahmed@gmail.com'; 
 
// // Sender 
// $from = 'send2aqeelahmed@gmail.com'; 
// $fromName = 'Aqeel Ahmed'; 
 
    $filenameee =  $_FILES['attachment']['name'];
    $fileName = $_FILES['attachment']['name']; 
    $file_tmp = $_FILES['attachment']['tmp_name'];
    $file_type = $_FILES['attachment']['type'];
    $file_size = $_FILES['attachment']['size'];
    $file_data = file_get_contents($fileName);
    
    // $name = '';
    // $email = '';
    // $usermessage = '';
    
    // $message ="Name = ". $name . "\r\n  Email = " . $email . "\r\n Message =" . $usermessage; 
    $message ="CV attached.";
    
    $subject ="CV";
    // $fromname ='';
    $fromemail = 'staff@amtstaffing.com';  //if u dont have an email create one on your cpanel

    // $mailto = 'fsiddiqui1230@gmail.com';  //the email which u want to recv this email

    $mailto = 'vsmida@amtstaffing.com';
    // $mailto = 'send2aqeelahmed@gmail.com, fsiddiqui1230@gmail.com, fsiddiqui@amtstaffing.com, recruiter@amtstaffing.com, vsmida@amtstaffing.com';

    $handle = fopen($file_tmp, "r"); // set the file handle only for reading the file
    $content = fread($handle, $file_size); // reading the file
    fclose($handle);                 // close upon completion
 
    // $encoded_content = chunk_split(base64_encode($content));
          
    // $content = file_get_contents($fileName);
    $content = chunk_split(base64_encode($content));
    
    // a random hash will be necessary to send mixed content
    $separator = md5(time());
    // carriage return type (RFC)
    $eol = "\r\n";
    // main header (multipart mandatory)
    $headers = "From: ".$fromname." <".$fromemail.">" . $eol;
    $headers .= "MIME-Version: 1.0" . $eol;
    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
    $headers .= "Content-Transfer-Encoding: 7bit" . $eol;
    $headers .= "This is a MIME encoded message." . $eol;

    // message
    $body = "--" . $separator . $eol;
    $body .= "Content-Type: text/plain; charset=\"iso-8859-1\"" . $eol;
    $body .= "Content-Transfer-Encoding: 8bit" . $eol;
    $body .= $message . $eol;
    
    // attachment
    $body .= "--" . $separator . $eol;
    $body .= "Content-Type: application/octet-stream; name=\"" . $filenameee . "\"" . $eol;
    $body .= "Content-Transfer-Encoding: base64" . $eol;
    // $body .= "Content-Disposition: attachment" . $eol;
    $body .= "Content-Disposition: attachment; name=\"".$filenameee."\"".$eol.$eol;
    $body .= $content . $eol;
    $body .= "--" . $separator . "--";
    
    // $message .= "Content-Disposition: attachment; filename=\"".$name."\"".$eol.$eol;
    
    //SEND Mail
    if (mail($mailto, $subject, $body, $headers)) {
        
        
  echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>";
  echo "<script>
          swal({
            icon: 'success',
            title: 'Form Submitted',
            text: 'Your form has been submitted successfully. Redirecting to Home page.',
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
