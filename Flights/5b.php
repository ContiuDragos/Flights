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
	$query = 'SELECT DISTINCT clienti.nume
			  FROM clienti JOIN bilete b1
			  ON clienti.id_client=b1.id_client AND b1.id_client IN (SELECT b2.id_client
			  FROM bilete b2 JOIN cupoane c 
			  ON b2.nr_bilet=c.nr_bilet AND c.nr_zbor LIKE \''.$nr_zbor.'\' AND c.plecare= \''.$plecare.'\')';
	$result = mysqli_query($dsn,$query);
	
	if (!$result)
	{
		die('Interogare gresita :'.mysqli_error($dsn));
	}
	
	///afisam tabelul
	echo ' <Table style = "width:60%">
	<tr>
		<th>Nume</th>
	</tr>'; 

	$randuri = mysqli_num_rows($result);
	
	for ($i=0; $i < $randuri; $i++)
	{
		echo '<tr>';
	    $row = mysqli_fetch_assoc($result);
		echo '<td align="center">'.htmlspecialchars(stripslashes($row['nume'])).'</td>';
	}
	///deconectarea de la baza de date
	mysqli_close($dsn);
?>
</body>
</html>