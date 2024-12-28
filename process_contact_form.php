<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = htmlspecialchars(strip_tags(trim($_POST['name'])));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(strip_tags(trim($_POST['message'])));

    // Validate inputs
    if (empty($name) || empty($email) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid input. Please ensure all fields are correctly filled.";
        exit;
    }

    // Email configuration
    $to = "todkar2711@gmail.com"; // Your email address
    $subject = "New Contact Form Submission";
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Email body
    $emailBody = "You have received a new message from the contact form:\n\n";
    $emailBody .= "Name: $name\n";
    $emailBody .= "Email: $email\n\n";
    $emailBody .= "Message:\n$message\n";

    // Send email
    if (mail($to, $subject, $emailBody, $headers)) {
        echo "Thank you! Your message has been sent.";
    } else {
        echo "Sorry, there was an issue sending your message. Please try again later.";
    }
}
?>
