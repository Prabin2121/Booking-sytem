<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Online Booking Appointment System</title>
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
        .about-section {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 2em;
            margin-bottom: 2em;
        }
        .about-section h2 {
            margin-top: 0;
            color: #007BFF;
        }
        .about-section p {
            font-size: 1.1em;
            line-height: 1.6;
            color: #555;
        }
        .team-member {
            display: flex;
            align-items: center;
            margin-bottom: 1.5em;
        }
        .team-member img {
            border-radius: 50%;
            margin-right: 1em;
            width: 100px;
            height: 100px;
        }
        .team-member h3 {
            margin: 0;
            color: #007BFF;
        }
        .team-member p {
            margin: 0.5em 0;
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
    <div class="about-section">
        <h2>Our Mission</h2>
        <p>At Online Booking Appointment System, our mission is to simplify the process of scheduling and managing medical appointments. We strive to provide a seamless and user-friendly experience for both patients and healthcare providers, ensuring efficient and timely care.</p>
    </div>

    <div class="about-section">
        <h2>Our Values</h2>
        <p><strong>Integrity:</strong> We operate with honesty and transparency in all our interactions.</p>
        <p><strong>Innovation:</strong> We continuously seek new ways to enhance our services and technology.</p>
        <p><strong>Patient-Centric:</strong> We prioritize the needs and convenience of our patients.</p>
        <p><strong>Excellence:</strong> We are committed to delivering high-quality service and support.</p>
    </div>

    <div class="about-section">
        <h2>Meet Our Team</h2>
        <div class="team-member">
            
            <div>
                <h3>Dr. Alice Brown</h3>
                <p><strong>Position:</strong> Chief Medical Officer</p>
                <p>Dr. Alice Brown leads our medical team with a passion for pediatric care and a commitment to excellence.</p>
            </div>
        </div>
        <div class="team-member">
           
            <div>
                <h3>Dr. Bob Johnson</h3>
                <p><strong>Position:</strong> Senior Dermatologist</p>
                <p>Dr. Bob Johnson brings extensive experience in dermatology and a dedication to patient care.</p>
            </div>
        </div>
        <!-- Add more team members as needed -->
    </div>
</div>

<footer>
    <p><i>&copy; HURSTVILLE CLINIC. All rights reserved.</i></p>
</footer>

</body>
</html>
