<!DOCTYPE html>

<html lang="fi">
	<head>
		 <meta charset="utf-8"> 
		 <meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<!-- Popper JS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

		<title>Kuntosalitreenit - Asetukset</title>
	</head>

	<?php
		if (isset($_POST["tallenna"])) {
			setcookie("kayttaja", $_POST["nimi"], time() + 30*24*60*60);
			header("location: index.php");
			exit;
		}

		$kayttaja = "";
		if (isset($_COOKIE["kayttaja"])) {
			$kayttaja = $_COOKIE["kayttaja"];
		}
	?>

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
	            		<a class="nav-link" href="asetukset.php">Asetukset<span class="sr-only">(current)</span></a>
	          		</li>
	        	</ul>
		      </div>
		    </nav>

			<form action="asetukset.php" method="post">
	  			<div class="form-group row">
	    			<label class="col-form-label col-sm-2" for="nimi">Nimi:</label>
	    			<div class="col-sm-4">
	     				<input type="text" class="form-control" id="nimi" name="nimi" value="<?php print(htmlentities($kayttaja, ENT_QUOTES, "UTF-8"));?>">
	    			</div>
	    			<input class="btn btn-info" type="submit" name="tallenna" value="Tallenna">
	    		</div>
	    	</form>
		</div>
	</body>
</html>
