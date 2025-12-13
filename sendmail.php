<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $room = htmlspecialchars($_POST['room_type']);
    $checkin = htmlspecialchars($_POST['checkin']);
    $checkout = htmlspecialchars($_POST['checkout']);
    $message = htmlspecialchars($_POST['message']);

    $to = "info@saketplaza.com";  // Replace with your hotel’s email
    $subject = "New Booking Request from $name";
    $body = "
    Booking Details:
    -------------------------
    Name: $name
    Email: $email
    Phone: $phone
    Room Type: $room
    Check-in: $checkin
    Check-out: $checkout
    Message: $message
    ";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    if(mail($to, $subject, $body, $headers)) {
        // Send copy to guest
        $guest_subject = "Your Booking Request at Hotel Saket Plaza";
        $guest_message = "Dear $name,\n\nThank you for your booking request at Hotel Saket Plaza.\nWe will contact you shortly with confirmation.\n\nWarm regards,\nHotel Saket Plaza Team";
        mail($email, $guest_subject, $guest_message, "From: $to");
        
        header("Location: booking-confirmation.html");
        exit;
    } else {
        echo "Sorry, something went wrong. Please try again later.";
    }
}
?>
