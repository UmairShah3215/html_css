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

require('fpdf/fpdf.php');

if(isset($_POST['submit'])) {
	$fullname = $_POST['fullname'];
	$email = $_POST['email'];
	$contact = $_POST['contact'];
	$address = $_POST['address'];
	$experience = $_POST['experience'];
	$education = $_POST['education'];
	$skills = $_POST['skills'];
	$goals = $_POST['goals'];
	$licence = $_POST['licence'];
	$references = $_POST['references'];

	// Create a new PDF instance
	$pdf = new FPDF();
	$pdf->AddPage();

	// Add header to the PDF
	$pdf->SetFont('Arial','B',20);
	// $pdf->Cell(0,10,'Employee CV',0,1,'C');
	$pdf->Cell(0,10,$fullname,0,1,'C');
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(0,10,$email.' | '.$contact,0,1,'C');
	$pdf->Ln(10);

	// Add subheading GOAL and line to the PDF
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(0,10,'Goals',0,1);
	$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // draw a line under the subheading
// 	$pdf->Ln(10);
	
	// Add content to the PDF
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell(0,10,$goals,0);
	$pdf->Ln(10);
	
	// Add subheading Work Experience and line to the PDF
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(0,10,'Work Experience',0,1);
	$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // draw a line under the subheading
// 	$pdf->Ln(10);

	// Add content to the PDF
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell(0,10,$experience,0);
	$pdf->Ln(10);

	// Add subheading and line to the PDF
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(0,10,'Education',0,1);
	$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // draw a line under the subheading
// 	$pdf->Ln(10);

	// Add content to the PDF
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell(0,10,$education,0);
	$pdf->Ln(10);

	// Add subheading and line to the PDF
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(0,10,'Skills',0,1);
	$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // draw a line under the subheading
// 	$pdf->Ln(10);

    // Add content to the PDF
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell(0,10,$skills,0);
	$pdf->Ln(10);
	
    // Add subheading Licence and line to the PDF
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(0,10,'Licence',0,1);
	$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // draw a line under the subheading
// 	$pdf->Ln(10);
	
	// Add content to the PDF
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell(0,10,$licence,0);
	$pdf->Ln(10);
	
    // Add subheading References and line to the PDF
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(0,10,'References',0,1);
	$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // draw a line under the subheading
// 	$pdf->Ln(10);
	
	// Add content to the PDF
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell(0,10,$references,0);

	// Output the PDF to the browser or save it to a file
	$pdf->Output('cv.pdf','F');

// Send the PDF document to the given email
// $email = 'send2aqeelahmed@gmail.com';
// $to = 'send2aqeelahmed@gmail.com';
$email = 'staff@amtstaffing.com';
$to = 'vsmida@amtstaffing.com';

$subject = 'CV';
$message = 'Please find attached the CV';
$headers = 'From: ' . $email;
$file = 'cv.pdf';
$content = file_get_contents($file);
$content = chunk_split(base64_encode($content));
$uid = md5(uniqid(time()));
$name = basename($file);
$header = "From: ".$email."\r\n";
$header .= "Reply-To: ".$email."\r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
$body = "--".$uid."\r\n";
$body .= "Content-Type: text/plain; charset=iso-8859-1\r\n";
$body .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
$body .= $message."\r\n\r\n";
$body .= "--".$uid."\r\n";
$body .= "Content-Type: application/octet-stream; name=\"".$file."\"\r\n";
$body .= "Content-Transfer-Encoding: base64\r\n";
$body .= "Content-Disposition: attachment; filename=\"".$file."\"\r\n\r\n";
$body .= $content."\r\n\r\n";
$body .= "--".$uid."--";

// mail($to, $subject, $body, $header);

 //SEND Mail
    if (mail($to, $subject, $body, $header)) {
        
        
  echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>";
  echo "<script>
          swal({
            icon: 'success',
            title: 'CV Uploaded',
            text: 'Your application has been submitted successfully. Redirecting to Home page.',
          }).then(function() {
            window.location.href = 'https://www.amtstaffing.com';
          });
        </script>";

        // Delete the PDF document from the server
        unlink('cv.pdf');
        

    } else {
        echo "mail send ... ERROR!";
        print_r( error_get_last() );
    }


}
?>

</body>
</html>


