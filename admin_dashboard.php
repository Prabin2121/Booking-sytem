<?php

session_name('admin_session');
session_start();

// Dummy credentials (replace with your own authentication method)
$valid_username = 'admin';
$valid_password = 'password';

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['admin_loggedin'] = true;
        $_SESSION['username'] = $username; // Store username in session
    } else {
        $error = 'Invalid username or password';
    }
}

// Logout functionality
if (isset($_GET['logout'])) {
    session_unset(); // Clear only the admin session
    session_destroy();
    header("Location: index.php"); // Redirect to index page
    exit;
}

// Check if logged in
if (!isset($_SESSION['admin_loggedin']) || !$_SESSION['admin_loggedin']) {
    // If not logged in, show login form
    error_log("Admin Session: " . print_r($_SESSION, true));
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Login</title>
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
            header nav a {
                color: #fff;
                text-decoration: none;
                padding: 0.5em 1em;
                background: #0056b3;
                border-radius: 5px;
                margin: 0 0.5em;
                transition: background 0.3s ease;
            }
            header nav a:hover {
                background: #004494;
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
        </style>
    </head>
    <body>
        <header>
            <h1><b> HURSTVILLE CLINIC </b></h1>
            <nav>
                <a href="index.php">Home</a>
                <a href="about_us.php">About Us</a>
                <a href="doctors.php">Book Appointment</a>
                <a href="services.php">Services</a>
                <a href="patient_dashboard.php">Patient Dashboard</a>
		<a href="doctor_dashboard.php">Doctor Dashboard</a>
                <a href="admin_dashboard.php">Admin Dashboard</a>
                <a href="contacts.php">Contact</a>
            </nav>
        </header>
        <div class="login-container">
            <h2>Admin Login</h2>
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
            <p>&copy; 2024 Hurstville Clinic. All rights reserved.</p>
        </footer>
    </body>
    </html>
    <?php
    exit; // Stop further execution
}

// Include database connection
include 'db_connect.php'; // Ensure this path is correct

// Fetch data from the database
$conn = getConnection();

// Handle doctor addition
if (isset($_POST['add_doctor'])) {
    $name = $_POST['name'] ?? '';
    $specialty = $_POST['specialty'] ?? '';
    $contact_info = $_POST['contact_info'] ?? '';

    $insert_sql = "INSERT INTO doctors (name, specialty, contact_info) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insert_sql);
    $stmt->bind_param('sss', $name, $specialty, $contact_info);
    $stmt->execute();
    $stmt->close();
}

// Handle doctor deletion
if (isset($_POST['delete_doctor'])) {
    $doctor_id = $_POST['doctor_id'] ?? 0;
    $delete_sql = "DELETE FROM doctors WHERE doctor_id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param('i', $doctor_id);
    $stmt->execute();
    $stmt->close();
}

// Fetch doctors for display
$doctor_sql = "SELECT * FROM doctors";
$doctors_result = $conn->query($doctor_sql);
$doctors = [];
if ($doctors_result && $doctors_result->num_rows > 0) {
    while ($row = $doctors_result->fetch_assoc()) {
        $doctors[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Online Booking Appointment System</title>
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
	<a href="services.php">Services</a>
	<a href="doctors.php">Book Appointment</a>
        <a href="patient_dashboard.php">Patient Dashboard</a>
	<a href="doctor_dashboard.php">Doctor Dashboard</a>
        <a href="admin_dashboard.php">Admin Dashboard</a>
        <a href="contacts.php">Contact</a>
    
        <a class="logout" href="?logout">Logout</a>
</nav>    
</header>
    <div class="container">
        <div class="dashboard-section">
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
            <p>Manage the clinic's information below.</p>
        </div>
        
        <div class="profile-info">
            <h2>Doctors Information</h2>
            <table>
                <thead>
                    <tr>
                        <th>Doctor ID</th>
                        <th>Name</th>
                        <th>Specialty</th>
                        <th>Contact Info</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($doctors as $doctor): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($doctor['doctor_id']); ?></td>
                            <td><?php echo htmlspecialchars($doctor['name']); ?></td>
                            <td><?php echo htmlspecialchars($doctor['specialty']); ?></td>
                            <td><?php echo htmlspecialchars($doctor['contact_info']); ?></td>
                            <td>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="doctor_id" value="<?php echo htmlspecialchars($doctor['doctor_id']); ?>">
                                    <button type="submit" name="delete_doctor" style="background:none; color:#d9534f; border:none; cursor:pointer;">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <div class="appointments">
            <h2>Add New Doctor</h2>
            <form method="POST">
                <input type="text" name="name" placeholder="Doctor's Name" required>
                <input type="text" name="specialty" placeholder="Specialty" required>
                <input type="text" name="contact_info" placeholder="Contact Info" required>
                <button type="submit" name="add_doctor">Add Doctor</button>
            </form>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 Hurstville Clinic. All rights reserved.</p>
    </footer>
</body>
</html>
