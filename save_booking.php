<?php
header("Content-Type: application/json");
include 'db.php'; // Ensure this file connects to the DB

// Get the raw POST body
$data = json_decode(file_get_contents("php://input"), true);

// Check if all expected values exist
if (isset($data['name'], $data['email'], $data['destination'], $data['travel_date'], $data['tickets'])) {
    $name = $data['name'];
    $email = $data['email'];
    $destination = $data['destination'];
    $travel_date = $data['travel_date'];
    $tickets = (int)$data['tickets'];

    // You can create a table like ticket_bookings in the DB
    $stmt = $conn->prepare("INSERT INTO ticket_bookings (name, email, destination, travel_date, tickets) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $name, $email, $destination, $travel_date, $tickets);
    
    if ($stmt->execute()) {
        echo "Your booking was successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Missing or invalid data!";
}
?>