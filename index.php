<!DOCTYPE html>

<?php
require_once 'suoritus.php';

session_start();

$suoritus = "";

if (isset($_POST["lisaa"])) {
	$suoritus = new Suoritus($_POST["painot"],
					$_POST["toistot"],
					$_POST["sarjat"],
					$_POST["liikkeenNimi"],
					$_POST["huomioita"]);
	$lukemaVirhe1 = $suoritus->checkPainot();
	$lukemaVirhe2 = $suoritus->checkToistot();
	$lukemaVirhe3 = $suoritus->checkSarjat();
	$lukemaVirhe4 = $suoritus->checkLiike();
	$lukemaVirhe5 = $suoritus->checkHuomiot();
	
	if ($lukemaVirhe1 == 0 && $lukemaVirhe2 == 0 && $lukemaVirhe3 == 0 && $lukemaVirhe4 == 0 && $lukemaVirhe5 == 0) {
		$_SESSION["suoritus"] = $suoritus;
		session_write_close();
		header("location: naytaSuoritus.php");
		exit;
	}
} elseif (isset($_POST["peruuta"])) {
	unset($_SESSION["suoritus"]);
	header("location: index.php");
	exit;
} else {
	if (isset($_SESSION["suoritus"])) {
		$suoritus = $_SESSION["suoritus"];
	} else {
		$suoritus = new Suoritus();
	}
		$lukemaVirhe1 = 0;
		$lukemaVirhe2 = 0;
		$lukemaVirhe3 = 0;
		$lukemaVirhe4 = 0;
		$lukemaVirhe5 = 0;
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

		<title>Kuntosalitreenit - Etusivu</title>
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
	            		<a class="nav-link" href="index.php">Etusivu<span class="sr-only">(current)</span></a>
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
		    if (isset($_COOKIE["kayttaja"])) {
  				print("Alahan treenaamaan, " . $_COOKIE["kayttaja"] . "!<br>");
			}
		    if (isset($_COOKIE["suoritus"]) && isset($_COOKIE["aika"])) {
				print("Viimeisin lisäämäsi liike oli " . $_COOKIE["suoritus"] .
				" " . $_COOKIE["aika"] . ".");
			}
			?>
			<br><br>
			<form action="index.php" method="post">
				<div class="form-group row">
			      	<label class="col-sm-2 col-form-label" for="liikkeenNimi">Liike</label>
			      	<div class="col-sm-2">
				      	<select class="custom-select mr-sm-2" name="liikkeenNimi" id="liikkeenNimi">
					        <option value="">Valitse...</option>
			      			<option value="penkki" <?php if ($suoritus->getLiikkeet() == "penkki") {
			      				print("selected"); } ?>>Penkki</option>
						    <option value="mave" <?php if ($suoritus->getLiikkeet() == "mave") {
			      				print("selected"); } ?>>Mave</option>
						    <option value="kyykky" <?php if ($suoritus->getLiikkeet() == "kyykky") {
			      				print("selected"); } ?>>Kyykky</option>
						    <option value="askelkyykky" <?php if ($suoritus->getLiikkeet() == "askelkyykky") {
			      				print("selected"); } ?>>Askelkyykky</option>
				      	</select>				   
			    	</div>
			    	<div class="col-sm-8">
			    		<?php print("<small>" . $suoritus->getError($lukemaVirhe4) . "</small>");?>
			    	</div>
				</div>

				<div class="form-group row">
   		 			<label for="painot" class="col-sm-2 col-form-label">Painot</label>
    				<div class="col-sm-1">
      					<input type="text" class="form-control" name="painot" id="painot" value="<?php print(htmlentities($suoritus->getPainot(), ENT_QUOTES, "UTF-8"));?>" >
    				</div>
    				<div class="col-sm-8">
    					<?php print("<small>" . $suoritus->getError($lukemaVirhe1) . "</small>");?>
    				</div>
  				</div>

  				<div class="form-group row">
   		 			<label for="toistot" class="col-sm-2 col-form-label">Toistot</label>
    				<div class="col-sm-1">
      					<input type="text" class="form-control" name="toistot" id="toistot" value="<?php print(htmlentities($suoritus->getToistot(), ENT_QUOTES, "UTF-8"));?>" >
    				</div>
    				<div class="col-sm-8">
			    		<?php print("<small>" . $suoritus->getError($lukemaVirhe2) . "</small>");?>
			    	</div>
  				</div>

  				<div class="form-group row">
   		 			<label for="sarjat" class="col-sm-2 col-form-label">Sarjat</label>
    				<div class="col-sm-1">
      					<input type="text" class="form-control" name="sarjat" id="sarjat" value="<?php print(htmlentities($suoritus->getSarjat(), ENT_QUOTES, "UTF-8"));?>" >
    				</div>
    				<div class="col-sm-8">
			    		<?php print("<small>" . $suoritus->getError($lukemaVirhe3) . "</small>");?>
			    	</div>
  				</div>

  				<div class="form-group row">
   		 			<label for="huomioita" class="col-sm-2 col-form-label">Huomioita</label>
    				<div class="col-sm-10">
      					<textarea class="form-control" name="huomioita" id="huomioita"><?php print(htmlentities($suoritus->getHuomiot(), ENT_QUOTES, "UTF-8"));?> 
      					</textarea>
    				</div>
    				<div class="col-sm-8">
			    		<?php print("<small>" . $suoritus->getError($lukemaVirhe5) . "</small>");?>
			    	</div>
  				</div>

				<input class="btn btn-info" type="submit" name="lisaa"
				value="Lisää">

				<input class="btn btn-info" type="submit" name="peruuta"
				value="Peruuta">
			</form>
		</div>
	</body>
</html>
