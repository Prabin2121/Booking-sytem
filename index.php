<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Booking Appointment System</title>
    
    <link rel="stylesheet" href="styles.css"> <!-- External CSS for additional styling -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background: #f4f4f4;
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
        .hero {
            background: #fff; /* Changed to match doctor page style */
            color: #333; /* Changed text color for consistency */
            text-align: center;
            padding: 5em 0;
        }
        .hero h2 {
            font-size: 2.5em; /* Adjusted size to match header style */
            margin: 0;
            color: #007BFF; /* Updated to match color scheme */
        }
        .hero p {
            font-size: 1.5em;
            margin: 1em 0;
            color: #555; /* Adjusted color */
        }
        .button {
            display: inline-block;
            padding: 0.75em 1.5em;
            color: #fff;
            background: #28a745;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1.2em;
            transition: background 0.3s ease;
        }
        .button:hover {
            background: #218838;
        }
        .image-container {
            text-align: center;
            margin: 2em 0;
            padding: 0 1em;
        }
        .image-container img {
            max-width: 90%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .section {
            padding: 2em;
            text-align: center;
        }
        .section h3 {
            font-size: 2em;
            margin-bottom: 1em;
            color: #007BFF; /* Updated to match the header color */
        }
        .section p {
            font-size: 1.2em;
            margin-bottom: 1em;
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

<div class="image-container">
    <img src="images/logo.jpg" alt="Health Service Image">
</div>

<section class="hero">
    <h2>Welcome to Your Health Solution</h2>
    <p>Effortlessly book appointments with our easy-to-use system.</p>
    <a href="services.php" class="button">Explore Our Services</a>
</section>

<section class="section">
    <h3>Why Choose Us?</h3>
    <p>Our system simplifies the booking process, provides real-time availability, and offers a seamless experience.</p>
    <a href="about_us.php" class="button">Learn More About Us</a>
</section>

<footer>
    <p><i>&copy; HURSTVILLE CLINIC. All rights reserved.</i></p>
</footer>

</body>
</html>
