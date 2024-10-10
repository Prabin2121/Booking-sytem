<?php
session_name('doctor_session');
session_start();

// Enable error reporting for debugging (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Dummy credentials for login (replace with secure authentication in production)
$valid_username = 'doctor';
$valid_password = 'password';

// Include database connection
include 'db_connect.php'; // Ensure this path is correct
$conn = getConnection();

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Replace this with your actual authentication logic
    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['doctor_loggedin'] = true;
        $_SESSION['username'] = $username; // Store username in session
    } else {
        $error = 'Invalid username or password';
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    session_unset(); // Clear only the doctor session
    session_destroy();
    header("Location: doctor_dashboard.php"); // Redirect to login page
    exit;
}

// Check if logged in
if (!isset($_SESSION['doctor_loggedin']) || !$_SESSION['doctor_loggedin']) {
    // If not logged in, show login form
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Doctor Login - Hurstville Clinic</title>
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
                position: relative;
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
            <a href="doctors.php">Doctors</a>
            <a href="services.php">Services</a>
            <a href="patient_dashboard.php">Patient Dashboard</a>
            <a href="admin_dashboard.php">Admin Dashboard</a>
            <a href="doctor_dashboard.php">Doctor Dashboard</a>
            <a href="contacts.php">Contact</a>
        </nav>
        <!-- Logout button is not displayed on the login page -->
    </header>

    <div class="login-container">
        <h2>Doctor Login</h2>
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
        <p>&copy; 2024 Hurstville Clinic. All Rights Reserved.</p>
    </footer>

    </body>
    </html>
    <?php
    exit; // Stop further execution
}

// User is logged in, display the Doctor Dashboard

// Include any additional functionalities here (e.g., viewing appointments, managing schedule)

// For demonstration, we'll just display a welcome message

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard - Hurstville Clinic</title>
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
            position: relative;
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
        .dashboard-section {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 2em;
            margin-bottom: 2em;
        }
        .dashboard-section h2 {
            margin-top: 0;
            color: #007BFF;
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
    <nav>
        <a href="index.php">Home</a>
        <a href="about_us.php">About Us</a>
        <a href="doctors.php">Doctors</a>
        <a href="services.php">Services</a>
        <a href="patient_dashboard.php">Patient Dashboard</a>
        <a href="admin_dashboard.php">Admin Dashboard</a>
        <a href="doctor_dashboard.php">Doctor Dashboard</a>
        <a href="contacts.php">Contact</a>
    </nav>
    <a class="logout" href="doctor_dashboard.php?logout=true">Logout</a>
</header>
<div class="container">
    <div class="dashboard-section">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
        <p>Manage your schedule and patient information below.</p>
    </div>
    
    <div class="profile-info">
        <h2>Your Profile</h2>
        <p><strong>Username:</strong> <?php echo htmlspecialchars($_SESSION['username']); ?></p>
        <!-- Add more profile details as needed -->
    </div>
    
    <!-- Placeholder for additional sections like Appointments, Prescriptions, etc. -->
    <div class="appointments">
        <h2>Your Appointments</h2>
        <p>Here you can view and manage your appointments.</p>
        <!-- Implement appointment management functionalities here -->
    </div>
</div>
<footer>
    <p>&copy; 2024 Hurstville Clinic. All Rights Reserved.</p>
</footer>
</body>
</html>
