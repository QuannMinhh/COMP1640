<?php
include 'db.php';

if (isset($_GET['userid']) && !empty($_GET['userid'])) {
    $userid = $_GET['userid'];
    $query = $conn->prepare("DELETE FROM users WHERE UserID = :userid");
    $query->bindParam(':userid', $userid);
    $query->execute();
    header("Location: adminManage.php");
    exit();
} else {
    echo "User ID not provided.";
}
?>
