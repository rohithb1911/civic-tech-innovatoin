<?php
$conn = new mysqli("localhost","root","","complaints_db");

$id = $_POST['id'];
$status = $_POST['status'];

$completed_photo = "";
if(isset($_FILES['completed_photo']) && $_FILES['completed_photo']['name'] != ""){
    $completed_photo = "uploads/" . time() . "_" . basename($_FILES["completed_photo"]["name"]);
    move_uploaded_file($_FILES["completed_photo"]["tmp_name"], $completed_photo);
    $sql = "UPDATE complaints SET status='$status', completed_photo='$completed_photo' WHERE id=$id";
} else {
    $sql = "UPDATE complaints SET status='$status' WHERE id=$id";
}
$conn->query($sql);

echo "Complaint #$id updated successfully! <a href='admin_dashboard.php'>Back to Dashboard</a>";
?>
