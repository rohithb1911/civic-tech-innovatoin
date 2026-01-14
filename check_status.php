<?php
$conn = new mysqli("localhost", "root", "", "complaints_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_POST['complaint_id']) || empty($_POST['complaint_id'])) {
    echo "Please enter a complaint number.";
    exit;
}

$id = intval($_POST['complaint_id']);

$sql = "SELECT * FROM complaints WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "No complaint found with this number.";
    exit;
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Complaint Status</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            width: 400px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        h2 {
            text-align: center;
        }
        img {
            width: 100%;
            margin-top: 10px;
            border-radius: 6px;
        }
        a {
            display: block;
            margin-top: 20px;
            text-align: center;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>Complaint Status</h2>

    <p><b>Complaint ID:</b> <?php echo $row['id']; ?></p>
    <p><b>Name:</b> <?php echo $row['name']; ?></p>
    <p><b>Department:</b> <?php echo $row['department']; ?></p>
    <p><b>Status:</b> <?php echo $row['status']; ?></p>

    <?php if (!empty($row['photo'])) { ?>
        <p><b>Uploaded Photo:</b></p>
        <img src="uploads/<?php echo $row['photo']; ?>">
    <?php } ?>

    <?php if (!empty($row['completed_photo'])) { ?>
        <p><b>Completed Photo:</b></p>
        <img src="uploads/<?php echo $row['completed_photo']; ?>">
    <?php } ?>

    <a href="status.html">← Check Another</a>
</div>

</body>
</html>
