<?php
$errors = [];
$full_name = '';
$email = '';
$gender = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate form data
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];

    // Validate Full Name
    if (empty($full_name)) {
        $errors[] = "Full Name is required.";
    }

    // Validate Email Address
    if (empty($email)) {
        $errors[] = "Email Address is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid Email Address.";
    }

    // Connect to MySQL database
    $host = 'http://127.0.0.1/';
    $db = 'labibp';
    $user = '';
    $password = '';

    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

    try {
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    // Insert data into the database
    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO students (full_name, email, gender) VALUES (?, ?, ?)");

        try {
            $stmt->execute([$full_name, $email, $gender]);
            $success = true;
        } catch (PDOException $e) {
            $errors[] = "Error inserting data into the database.";
        }
    }

    // Close the database connection
    $pdo = null;
}
?>
