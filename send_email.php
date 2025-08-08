<?php
// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
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
    
    // Your email address
    $to = "dgour@oswallumbers.com"; // <== REPLACE WITH YOUR EMAIL
    
    // Email subject
    $subject = "New Order from $fullName";
    
    // Email body
    $message = "You have received a new order:\n\n";
    $message .= "Full Name: $fullName\n";
    $message .= "Company: $company\n";
    $message .= "Email: $email\n";
    $message .= "Phone: $phone\n";
    $message .= "Product Type: $productType\n";
    $message .= "Product Variety: $productVariety\n";
    $message .= "Quantity: $quantity $unit\n";
    $message .= "Preferred Delivery Date: $deliveryDate\n";
    $message .= "Special Instructions: $specialInstructions\n";
    
    // Email headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    
    // Send email
    if (mail($to, $subject, $message, $headers)) {
        // Success message
        echo "<script>alert('Order submitted successfully! We will contact you soon.'); window.location.href='thank-you.html';</script>";
    } else {
        // Error message
        echo "<script>alert('Error: Unable to submit order. Please try again later.'); window.history.back();</script>";
    }
} else {
    // Not a POST request, redirect back to form
    header("Location: index.html");
    exit();
}
?>