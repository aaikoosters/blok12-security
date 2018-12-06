<html>
<head>

    <title>Upload Image</title>
	<link rel="stylesheet" type="text/css" media="screen" href="/stylesheet12.css" />
</head>
<body> 
	<img src="/Images/ucloud.png" alt="ucloud">
	<h1>Images</h1>
	
	<div class="row" style = "margin-top: 50px";>
	<?php
		//retrieve from DB
		$mysqli = mysqli_connect("localhost","root",
		"JkCzA1eXa4NBxFwRDnPLbGykHS2KzXSbD9JMZIrrVDlUhat058rHu6RVVLqpMDEWltKnnbdRK9QFf9JE7RvoJjDSDTD05i1U9oVMckW0cdz2vS9L8jbV6hRcKVHA4akSsCY8zYRy4iLsNGEYD9XD1NSdy0GBvuRCHv5TPbwE7uEvNyAOazMr0DaDhYduNnl8HkbTEhhm37mMeaWBvDNVtUdmNXOmJ8Ka9fILwUsiLaHdQiO3HHdyhz8Zf0388exo",
		"blok12db","3307");
        $sql = "SELECT * FROM images WHERE id = 20";
        $res = $mysqli->query($sql);
        $row=mysqli_fetch_assoc($res);
        $newciphertext = $row['Image'];

        //decrpyt and display
		$cipher = "aes-128-cbc";
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = openssl_random_pseudo_bytes($ivlen);
        $key = openssl_random_pseudo_bytes(128);
        $img = openssl_decrypt($newciphertext, $cipher, $key, $options=0, $iv);
        echo '<img src="data:image/jpeg;base64,'.base64_encode($img).'"/>';
		?>
	</div>
	
	<div class="row" style = "margin-top: 50px";>
		<h1> Upload Images</h1>
	</div>	

    <form enctype="multipart/form-data" action="uploadImages.php" method="post">
		<div class="row" style = "margin-top: 20px";>
        <input type="hidden" name="MAX_FILE_SIZE" value="600000" />
        <input type="file" name="users_image" id="users_image">		
        <input type="submit" value="Upload" name="submit">
		</div>
    </form>

<?php

    if($_SERVER['REQUEST_METHOD'] === 'POST')
   {
        //connect to database
        $mysqli = mysqli_connect("localhost","root",
		"JkCzA1eXa4NBxFwRDnPLbGykHS2KzXSbD9JMZIrrVDlUhat058rHu6RVVLqpMDEWltKnnbdRK9QFf9JE7RvoJjDSDTD05i1U9oVMckW0cdz2vS9L8jbV6hRcKVHA4akSsCY8zYRy4iLsNGEYD9XD1NSdy0GBvuRCHv5TPbwE7uEvNyAOazMr0DaDhYduNnl8HkbTEhhm37mMeaWBvDNVtUdmNXOmJ8Ka9fILwUsiLaHdQiO3HHdyhz8Zf0388exo",
		"ucloud","3307");		
       
		// Image properties
		$image = file_get_contents($_FILES['users_image']['tmp_name']);

        //encrypt
        $cipher = "aes-128-cbc";
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = openssl_random_pseudo_bytes($ivlen);
        $key = openssl_random_pseudo_bytes(128);
        $ciphertext = openssl_encrypt($image, $cipher, $key, $options=0, $iv);

        //add to DB
        $query = "INSERT INTO upload(ID,Image) VALUES (NULL,\"" . addslashes($ciphertext) ."\")";
        $mysqli->query($query);
        $id = mysqli_insert_id($mysqli);
    }
?>
</body>
</html>