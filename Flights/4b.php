<html>
<head>
</head>
<body style="background-image: linear-gradient( lightblue , aqua);">
<?php
	
	///incercam conexiunea la baza de date
	require_once('PEAR.php');
	$user = 'student';
	$pass = 'student123';
	$host = 'localhost';
	$db_name = 'colocviu_final';
	
	$dsn= new mysqli( $host, $user, $pass, $db_name);
	
	///verificam daca am reusit conexiunea la baza de date
	if ($dsn->connect_error)
	{
		die('Eroare la conectare:'. $dsn->connect_error);
	}
	
	///apelam interogarea
	$query = 'SELECT z1.nr_zbor, z1.de_la, z1.la, z2.nr_zbor,z2.de_la, z2.la 
              FROM zboruri z1 CROSS JOIN zboruri z2 
              WHERE z1.de_la = z2.la AND z1.la = z2.de_la';
	$result = mysqli_query($dsn,$query);
	
	if (!$result)
	{
		die('Interogare gresita :'.mysqli_error($dsn));
	}
	
	///afisam tabelul
	echo ' <Table style = "width:60%">
	<tr>
		<th>Nr. Zbor</th>
		<th>De la</th>
		<th>La</th>
		<th>Nr. Zbor</th>
		<th>De la</th>
		<th>La</th>
	</tr>'; 

	$randuri = mysqli_num_rows($result);
	
	for ($i=0; $i < $randuri; $i++)
	{
		echo '<tr>';
	    $row = mysqli_fetch_assoc($result);
		echo '<td align="center">'.htmlspecialchars(stripslashes($row['nr_zbor'])).'</td>';
		echo '<td align="center">'.stripslashes($row['de_la']).'</td>';
		echo '<td align="center">'.stripslashes($row['la']).'</td>';
		echo '<td align="center">'.stripslashes($row['nr_zbor']).'</td>';
		echo '<td align="center">'.stripslashes($row['de_la']).'</td>';
		echo '<td align="center">'.stripslashes($row['la']).'</td>';
	}
	///deconectarea de la baza de date
	mysqli_close($dsn);
?>
</body>
</html>