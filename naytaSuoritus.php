<!DOCTYPE html>
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

		<title>Kuntosalitreenit - Näytä suoritus</title>
	</head>

	<body>
		<div class="container">
			<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
      		<a class="navbar-brand" href="#">Kuntosaliträkkäys</a>
      		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        		<span class="navbar-toggler-icon"></span>
      		</button>
	      	<div class="collapse navbar-collapse" id="navbarCollapse">
	        	<ul class="navbar-nav mr-auto">
	          		<li class="nav-item active">
	            		<a class="nav-link" href="index.php">Etusivu</a>
	          		</li>
		          	<li class="nav-item">
	            		<a class="nav-link" href="tilastot.php">Tilastot</a>
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

		    <?php
			require_once "suoritus.php";
			session_start();

			if (isset($_SESSION["suoritus"])) {
				$suoritus = $_SESSION["suoritus"];
			} else {
				$suoritus = new Suoritus();
			}

			if (isset($_POST["korjaa"])) {
				header("location: index.php");
				exit;
			}

			if (isset($_POST["tallenna"])) {
				try {
					require_once "suoritusPDO.php";
					$kantakasittely = new suoritusPDO();
					$id = $kantakasittely->lisaaSuoritus($suoritus);

					header("location: index.php");
					unset($_SESSION["suoritus"]);
					exit;
					
				} catch (Exception $error) {
					print($error->getMessage());
				}
			}

			if (isset($_POST["peruuta"])) {
				header("location: index.php");
				unset($_SESSION["suoritus"]);
				exit;
			}
			?>

		    <h2>Syötit seuraavan liikkeen:</h2>

			<?php
			print("<p>Liike: " . $suoritus->getLiikkeet());
			print("<br>Painot: " . $suoritus->getPainot());
			print("<br>Toistot: " . $suoritus->getToistot());
			print("<br>Sarjat: " . $suoritus->getSarjat());
			print("<br>Huomiot: " . $suoritus->getHuomiot() . "</p>");

			setcookie("suoritus", $suoritus->getLiikkeet(), time()+60*60*24*30);
			$aika = date("d.m.Y G:i", time());
			setcookie("aika", $aika, time()+60*60*24*30);

			?>

			<form action="naytaSuoritus.php" method="post">
				<input class="btn btn-info" type="submit" name="tallenna"
					value="Tallenna">
				<input class="btn btn-info" type="submit" name="korjaa"
					value="Korjaa">
				<input class="btn btn-info" type="submit" name="peruuta"
					value="Peruuta">
			</form>
		</div>