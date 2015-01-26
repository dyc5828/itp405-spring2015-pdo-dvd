<?php //results.php

if(!isset($_GET['title'])) {
	header('Location: search.php');
}

$title = $_GET['title'];
// echo $title;

const HOST = 'itp460.usc.edu';
const DB = 'dvd';
const USER = 'student';
const PASSWORD = 'ttrojan';

$pdo = new PDO('mysql:host='.HOST.';dbname='.DB, USER, PASSWORD);

$sql = "
	SELECT title, genre_name, format_name, rating_name
	FROM dvds
	INNER JOIN genres
	ON dvds.genre_id = genres.id
	INNER JOIN formats
	ON dvds.format_id = formats.id
	INNER JOIN ratings
	ON dvds.rating_id = ratings.id
	WHERE title LIKE ?
";

$like = '%'.$title.'%';

$statement = $pdo->prepare($sql);

$statement->bindParam(1, $like);

$statement->execute();
$dvds = $statement->fetchAll(PDO::FETCH_OBJ);

$empty = empty($dvds);

$state = ['dark','light'];
$count = 1;
?>

<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="main.css">

</head>
</body>
<div id="main">

	<div id="title">DVD Search with PDO</div>

<?php  if($empty == 1): ?>

	<div id="search">
		Nothing found for "<?=$title?>"
		<br>
		<a href="search.php">Back to Search</a>
	</div>

<?php else: ?>

	<div id="search">
		You searched for "<?=$title?>"
		<br>
		<a href="search.php">Back to Search</a>
	</div>

	<div class="row dark head">
		<div class="dvd wide">
			Title
		</div>
		<div class="dvd">
			Genre
		</div>
		<div class="dvd">
			Format
		</div>
		<div class="dvd">
			Rating
		</div>
		<div class="clear"></div>
	</div> <!--div.row-->

<?php foreach($dvds as $dvd) : ?>
	<div class="row <?=$state[$count % 2] ?>">
		<div class="dvd wide">
			<?=$dvd->title?>
		</div>
		<div class="dvd">
			 <?=$dvd->genre_name?>
		</div>
		<div class="dvd">
			 <?=$dvd->format_name?>
		</div>
		<div class="dvd">
			 <?=$dvd->rating_name?>
		</div>
		<div class="clear"></div>
	</div> <!--div.row-->
<?php $count++; ?>
<?php endforeach; ?>
<?php endif ?>

</div> <!--div#main-->
</body>
</html>