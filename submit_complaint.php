<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "complaints_db");

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$area = $_POST['area'];
$ward = $_POST['ward_number'];
$department = $_POST['department'];
$description = $_POST['description'];

// Photo upload
$photo = "";
if (!empty($_FILES['photo']['name'])) {
    $photo = time() . "_" . basename($_FILES['photo']['name']);
    move_uploaded_file($_FILES['photo']['tmp_name'], "uploads/" . $photo);
}

// Insert into database
$sql = "INSERT INTO complaints (name, area, ward_number, department, description, photo)
        VALUES ('$name', '$area', '$ward', '$department', '$description', '$photo')";

if ($conn->query($sql) === TRUE) {
    $complaint_id = $conn->insert_id;
    echo "<h2>Complaint Submitted Successfully!</h2>";
    echo "<p>Your Complaint Number is: <b>$complaint_id</b></p>";
    echo "<a href='index.html'>Go to Home</a>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
