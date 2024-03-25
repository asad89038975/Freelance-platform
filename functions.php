<?php
	function open_job_in_category($user_designation, $connection){

	$user_skills = explode(',', $user_designation);
	$conditions = [];
	foreach ($user_skills as $skill) {
	    $conditions[] = "req_skill LIKE '%" . trim($skill) . "%'";
	}
	$condition_string = implode(' OR ', $conditions);

	// Count Query
	$count_sql = "SELECT COUNT(*) AS total_matched FROM freelance_job WHERE status = 1 AND ($condition_string)";
	$count_result = $connection->query($count_sql);
	$count_row = $count_result->fetch_assoc();
	$total_matched = $count_row['total_matched'];
	echo $total_matched;
	//return $total_matched;
}
		
?>