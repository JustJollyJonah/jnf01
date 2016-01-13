<?php


?>

<!DOCTYPE HTML>
<head>
</head>
<body>
	<!-- Tabel voor de wijziging van gebruikers  -->
    	<h2>Medewerker wijzigen</h2>
    <!-- $_SERVER['PHP_SELF'] zorgt er voor dat als je ooit de naam veranderd van deze file hij alsnog werkt. -->
    	<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
		<table>
			<tr>
				<td>Voornaam:</td>
				<td><input type="text" value="" name="Naam" placeholder="Naam van medewerker" required /></td>
			</tr>
			<tr>
				<td>Achternaam:</td>
				<td><input type="text" placeholder="achternaam" name="Achternaam" required /></td>
			</tr>
			<tr>
				<td>Adres:</td>
				<td><input type="text" placeholder="adres" name="Adres"></td>
			</tr>
			<tr>
				<td>Woonplaats:</td>
				<td><input type="text" placeholder="woonplaats" name="Woonplaats"></td>
			</tr>
			<tr>
				<td>Postcode:</td>
				<td><input type="text" placeholder="postcode" name="Postcode"></td>
			</tr>
			<tr>
				<td>Locatienummer:</td>
				<td><input type="number" placeholder="locatienummer" name="Locatienummer" required></td>
			</tr>
			<tr>
				<td>Medewerkernummer:</td>
				<td><input type="text" placeholder="medewerkernummer"name="Medewerkernummer" required></td>
			</tr>
				<td>Functie: (type "Gebruiker" of "Administrator")</td>
				<td><input placeholder="functie" name="Functie"></td>
			</tr>
			<tr>
				<td>Actief:</td>
				<td><input type="radio" name="Actief" value="1"> Ja 
				<input type="radio" name="Actief" value="0"> Nee</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr>	
				<td>Gebruikersnaam:</td>
				<td><input type="text" name="Gebruikersnaam" required></td>
			</tr>
			<tr>
				<td>Wachtwoord:</td>
				<td><input type="password" name="Wachtwoord" required></td>
			</tr>		
			<td><input type="submit" name="MedewerkerSubmit" value="Verzend"></td>
			</tr>
		</table>
	</form>
</body>