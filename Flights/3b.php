<html>
<head>
</head>
<body style="background-image: linear-gradient( lightblue , aqua);">
<?php
	
	$numar=$_POST['numar'];
	$numar= trim($numar);
	
	if (!$numar)
	{
			echo 'Nu ati introdus criteriul de cautare. Va rog sa incercati din nou.';
			exit;
	}
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
	$query = 'SELECT DISTINCT aparat_zbor, nr_locuri FROM Zboruri WHERE nr_locuri>'.$numar.' ORDER BY nr_locuri';
	$result = mysqli_query($dsn,$query);
	
	if (!$result)
	{
		die('Interogare gresita :'.mysqli_error($dsn));
	}
	
	///afisam tabelul
	echo ' <Table style = "width:60%">
	<tr>
		<th>Aparat de zbor</th>
		<th>Nr. de locuri</th>
	</tr>'; 

	$randuri = mysqli_num_rows($result);
	
	for ($i=0; $i < $randuri; $i++)
	{
		echo '<tr>';
	    $row = mysqli_fetch_assoc($result);
		echo '<td align="center">'.htmlspecialchars(stripslashes($row['aparat_zbor'])).'</td>';
		echo '<td align="center">'.stripslashes($row['nr_locuri']).'</td>';
	}
	///deconectarea de la baza de date
	mysqli_close($dsn);
?>
</body>
</html>