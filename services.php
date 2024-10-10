<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services - Online Booking Appointment System</title>
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
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2em;
        }
        .services-section {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 2em;
            margin-bottom: 2em;
        }
        .services-section h2 {
            margin-top: 0;
            color: #007BFF;
            text-align: center;
        }
        .service {
            margin-bottom: 1.5em;
        }
        .service h3 {
            color: #007BFF;
            margin: 0;
        }
        .service p {
            font-size: 1.1em;
            line-height: 1.6;
            color: #555;
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
    <div class="services-section">
        <h2>Appointment Booking</h2>
        <div class="service">
            <h3>Easy Scheduling</h3>
            <p>Our appointment booking system allows you to schedule appointments with ease. Choose your preferred date and time, and select the doctor you wish to see. Our system ensures that you get the slot that best fits your schedule.</p>
        </div>
        <div class="service">
            <h3>Automated Reminders</h3>
            <p>Never miss an appointment again with our automated reminders. You will receive notifications via email or SMS to remind you of upcoming appointments, ensuring you stay on top of your healthcare needs.</p>
        </div>
    </div>

    <div class="services-section">
        <h2>Doctor Information</h2>
        <div class="service">
            <h3>Find the Right Doctor</h3>
            <p>Our platform provides detailed profiles of doctors, including their specialties, contact information, and availability. This helps you make informed decisions and choose the right healthcare provider for your needs.</p>
        </div>
        <div class="service">
            <h3>Doctor Reviews</h3>
            <p>Read reviews and ratings from other patients to find the best doctor for your condition. Our review system helps you assess the quality of care provided by different doctors.</p>
        </div>
    </div>

    <div class="services-section">
        <h2>Patient Dashboard</h2>
        <div class="service">
            <h3>Manage Appointments</h3>
            <p>Access your personal dashboard to manage and track your appointments. You can view upcoming and past appointments, reschedule or cancel bookings, and update your personal details.</p>
        </div>
        <div class="service">
            <h3>Medical History</h3>
            <p>Keep track of your medical history and share it with your doctors as needed. Our system allows you to maintain a comprehensive record of your health information in one secure place.</p>
        </div>
    </div>
</div>

<footer>
    <p><i>&copy; HURSTVILLE CLINIC. All rights reserved.</i></p>
</footer>

</body>
</html>
