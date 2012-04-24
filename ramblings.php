<!DOCTYPE html>
<html>
<head>
<title>Ramblings</title>
</head>
<body bgcolor="#faafbb">
<h1 style="text-align: center; font-family: sans-serif" >Ramblings: A Blog Site Where You Can Ramble</h1>
<div style="background-color: plum; text-align: left; margin: 20px; padding: 20px; font-family: sans-serif">
<?php

// connect
$m = new Mongo();

// select a database
$db = $m->ramblings;

// select a collection (analogous to a relational database's table)
$collection = $db->blog;


if (isset($_POST['slogan'])) {
	$slogan = $_POST['slogan'];
	$commentator = $_POST['commentator'];
	$comment = $_POST['comments'];
    //echo "<p>".$_POST['slogan']."</p>";
    $obj = array( "slogan" => $slogan, "author" => $commentator, "comment" => $comment );
	$collection->insert($obj);

    }

// find everything in the collection
$cursor = $collection->find();

// iterate through the results
foreach ($cursor as $obj) {
    echo "<h2 style=\"font-family: sans-serif\">".$obj["slogan"] ."</h2>\n";
    echo "<p>".$obj["comment"] ."</p>\n";
	echo "<p>"."-- <i>".$obj["author"]."</i></p>\n";
}

?>


<a href="add.htm">Add a Ramble</a>
</div>
</body>
</html>