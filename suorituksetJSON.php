<?php
try {
	require_once "suoritusPDO.php";
	$kantakasittely = new suoritusPDO();

	if (isset($_GET["suoritus"])) {
		$tulos = $kantakasittely->haeSuoritus($_GET["suoritus"]);
		print(json_encode($tulos));
	} else {
		$tulos = $kantakasittely->listaaSuoritukset();
		print(json_encode($tulos));
	}

} catch (Exception $error) {
	print("Epäonnistui");
}
?>