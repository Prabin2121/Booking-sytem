<?php

session_name('patient_session');
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Dummy credentials for login
$valid_username = 'admin';
$valid_password = 'password';

// Database connection
include 'db_connect.php'; // Ensure this path is correct
$conn = getConnection();

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['patient_loggedin'] = true;
        $_SESSION['patient_id'] = 1; // Update as necessary
    } else {
        $error = 'Invalid username or password';
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    session_unset(); // Clear only the patient session
    session_destroy();
    header("Location: index.php");
    exit;
}

// Check if logged in and patient_id is set
if (!isset($_SESSION['patient_loggedin']) || !$_SESSION['patient_loggedin'] || !isset($_SESSION['patient_id'])) {
    // Display login form
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - Hurstville Clinic</title>
        <link rel="stylesheet" href="styles.css"> <!-- Use existing stylesheet -->
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
            .login-container {
                max-width: 400px;
                margin: 100px auto;
                padding: 2em;
                background: #fff;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                text-align: center;
            }
            .login-container input {
                width: 100%;
                padding: 1em;
                margin: 0.5em 0;
                border: 1px solid #ddd;
                border-radius: 5px;
            }
            .login-container button {
                background: #007BFF;
                color: #fff;
                padding: 1em;
                width: 100%;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }
            .login-container button:hover {
                background: #0056b3;
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
    <div class="login-container">
        <h2>Login</h2>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>

    <footer>
        <p><i>&copy; HURSTVILLE CLINIC. All rights reserved.</i></p>
    </footer>

    </body>
    </html>
    <?php
    exit;
}

// Fetch patient details
$patient_id = $_SESSION['patient_id'];
$patient_sql = "SELECT * FROM patients WHERE patient_id = ?";
$stmt = $conn->prepare($patient_sql);
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$patient_result = $stmt->get_result();

if ($patient_result->num_rows === 0) {
    echo "Patient not found.";
    exit;
}

$patient = $patient_result->fetch_assoc();

// Fetch patient appointments
$appointments_sql = "SELECT * FROM appointments WHERE patient_id = ?";
$stmt = $conn->prepare($appointments_sql);
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$appointments_result = $stmt->get_result();
$appointments = [];
if ($appointments_result->num_rows > 0) {
    while ($row = $appointments_result->fetch_assoc()) {
        $appointments[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard - Online Booking Appointment System</title>
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
        .logout {
            position: absolute;
            right: 20px;
            top: 20px;
            background: #d9534f;
            padding: 0.5em 1em;
            border-radius: 5px;
            color: white;
            text-decoration: none;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2em;
        }
        .profile-info, .appointments {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 2em;
            margin-bottom: 2em;
        }
        .profile-info h2, .appointments h2 {
            margin-top: 0;
            color: #007BFF;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 1em 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 0.75em;
            text-align: left;
        }
        th {
            background: #007BFF;
            color: #fff;
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
    <a class="logout" href="?logout=true">Logout</a>
    <nav>
        <a href="index.php">Home</a>
        <a href="about_us.php">About Us</a>
        <a href="doctors.php">Doctors</a>
        <a href="services.php">Services</a>
        <a href="patient_dashboard.php">Patient Dashboard</a>
	 <a href="doctor_dashboard.php">Doctor Dashboard</a>
        <a href="admin_dashboard.php">Admin Dashboard</a>
        <a href="contacts.php">Contact</a>
    </nav>
</header>

<div class="container">
    <!-- Profile Information -->
    <div class="profile-info">
        <h2>Profile Information</h2>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($patient['name'] ?? 'N/A'); ?></p>
        <p><strong>Contact Info:</strong> <?php echo htmlspecialchars($patient['contact_info'] ?? 'N/A'); ?></p>
        <p><strong>Medical History:</strong> <?php echo htmlspecialchars($patient['medical_history'] ?? 'N/A'); ?></p>
    </div>

    <!-- Appointments Section -->
    <div class="appointments">
        <h2>My Appointments</h2>
        <table>
            <thead>
                <tr>
                    <th>Appointment ID</th>
                    <th>Doctor ID</th>
                    <th>Date</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($appointments) === 0): ?>
                    <tr>
                        <td colspan="4">No appointments found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($appointments as $appointment): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($appointment['appointment_id']); ?></td>
                        <td><?php echo htmlspecialchars($appointment['doctor_id']); ?></td>
                        <td><?php echo htmlspecialchars($appointment['appointment_date']); ?></td>
                        <td><?php echo htmlspecialchars($appointment['appointment_time']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<footer>
    <p><i>&copy; HURSTVILLE CLINIC. All rights reserved.</i></p>
</footer>

</body>
</html>
