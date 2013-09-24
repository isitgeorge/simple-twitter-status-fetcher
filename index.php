<!doctype html>
<html>
<head>
<title>My latest Tweet!</title>
</head>

<body>
<h1>My page!</h1>

<?php 
include 'fetch.php';

echo 'My lastest Tweet: ';
echo returnTweet('1'); // Display Tweet 1
?>

</body>
</html>

