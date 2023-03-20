<?php
session_start();
include("./connectdb.php");

// Retrieve form data
$announcement_title = $_POST['announcement_title'];
$announcement_text = $_POST['announcement_text'];
$announcement_date = $_POST['announcement_date'];
$user_id = $_SESSION['user_id'];

// Check if file was uploaded
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    // Set upload directory and file name
    $uploadDir = './uploads/';
    $fileName = $_FILES['image']['name'];
    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);

    // Check if the file extension is valid
    $allowedExts = array("jpg", "jpeg", "png", "gif");
    if (in_array($fileExt, $allowedExts)) {
        $uploadFile = $uploadDir . $fileName;

        // Move uploaded file to upload directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            $announcement_image = $uploadFile;
        } else {
            echo "Error uploading image. Please try again later.";
            exit;
        }
    } else {
        echo "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
        exit;
    }
} else {
    $announcement_image = null;
}

// Prepare and execute stored procedure
$stmt = $db->prepare("INSERT INTO announcements (announcement_title, announcement_text, announcement_date, image, user_id) VALUES (:announcement_title, :announcement_text, :announcement_date, :announcement_image, :user_id)");
$stmt->execute(array(
    ":announcement_title" => $announcement_title,
    ":announcement_text" => $announcement_text,
    ":announcement_date" => $announcement_date,
    ":image" => $announcement_image,
    ":user_id" => $user_id
));

// Check if the insertion was successful
if ($stmt->rowCount() > 0) {
    echo "Announcement submitted successfully!";
    
} else {
    echo "Error submitting announcement. Please try again later.";
}

?>
