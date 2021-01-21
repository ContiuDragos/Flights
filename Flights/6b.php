<html>
<head>
</head>
<body style="background-image: linear-gradient( lightblue , aqua);">
<?php
	$nr_zbor=$_POST['nr_zbor'];
	$nr_zbor= trim($nr_zbor);
	
	$plecare=$_POST['plecare'];
	$plecare= trim($plecare);
	
	if (!$nr_zbor || !$plecare)
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
	$query = 'SELECT clasa_efectiva,COUNT(*) AS "Numar_de_bilete"
			  FROM Bilete NATURAL JOIN Cupoane
			  WHERE nr_zbor LIKE \''.$nr_zbor.'\' AND plecare = \''.$plecare.'\'
			  GROUP BY clasa_efectiva' ;
	$result = mysqli_query($dsn,$query);
	
	if (!$result)
	{
		die('Interogare gresita :'.mysqli_error($dsn));
	}
	
	///afisam tabelul
	echo ' <Table style = "width:60%">
	<tr>
		<th>Clasa efectiva</th>
		<th>Numar de bilete</th>
	</tr>'; 

	$randuri = mysqli_num_rows($result);
	
	for ($i=0; $i < $randuri; $i++)
	{
		echo '<tr>';
	    $row = mysqli_fetch_assoc($result);
		echo '<td align="center">'.htmlspecialchars(stripslashes($row['clasa_efectiva'])).'</td>';
		echo '<td align="center">'.stripslashes($row['Numar_de_bilete']).'</td>';
	}
	///deconectarea de la baza de date
	mysqli_close($dsn);
?>
</body>
</html>