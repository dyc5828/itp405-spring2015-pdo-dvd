<?php //ratings.php

if(!isset($_GET['rating'])) {
	header('Location: search.php');
}

$rating = $_GET['rating'];

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
	WHERE rating_name = ?
";

$statement = $pdo->prepare($sql);

$statement->bindParam(1, $rating);

$statement->execute();
$dvds = $statement->fetchAll(PDO::FETCH_OBJ);

$empty = empty($dvds);

$state = ['dark','light'];
$count = 1;
?>

<html>
<head>
	<title>Rating: <?=$rating?></title>
	<link rel="stylesheet" type="text/css" href="main.css">

</head>
</body>
<div id="main">

	<div id="title">DVD Search with PDO</div>

	<div id="search">
		All dvds with rating: "<?=$rating?>"
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
	<div class="row <?=$state[$count % 2]?>">
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
			 <a href="ratings.php?rating=<?=$dvd->rating_name?>"><?=$dvd->rating_name?></a>
		</div>
		<div class="clear"></div>
	</div> <!--div.row-->
<?php $count++; ?>
<?php endforeach; ?>

</div> <!--div#main-->
</body>
</html>