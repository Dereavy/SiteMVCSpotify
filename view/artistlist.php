<html>
<head></head>

<body>

<table>
	<tr><td>Artist</td><td>Author</td><td>Description</td></tr>
	<?php 

		foreach ($artists as $name => $artist)
		{
			echo '<tr><td><a href="index.php?artist='.$artist->name.'">'.$artist->name.'</a></td><img src="'.$artist->imgURL.'"/></tr>';
		}

	?>
</table>

</body>
</html>