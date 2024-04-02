<?php
// Check if user_id and ban are set in the URL
if (isset($_GET['user_id']) && isset($_GET['ban'])) {
    // Get user_id and ban from the URL
    $user_id = $_GET['user_id'];
    $ban = $_GET['ban'];

    // Include the database connection file
    include_once("../connection.php");

    // Prepare SQL statement to get the current ban
    $sql_get_status = "SELECT ban FROM remoteuser WHERE user_id = ?";
    $stmt_get_status = $connection->prepare($sql_get_status);
    $stmt_get_status->bind_param("i", $user_id);
    $stmt_get_status->execute();
    $stmt_get_status->store_result();

    // Check if any rows are returned
    if ($stmt_get_status->num_rows > 0) {
        // Fetch the result
        $stmt_get_status->bind_result($current_status);
        $stmt_get_status->fetch();
        
        // Calculate the new ban
        $new_status = ($current_status == 1) ? 0 : 1;

        // Prepare SQL statement to update the ban
        $sql_update_status = "UPDATE remoteuser SET ban = ? WHERE user_id = ?";
        $stmt_update_status = $connection->prepare($sql_update_status);
        $stmt_update_status->bind_param("ii", $new_status, $user_id);
        $stmt_update_status->execute();

        // Close statements
        $stmt_get_status->close();
        $stmt_update_status->close();

        // Redirect back to the page after updating the database
        header("Location: manageUser.php?ban=1");
        exit();
    } else {
        // If no rows are returned, redirect to an error page
        header("Location: manageUser.php?ban=0");
        exit();
    }
} else {
    // Redirect to an error page if user_id and ban are not set in the URL
    header("Location: manageUser.php?ban=0");
    exit();
}
?>
