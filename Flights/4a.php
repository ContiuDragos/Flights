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
	$query = 'SELECT bilete.nr_bilet, bilete.clasa, bilete.valoare, bilete.sursa, bilete.destinatia, zboruri.plecare, zboruri.la AS "ESCALA"
              FROM BILETE JOIN cupoane ON bilete.nr_bilet = cupoane.nr_bilet 
              JOIN zboruri ON cupoane.nr_zbor = zboruri.nr_zbor 
              WHERE bilete.id_client = ( SELECT id_client FROM Clienti WHERE nume LIKE \'Jean Radu\' ) and zboruri.la LIKE \'Munchen\'';
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
		<th>Plecare</th>
		<th>Escala</th>
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
		echo '<td align="center">'.stripslashes($row['plecare']).'</td>';
		echo '<td align="center">'.stripslashes($row['ESCALA']).'</td>';
	}
	///deconectarea de la baza de date
	mysqli_close($dsn);
?>
</body>
</html>