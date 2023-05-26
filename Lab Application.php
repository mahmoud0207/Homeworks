<?php
$db = new mysqli('hostname', 'username', 'password', 'database_name');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$full_name = $_POST["full_name"];
$email = $_POST["email"];
$gender = $_POST["gender"];
$errors = [];
if (empty($full_name)) {
    $errors[] = "Full name is required.";
}
if (empty($email)) {
    $errors[] = "Email is required.";
}
if (empty($gender)) {
    $errors[] = "Gender is required.";
}


if (empty($errors)) {
    $stmt = $db->prepare("INSERT INTO students (full_name, email, gender) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $full_name, $email, $gender);
    if ($stmt->execute()) {
        
        header("Location: index.php?success=1");
        exit;
    } else {
        
        die("Error: " . $stmt->error);
    }
} else {
    
    header("Location: index.php?errors=" . urlencode(implode("<br>", $errors)));
}
?>
