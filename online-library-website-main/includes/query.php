<?php
	$query = "SELECT * FROM settings";
	$settings = mysqli_query($connection, $query);
	$setting = mysqli_fetch_assoc($settings);

	if ($setting["stats"]==1) {
		header('Location: under-construction.php');
	}
?>