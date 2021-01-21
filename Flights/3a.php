<html>
<head>
</head>
<body style="background-image: linear-gradient( lightblue , aqua);">
<?php
	
	$mai_mic=$_POST['mai_mic'];
	$mai_mic= trim($mai_mic);
	
	$mai_mare=$_POST['mai_mare'];
	$mai_mare= trim($mai_mare);
	
	if (!$mai_mare || !$mai_mic)
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
	$query = 'SELECT * FROM Bilete WHERE valoare>='.$mai_mic.' AND valoare<='.$mai_mare.' ORDER BY valoare DESC, sursa';
	$result = mysqli_query($dsn,$query);
	
	if (!$result)
	{
		die('Interogare gresita :'.mysqli_error($dsn));
	}
	
	///afisam tabelul
	echo ' <Table style = "width:60%">
	<tr>
		<th>Nr. Bilet</th>
		<th>Clasa</th>
		<th>Valoare</th>
		<th>Sursa</th>
		<th>Destinatia</th>
		<th>Id. Client</th>
	</tr>'; 

	$randuri = mysqli_num_rows($result);
	
	for ($i=0; $i < $randuri; $i++)
	{
		echo '<tr>';
	    $row = mysqli_fetch_assoc($result);
		echo '<td align="center">'.htmlspecialchars(stripslashes($row['nr_bilet'])).'</td>';
		echo '<td align="center">'.stripslashes($row['clasa']).'</td>';
		echo '<td align="center">'.stripslashes($row['valoare']).'</td>';
		echo '<td align="center">'.stripslashes($row['sursa']).'</td>';
		echo '<td align="center">'.stripslashes($row['destinatia']).'</td>';
		echo '<td align="center">'.stripslashes($row['id_client']).'</td>';
		echo '</tr>';
	}
	///deconectarea de la baza de date
	mysqli_close($dsn);
?>
</body>
</html>