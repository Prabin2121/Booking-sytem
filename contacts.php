<?php
include 'db_connect.php'; // Make sure this path is correct

// Fetch contact messages from the database (if needed)
$conn = getConnection();
$sql = "SELECT * FROM contacts ORDER BY created_at DESC";
$result = $conn->query($sql);

$messages = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Online Booking Appointment System</title>
    <link rel="stylesheet" href="styles.css"> <!-- External CSS for additional styling -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background: #f4f4f4;
            overflow-x: hidden;
        }
        header {
            background: #007BFF;
            color: #fff;
            padding: 1em 0;
            text-align: center;
        }
        header h1 {
            margin: 1em;
            font-size: 2em;
        }
        nav {
            margin: 1em 0;
            text-align: center;
        }
        nav a {
            color: #fff;
            text-decoration: none;
            padding: 0.5em 1em;
            background: #0056b3;
            border-radius: 5px;
            margin: 0 0.5em;
            transition: background 0.3s ease;
        }
        nav a:hover {
            background: #004494;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2em;
        }
        .contact-info, .contact-form {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 2em;
            margin-bottom: 2em;
        }
        .contact-info h2, .contact-form h2 {
            margin-top: 0;
            color: #007BFF;
        }
        .contact-info p {
            font-size: 1.1em;
            color: #555;
        }
        .contact-form input, .contact-form textarea {
            width: 100%;
            padding: 0.75em;
            margin: 0.5em 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .contact-form button {
            background: #28a745;
            color: #fff;
            border: none;
            padding: 0.75em 1.5em;
            border-radius: 5px;
            font-size: 1.1em;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .contact-form button:hover {
            background: #218838;
        }
        footer {
            background: #007BFF;
            color: #fff;
            text-align: center;
            padding: 1em 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

<header>
    <h1><b> HURSTVILLE CLINIC </b></h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="about_us.php">About Us</a>
	<a href="services.php">Services</a>
	<a href="doctors.php">Book Appointment</a>
        <a href="patient_dashboard.php">Patient Dashboard</a>
	<a href="doctor_dashboard.php">Doctor Dashboard</a>
        <a href="admin_dashboard.php">Admin Dashboard</a>
        <a href="contacts.php">Contact</a>
    </nav>
</header>

<div class="container">
    <!-- Contact Information -->
    <div class="contact-info">
        <h2>Get in Touch</h2>
        <p>If you have any questions or need assistance, please reach out to us using the contact form below or through the information provided.</p>
        <p><strong>Email:</strong> support@example.com</p>
        <p><strong>Phone:</strong> 555-1234</p>
        <p><strong>Address:</strong> 123 Main Street, Hurstville, Australia</p>
    </div>

    <!-- Contact Form -->
    <div class="contact-form">
        <h2>Send Us a Message</h2>
        <form action="submit_contact.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="5" required></textarea>
            
            <button type="submit">Send Message</button>
        </form>

        <!-- Area for error/success messages -->
        <div id="message-status" style="margin-top: 1em; color: green;"></div>
    </div>
</div>

<footer>
    <p><i>&copy; HURSTVILLE CLINIC. All rights reserved.</i></p>
</footer> 

</body>
</html>
