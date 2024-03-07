<?php
include_once("../connection.php");

if ($connection) {
    $userid = $_GET['userid'];

    // SQL query to delete data
    $sql = "DELETE FROM remoteuser WHERE user_id = '$userid'";

    // Execute the query
    if ($connection->query($sql) === TRUE) {
        header("Location: manageUser.php?delete=1");
    } else {
        echo "Error deleting record: " . $connection->error;
        header("Location: manageUser.php?delete=0");
    }

    $connection->close();
} else {
    echo "Connection failed.";
}
?>
