<!DOCTYPE html>
<html>
	<head>
	<title>Kuntosalitreenit - Ohjelmat</title>
	</head>

	<body>
		<p>Etusivu</p>
		<p>Kuntosaliliikkeet</p>
		<p>Ohjelmat</p>
		<p>Tilastot/kehitys</p>
		<p>Asetukset</p>

		<h2>Liikkeen lisäys ohjelmaan:</h2>

		<form action="lisaaliike.php" method="post">
			<label>Liikkeen nimi: </label>
			<input type="text" name="nimi">

			<label>Painot: </label>
			<input type="text" name="nimi">

			<label>Toistot: </label>
			<input type="text" name="nimi">

			<label>Sarjat: </label>
			<input type="text" name="nimi">
			<br><br>

			<input type="submit" name="lisaa"
			value="Lisää">

			<input type="submit" name="peruuta"
			value="Peruuta">
		</form>

	</body>
</html>