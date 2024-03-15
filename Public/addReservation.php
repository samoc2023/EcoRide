<?php
require "header.php"; // Include header file
require "../src/DBconnect.php"; // Include database connection file

// Check if the form is submitted
if (isset($_POST['submit'])) {
    try {
        // Retrieve form data and sanitize
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone']);
        $date = htmlspecialchars($_POST['date']);
        $time = htmlspecialchars($_POST['time']);
        $message = htmlspecialchars($_POST['message']);

        // SQL query to insert reservation into database
        $sql = "INSERT INTO reservations (name, email, phone, reservation_date, reservation_time, message) VALUES (?, ?, ?, ?, ?, ?)";

        // Prepare and execute the query
        $stmt = $connection->prepare($sql);
        $stmt->execute([$name, $email, $phone, $date, $time, $message]);

        // Display success message
        echo "<p>Reservation successfully added.</p>";
    } catch(PDOException $error) {
        // Display error message if query fails
        echo "Error: " . $error->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Reservation</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #E6EDEA;
            margin: 0;
            padding: 0;
        }

        form {
            background-color: #C5E4CB;
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
        }

        label {
            display: block;
            margin: 15px 0 5px;
        }

        input[type=text],
        input[type=email],
        input[type=tel],
        input[type=date],
        textarea,
        input[type=submit] {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #a9c9a4;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
        }

        input[type=submit] {
            background-color: #A9C9A4;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #97b498;
        }
    </style>
</head>
<body>

<h2>Add Reservation</h2>
<form method="post">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" required>

    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>

    <label for="phone">Phone</label>
    <input type="tel" name="phone" id="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="Format: 123-456-7890" required>

    <label for="date">Date</label>
    <input type="date" name="date" id="date" required>

    <label for="time">Time</label>
    <input type="time" name="time" id="time" required>

    <label for="message">Message</label>
    <textarea name="message" id="message" rows="4" required></textarea>

    <input type="submit" name="submit" value="Submit">
</form>

<?php include "footer.php"; ?>

</body>
</html>
