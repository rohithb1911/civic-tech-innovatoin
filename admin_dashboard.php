<?php
$conn = new mysqli("localhost", "root", "", "complaints_db");
if ($conn->connect_error) {
    die("Database connection failed");
}

$result = $conn->query("SELECT * FROM complaints ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
        }
        h2 {
            text-align: center;
        }
        .card {
            background: #fff;
            padding: 15px;
            margin: 20px auto;
            width: 80%;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }
        img {
            margin-top: 10px;
            border: 1px solid #ccc;
        }
        select, button {
            padding: 6px;
            margin-top: 8px;
        }
    </style>
</head>
<body>

<h2>Admin Dashboard</h2>

<?php while ($row = $result->fetch_assoc()) { ?>

<div class="card">

    <p>
        <strong>Complaint #<?php echo $row['id']; ?></strong><br>
        Name: <?php echo $row['name']; ?><br>
        Department: <?php echo $row['department']; ?><br>
        Status: <?php echo $row['status']; ?><br>
        Date: <?php echo $row['created_at']; ?>
    </p>

    <!-- Complaint Photo -->
    <strong>Complaint Photo:</strong><br>
    <?php
    if (!empty($row['photo']) && file_exists("uploads/" . $row['photo'])) {
        echo '<img src="uploads/' . $row['photo'] . '" width="150">';
    } else {
        echo '<p>No photo uploaded</p>';
    }
    ?>

    <br><br>

    <!-- Completed Photo -->
    <strong>Completed Photo:</strong><br>
    <?php
    if (!empty($row['completed_photo']) && file_exists("uploads/" . $row['completed_photo'])) {
        echo '<img src="uploads/' . $row['completed_photo'] . '" width="150">';
    } else {
        echo '<p>Not uploaded yet</p>';
    }
    ?>

    <form action="update_status.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        <label>Status:</label><br>
        <select name="status">
            <option value="Submitted" <?php if ($row['status']=="Submitted") echo "selected"; ?>>Submitted</option>
            <option value="Accepted" <?php if ($row['status']=="Accepted") echo "selected"; ?>>Accepted</option>
            <option value="In Progress" <?php if ($row['status']=="In Progress") echo "selected"; ?>>In Progress</option>
            <option value="Completed" <?php if ($row['status']=="Completed") echo "selected"; ?>>Completed</option>
        </select>

        <br><br>

        <label>Upload Completed Photo:</label><br>
        <input type="file" name="completed_photo">

        <br><br>

        <button type="submit">Update</button>
    </form>

</div>

<?php } ?>

</body>
</html>
