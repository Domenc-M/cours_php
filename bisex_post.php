<?php
$start_year = $_POST['start_year'] < $_POST['end_year'] ? intval($_POST['start_year']) : intval($_POST['end_year']);
$end_year = $_POST['start_year'] < $_POST['end_year'] ? intval($_POST['end_year']) : intval($_POST['start_year']); 


for($i = $start_year; $i <= $end_year; $i++) {
	$day = new DateTime($i . "-01-31");
	if($day->format("L")) {
		echo "<div>{$i}</div>";
	}
}