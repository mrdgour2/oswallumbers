<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Include PHPMailer files
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    
    // Sanitize and collect form data
    $fullName = htmlspecialchars($_POST['fullName']);
    $company = htmlspecialchars($_POST['company']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $productType = htmlspecialchars($_POST['productType']);
    $productVariety = htmlspecialchars($_POST['productVariety']);
    $quantity = htmlspecialchars($_POST['quantity']);
    $unit = htmlspecialchars($_POST['unit']);
    $deliveryDate = htmlspecialchars($_POST['deliveryDate']);
    $specialInstructions = htmlspecialchars($_POST['specialInstructions']);
    
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);
    
    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';      // Your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'mrdgour2@gmail.com'; // Your SMTP username
        $mail->Password   = 'xqkk nzxn zypc bhqq';    // Your SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // SSL encryption
        $mail->Port       = 465;                      // SMTP port
        
        // Email settings
        $mail->setFrom('from@example.com', 'Your Website Name');
        $mail->addAddress('your-email@example.com', 'Your Name'); // Where to send emails
        $mail->addReplyTo($email, $fullName);
        
        // Email content
        $mail->isHTML(true);
        $mail->Subject = "New Order from $fullName";
        
        // Create HTML email body
        $mail->Body    = "<h2>New Order Received</h2>
                          <p><strong>Full Name:</strong> $fullName</p>
                          <p><strong>Company:</strong> $company</p>
                          <p><strong>Email:</strong> $email</p>
                          <p><strong>Phone:</strong> $phone</p>
                          <p><strong>Product Type:</strong> $productType</p>
                          <p><strong>Product Variety:</strong> $productVariety</p>
                          <p><strong>Quantity:</strong> $quantity $unit</p>
                          <p><strong>Preferred Delivery Date:</strong> $deliveryDate</p>
                          <p><strong>Special Instructions:</strong> $specialInstructions</p>";
        
        // Plain text version for non-HTML email clients
        $mail->AltBody = "New Order Received\n\n"
                        . "Full Name: $fullName\n"
                        . "Company: $company\n"
                        . "Email: $email\n"
                        . "Phone: $phone\n"
                        . "Product Type: $productType\n"
                        . "Product Variety: $productVariety\n"
                        . "Quantity: $quantity $unit\n"
                        . "Preferred Delivery Date: $deliveryDate\n"
                        . "Special Instructions: $specialInstructions\n";
        
        // Send email
        $mail->send();
        
        // Redirect to thank you page
        header("Location: thank-you.html");
        exit();
        
    } catch (Exception $e) {
        // Display error message (for debugging)
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        
        // In production, you might want to redirect to an error page instead
        // header("Location: error.html");
        // exit();
    }
} else {
    // Not a POST request, redirect back to form
    header("Location: index.html");
    exit();
}
?>
