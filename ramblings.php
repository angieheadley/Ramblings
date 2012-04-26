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
$db = $m->Ramblings;

// select a collection (analogous to a relational database's table)
$collection = $db->blog;

// put in link to post a rambling
echo "<a href='add.htm'>Add a Ramble</a>";
if (isset($_POST['rant'])) {
	$rant = $_POST['rant'];
    //echo "<p>".$_POST['slogan']."</p>";
	$commentator = $_POST['commentator'];
	$comment = $_POST['comments'];
    $obj = array( "rant" => $rant, "author" => $commentator, "comment" => $comment );
	$collection->insert($obj);

	
	}  
		if (isset($_POST['continue'])){
			$rant2=$_POST['continue'];
			$commentator2 = $_POST['commentator'];
			echo "<p>".$_POST['commentator']."</p>" ;
			$comment2 = $_POST['comments'];
			$obj2= array( "rant" => $rant2, "author" => $commentator2, "comment" => $comment2 );
			$collection->insert($obj2);
			}
// find everything in the collection
$cursor = $collection->find();


//$cursor searching threads
// iterate through the results
foreach ($cursor as $obj) {
    $title = $obj["rant"];
	echo "<h2 style=\"font-family: sans-serif\">".$obj["rant"] ."</h2>\n";
    $cursor2 = $collection->find(array("rant" => $title));
    foreach ($cursor2 as $obj2) {
    echo "<p>".$obj["comment"] ." -- <i>".$obj["author"]."</i></p>\n";
	echo "<a href='comment.htm'>Continue the Rant</a>";
}
}

?>



</div>
</body>
</html>