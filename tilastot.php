<!DOCTYPE html>

<?php 
if (isset($_POST["poista"])) { //kun painetaan poista-nappia
	$id = $_POST["id"]; //id tulee formilta (name = "id")
	try {
		require_once "suoritusPDO.php";
		$kantakasittely = new suoritusPDO();
		$id = $kantakasittely->poistaSuoritus($id); //annetaan poistaSuoritus():lle parametrina poistettava id 
		
	} catch (Exception $error) {
		print($error->getMessage());
	}
}

if (isset($_POST["nayta"])) {
	$id = $_POST["id"]; //id tulee formilta (name = "id")
	
	header("location: suorituksenTiedot.php?id=" . $id);
	exit;
}
?>

<html lang="fi">
	<head>
		<meta charset="utf-8"> 

		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

		<link rel="stylesheet" type="text/css" href="style.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<!-- Popper JS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

		<title>Kuntosalitreenit - Tilastot</title>
	</head>

	<body>
		<div class="container">
			<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
      		<a class="navbar-brand" href="http://localhost/projekti/index.php">Kuntosaliträkkäys</a>
      		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        		<span class="navbar-toggler-icon"></span>
      		</button>
	      	<div class="collapse navbar-collapse" id="navbarCollapse">
	        	<ul class="navbar-nav mr-auto">
	          		<li class="nav-item active">
	            		<a class="nav-link" href="index.php">Etusivu</a>
	          		</li>
		          	<li class="nav-item">
	            		<a class="nav-link" href="tilastot.php">Tilastot<span class="sr-only">(current)</span></a>
	          		</li>
	          			<li class="nav-item">
	            		<a class="nav-link" href="haeSuoritusJSON.html">Hae</a>
	          		</li>
	          		<li class="nav-item">
	            		<a class="nav-link" href="asetukset.php">Asetukset</a>
	          		</li>
	        	</ul>
		      </div>
		    </nav>

		    <div class="container">
			  <h2>Tilastot</h2>         
			  <table class="table table-striped">
			    <thead>
			    	<tr>
				        <th>Liikkeen nimi</th>
				        <th>Painot</th>
				        <th>Toistot</th>
				        <th>Sarjat</th>
				        <!--<th>Huomiot</th>-->
				        <th>Aika</th>
				        <th></th>
			      	</tr>
			    </thead>
			    <tbody>
				    <?php
						try {
						require_once "suoritusPDO.php";

						$kantakasittely = new suoritusPDO();
						$rivit = $kantakasittely->listaaSuoritukset();

						foreach ($rivit as $suoritus) {
							print("<tr><td>" . $suoritus->getLiikkeet()) . "</td>";
							print("<td>" . $suoritus->getPainot()) . "</td>";
							print("<td>" . $suoritus->getToistot()) . "</td>";
							print("<td>" . $suoritus->getSarjat()) . "</td>";
							//print("<td>" . $suoritus->getHuomiot()) . "</td>";
							print("<td>" . $suoritus->getAika() . "</td>");
							print("<td><form action='tilastot.php' method='post'>
									  <input type='hidden' name='id' value=" . $suoritus->getId() . ">
									  <input type='submit' name='nayta' value='Näytä'>
									  <input type='submit' name='poista' value='Poista'>
								</form></td></tr>");
						}

						}	catch (Exception $error) {
							print($error->getMessage());
						}
					?>
			    </tbody>
			  </table>
			</div>
		</div>
	</body>
</html>