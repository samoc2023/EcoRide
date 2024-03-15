<?php
// Include your database connection file
require "../src/DBconnect.php"; // Database connection

// Receive form data
$customerID = $_POST['customerID'];
$carID = $_POST['carID'];
$pickupDate = $_POST['pickupDate'];
$dropoffDate = $_POST['dropoffDate'];
$paymentStatus = 'Pending'; // Assuming initial status is pending

// Validate input (you should perform more thorough validation)
if (empty($customerID) || empty($carID) || empty($pickupDate) || empty($dropoffDate)) {
    die("Error: All fields are required.");
}

// Insert reservation data into the database
$sql = "INSERT INTO Reservation (CustomerID, CarID, PickupDate, DropoffDate, PaymentStatus)
        VALUES ('$customerID', '$carID', '$pickupDate', '$dropoffDate', '$paymentStatus')";

if (mysqli_query($conn, $sql)) {
    echo "Reservation added successfully!";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);
?>