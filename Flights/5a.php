<html>
<head>
</head>
<body style="background-image: linear-gradient( lightblue , aqua);">
<?php
	
	$clasa_efectiva=$_POST['clasa_efectiva'];
	$clasa_efectiva= trim($clasa_efectiva);
	
	if (!$clasa_efectiva)
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
	/*
	$query = 'SELECT nume
			  FROM clienti NATURAL JOIN Bilete
			  WHERE clasa=\'Business\' AND valoare<=ALL(SELECT valoare FROM bilete WHERE clasa=\'Business\')';
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
	*/
	$query = "call Procedure_5a('".$clasa_efectiva."')";
    $result = mysqli_query($dsn, $query);
    $row = mysqli_fetch_array($result);
   
    // verifică dacă rezultatul este în regulă
    if (!$result)
    { 
     	die('Interogare gresita :'.mysqli_error($dsn));
    }
    echo 
		'Numele clientului cu cel mai ieftin bilet este '.htmlspecialchars(stripslashes($row[0])); 
	
	
	///deconectarea de la baza de date
	mysqli_close($dsn);
?>
</body>
</html>