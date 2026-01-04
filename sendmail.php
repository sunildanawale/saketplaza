<?php
/**
 * Hotel Saket Plaza - sendmail.php
 * Unified script to handle Guest and Agent forms.
 */

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // --- CONFIGURATION ---
    $to_email = "info@saketplaza.com"; 
    $from_email = "no-reply@saketplaza.com"; // Set to an email on your domain (e.g. website@saketplaza.com)
    $success_page = "thank-you.html"; // Create this page for a better user experience

    // --- LOGIC TO DETECT FORM TYPE ---
    $isAgent = isset($_POST['Agency_Name']);

    if ($isAgent) {
        // Handle Agent Partnership Form
        $agency  = htmlspecialchars($_POST['Agency_Name'] ?? 'N/A');
        $name    = htmlspecialchars($_POST['Agent_Name'] ?? 'N/A');
        $city    = htmlspecialchars($_POST['City'] ?? 'N/A');
        $details = htmlspecialchars($_POST['Details'] ?? 'No details provided');

        $subject = "NEW AGENT: $agency ($city)";
        $body = "New Agent Partnership Application\n";
        $body .= "===============================\n\n";
        $body .= "Agency Name: $agency\n";
        $body .= "Contact Person: $name\n";
        $body .= "City: $city\n\n";
        $body .= "Details:\n$details\n";
    } else {
        // Handle Guest Inquiry Form
        $name    = htmlspecialchars($_POST['Guest_Name'] ?? 'N/A');
        $phone   = htmlspecialchars($_POST['Phone'] ?? 'N/A');
        $room    = htmlspecialchars($_POST['Room_Type'] ?? 'N/A');
        $message = htmlspecialchars($_POST['Message'] ?? 'No message provided');

        $subject = "GUEST INQUIRY: $name";
        $body = "New Guest Inquiry Received\n";
        $body .= "==========================\n\n";
        $body .= "Guest Name: $name\n";
        $body .= "Phone: $phone\n";
        $body .= "Preferred Room: $room\n\n";
        $body .= "Message:\n$message\n";
    }

    // --- HEADERS ---
    $headers = "From: Saket Website <$from_email>\r\n";
    $headers .= "Reply-To: $from_email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // --- SENDING ---
    if (mail($to_email, $subject, $body, $headers)) {
        // Success
        header("Location: $success_page");
        exit;
    } else {
        // Failure
        echo "<h1>Sorry!</h1><p>We could not send your request at this time. Please contact us via WhatsApp: +91 94209 72666</p>";
    }

} else {
    // Redirect if accessed directly
    header("Location: contact.html");
    exit;
}
?>
