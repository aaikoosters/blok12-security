<?php
	include 'auth.php';
?>

<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>UCloud</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
    <style>
		body {
			background-color: linen;
			text-align: center;
			margin-top: 30px;
		}
		h1 {
			color: maroon;
		}
		div.gallery {
			margin: 5px;
			border: 1px solid #ccc;
			float: left;
		}
		div.gallery:hover {
			border: 1px solid #777;
		}
		div.gallery img {
			width: 300px;
			height: 200px;
		}
		div.desc {
			padding: 10px;
			text-align: center;
		}		
	</style>
</head>
<body>
    <h1>Welkom bij *UCloud*</h1>
    <img src="/Images/ucloud.png" alt="ucloud">
	<p class="form">
        <form action="/addImage.php" method="POST">
            Path to the image:<br>
            <input type="text" name="username" placeholder="Enter here the path to your image">
            <br><br>
            <input type="submit" value="Submit">
        </form> 
    </p>
<br/>


<?php
foreach(glob('./Gallery/*.*') as $name){
echo
'<div class="gallery">
	<img src='.$name.' alt=\'\'>
	<div class="desc">Here comes a button for deleting the image</div>
</div>';
}
?>

</body>