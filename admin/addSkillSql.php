<?php
// Include the connection file
include_once("../connection.php");


// Check if the connection is successful
if ($connection) {
    // Retrieve values from POST method
    $skill_name = $_POST['skill_name'];

    // SQL INSERT INTO statement
    $sql = "INSERT INTO skills (skill_name)
            VALUES 
            ('$skill_name')";

    // Execute the SQL statement
    if ($connection->query($sql) === TRUE) {
        header("Location: addSkill.php?skill=1");
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
         header("Location: addSkill.php?skill=0");
    }

    // Close the database connection
    $connection->close();
} else {
    echo "Connection failed.";
}
?>
