<?php
	include_once "connection.php";

	if (isset($_POST["query"])) {
	 	$output = '';

$query = "SELECT * FROM skills WHERE skill_name LIKE ? ORDER BY skill_name";
$stmt = mysqli_prepare($connection, $query);
$search = $_POST["query"] . '%';
mysqli_stmt_bind_param($stmt, "s", $search);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $skill_id, $skill_name); // Binding result variables
$output .= '<ul class="list-unstyled">';
while (mysqli_stmt_fetch($stmt)) {
    $output .= '<li class="p-2">' . $skill_name . '</li>';
}
$output .= '</ul>';

if (mysqli_stmt_num_rows($stmt) == 0) {
    $output = '<ul class="list-unstyled"><li>No matching skills found</li></ul>';
}

echo $output;

	 }
?>
