<?php //search.php ?>
<!DOCTYPE html>
<html>
<head>
	<title>DVD Search with PDO</title>

	<link rel="stylesheet" type="text/css" href="main.css">

</head>
<body>
<div id="main">

	<div id="title">DVD Search with PDO</div>

	<form id="search" method="get" action="results.php">
		<label for="dvd-title">DVD Title: </label>
		<input
			type="text"
			required
			placeholder="space"
			id="dvd-title"
			name="title"
			>
		<input
			type="submit"
			value="Search"
			>
	</form>

</div> <!--div#main-->
</body>
</html>