<?php
include 'db_connect.php'; // Ensure this path is correct

// Fetch doctor data from the database based on search query
$conn = getConnection();
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

if ($search) {
    $sql = "SELECT * FROM doctors WHERE name LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%" . $search . "%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql = "SELECT * FROM doctors";
    $result = $conn->query($sql);
}

$doctors = [];
$noResults = false; // Default value
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $doctors[] = $row;
    }
} else {
    $noResults = true; // Variable to track no results found
}

// Handle appointment booking
$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_appointment'])) {
    $doctor_id = $_POST['doctor_id'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $patient_name = $_POST['patient_name'];
    $patient_contact = $_POST['patient_contact'];

    if (!empty($patient_name) && !empty($patient_contact)) {
        $check_sql = "SELECT patient_id FROM patients WHERE name = ? AND contact_info = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param('ss', $patient_name, $patient_contact);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            $patient_row = $check_result->fetch_assoc();
            $patient_id = $patient_row['patient_id'];
        } else {
            $insert_patient_sql = "INSERT INTO patients (name, contact_info) VALUES (?, ?)";
            $insert_patient_stmt = $conn->prepare($insert_patient_sql);
            $insert_patient_stmt->bind_param('ss', $patient_name, $patient_contact);
            if ($insert_patient_stmt->execute()) {
                $patient_id = $conn->insert_id;
            } else {
                $error_message = "Error adding patient: " . $insert_patient_stmt->error;
            }
            $insert_patient_stmt->close();
        }

        if (isset($patient_id)) {
            $insert_sql = "INSERT INTO appointments (patient_id, doctor_id, appointment_date, appointment_time) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($insert_sql);
            if ($stmt) {
                $stmt->bind_param('iiss', $patient_id, $doctor_id, $appointment_date, $appointment_time);
                if ($stmt->execute()) {
                    $success_message = "Appointment booked successfully with Dr. " . htmlspecialchars($doctor_id) . "!";
                } else {
                    $error_message = "Error booking appointment: " . $stmt->error;
                }
                $stmt->close();
            } else {
                $error_message = "Error preparing statement: " . $conn->error;
            }
        }
    } else {
        $error_message = "Patient name and contact are required.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctors - Online Booking Appointment System</title>
    <link rel="stylesheet" href="styles.css"> <!-- External CSS for additional styling -->
    <style>
        /* Inline CSS for demonstration; consider moving this to an external stylesheet */
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
        .doctor-list {
            display: flex;
            flex-wrap: wrap;
            gap: 1em;
            justify-content: center;
        }
        .doctor-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 1.5em;
            width: 300px;
            margin: 1em;
            text-align: center;
            transition: box-shadow 0.3s ease;
        }
        .doctor-card:hover {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }
        .doctor-card h3 {
            margin-top: 0;
            font-size: 1.5em;
            color: #007BFF;
        }
        .doctor-card p {
            font-size: 1em;
            color: #555;
        }
        .doctor-card .specialty {
            font-style: italic;
            color: #007BFF;
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
        footer p {
            margin: 0;
        }
        .appointment-form {
            margin-top: 1em;
        }
        .appointment-form input, .appointment-form button {
            margin: 0.5em 0;
            padding: 0.5em;
            width: 90%;
        }
        /* Match header styles from index code */
        .container h2 {
            font-size: 2em;
            color: #007BFF;
            text-align: center;
            margin-top: 1em;
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
    <h2>Meet Our Experienced Doctors</h2>
    <form method="GET" action="doctors.php">
        <input type="text" name="search" placeholder="Search for a doctor by name" required>
        <button type="submit">Search</button>
    </form>
    <div class="doctor-list">
        <?php if ($noResults): ?>
            <p>No such doctor found.</p>
        <?php else: ?>
            <?php foreach ($doctors as $doctor): ?>
                <div class="doctor-card">
                    <h3><?php echo htmlspecialchars($doctor['name']); ?></h3>
                    <p class="specialty"><?php echo htmlspecialchars($doctor['specialty']); ?></p>
                    <p>Contact: <?php echo htmlspecialchars($doctor['contact_info']); ?></p>
                    
                    <form method="POST" class="appointment-form">
                        <input type="hidden" name="doctor_id" value="<?php echo htmlspecialchars($doctor['doctor_id']); ?>">
                        <input type="text" name="patient_name" placeholder="Your Name" required>
                        <input type="text" name="patient_contact" placeholder="Your Contact" required>
                        <input type="date" name="appointment_date" required>
                        <input type="time" name="appointment_time" required>
                        <button type="submit" name="book_appointment">Book Appointment</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <?php if (!empty($success_message)): ?>
        <p style="color: green;"><?php echo htmlspecialchars($success_message); ?></p>
    <?php endif; ?>
    <?php if (!empty($error_message)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error_message); ?></p>
    <?php endif; ?>
</div>

<footer>
    <p><i>&copy; HURSTVILLE CLINIC. All rights reserved.</i></p>
</footer>

</body>
</html>

