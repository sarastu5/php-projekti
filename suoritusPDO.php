<?php 

require_once 'suoritus.php';

class suoritusPDO {
	private $db;
	private $lkm;

	function __construct($dsn="mysql:host=localhost;dbname=a1602823",
	$user="root", $password="salainen") { //luodaan luokan olio ja muodostetaan yhteys kantaan
		$this->db = new PDO($dsn, $user, $password);
		$this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$this->lkm = 0;
	}

	function lisaaSuoritus($suoritus) {
		$sql = "INSERT INTO suoritukset (liike, painot, toistot, sarjat, huomiot, aika)
		VALUES (:liike, :painot, :toistot, :sarjat, :huomiot, :aika)";

		if (! $stmt = $this->db->prepare($sql)) {
			$virhe = $this->db->errorInfo();
			throw new PDOException($virhe[2], $virhe[1]);
		}

		$stmt->bindValue(":liike", utf8_decode($suoritus->getLiikkeet()), PDO::PARAM_STR);
		$stmt->bindValue(":painot", $suoritus->getPainot(), PDO::PARAM_INT);
		$stmt->bindValue(":toistot", $suoritus->getToistot(), PDO::PARAM_INT);
		$stmt->bindValue(":sarjat", $suoritus->getSarjat(), PDO::PARAM_INT);
		$stmt->bindValue(":huomiot", utf8_decode($suoritus->getHuomiot()), PDO::PARAM_STR);
		$stmt->bindValue(":aika", $suoritus->getAika(), PDO::PARAM_STR);

		if (! $stmt->execute()) {
			$virhe = $stmt->errorInfo();
			if ($virhe[0] == "HY093") {
				$virhe[2] = "Invalid parameter";
			}
			throw new PDOException($virhe[2], $virhe[1]);
		}

		$this->lkm = 1;
		return $this->db->lastInsertId();
	}

	public function listaaSuoritukset() { //listaa kaikki suoritukset
		$sql = "SELECT id, liike, painot, toistot, sarjat, huomiot, aika FROM suoritukset"; //SQL-kysely
		if (! $stmt = $this->db->prepare($sql)) {
			$virhe = $this->db->errorInfo();
			throw new PDOException($virhe[2], $virhe[1]);
		}

		if (! $stmt->execute()) {
			$virhe = $stmt->errorInfo();
			throw new PDOException($virhe[2], $virhe[1]);
		}

		$tulos = array();

		while ($row = $stmt->fetchObject()) {
			$suoritus = new Suoritus(); //tehdään uusi Suoritus-olio
			$suoritus->setId($row->id);
			$suoritus->setLiikkeet(utf8_encode($row->liike));
			$suoritus->setPainot($row->painot);
			$suoritus->setToistot($row->toistot);
			$suoritus->setSarjat($row->sarjat);
			$suoritus->setHuomiot(utf8_encode($row->huomiot));
			$suoritus->setAika($row->aika);
			$tulos[] = $suoritus; //laitetaan haun tulokset taulukkoon
		}
		$this->lkm = $stmt->rowCount(); //laskee rivit
		return $tulos; //palauttaa taulukon
	} // listaaSuoritukset()


	public function naytaSuoritus($id) {
		$sql = "SELECT id, liike, painot, toistot, sarjat, huomiot, aika FROM suoritukset WHERE id = :id";

		if (! $stmt = $this->db->prepare($sql)) {
			$virhe = $this->db->errorInfo();
			throw new PDOException($virhe[2], $virhe[1]);
		}

		$stmt->bindValue(":id", $id, PDO::PARAM_INT);

		if (! $stmt->execute()) {
			$virhe = $stmt->errorInfo();
			throw new PDOException($virhe[2], $virhe[1]);
		}

		$row = $stmt->fetchObject();
		$suoritus = new Suoritus(); //tehdään uusi Suoritus-olio
		$suoritus->setId($row->id);
		$suoritus->setLiikkeet(utf8_encode($row->liike));
		$suoritus->setPainot($row->painot);
		$suoritus->setToistot($row->toistot);
		$suoritus->setSarjat($row->sarjat);
		$suoritus->setHuomiot(utf8_encode($row->huomiot));
		$suoritus->setAika($row->aika);

		return $suoritus; //palauttaa suorituksen kaikkine tietoineen
	}

	public function haeSuoritus($suoritus) { //suoritusten haku
		$sql = "SELECT id, liike, painot, toistot, sarjat, huomiot, aika FROM suoritukset WHERE liike LIKE :suoritus"; //SQL-kysely
		if (! $stmt = $this->db->prepare($sql)) {
			$virhe = $this->db->errorInfo();
			throw new PDOException($virhe[2], $virhe[1]);
		}

		$stmt->bindValue(":suoritus", utf8_encode('%' . $suoritus . '%'), PDO::PARAM_STR);

		if (! $stmt->execute()) {
			$virhe = $stmt->errorInfo();
			throw new PDOException($virhe[2], $virhe[1]);
		}

		$tulos = array();

		while ($row = $stmt->fetchObject()) {
			$suoritus = new Suoritus(); //tehdään uusi Suoritus-olio
			$suoritus->setId($row->id);
			$suoritus->setLiikkeet(utf8_encode($row->liike));
			$suoritus->setPainot($row->painot);
			$suoritus->setToistot($row->toistot);
			$suoritus->setSarjat($row->sarjat);
			$suoritus->setHuomiot(utf8_encode($row->huomiot));
			$suoritus->setAika($row->aika);
			$tulos[] = $suoritus; //laitetaan haun tulokset taulukkoon
		}
		$this->lkm = $stmt->rowCount(); //laskee rivit
		return $tulos; //palauttaa taulukon
	} // haeSuoritus()

	function poistaSuoritus($id) { //parametrina poistettava id
		$sql = "DELETE FROM suoritukset WHERE id = :id";

		if (! $stmt = $this->db->prepare($sql)) {
			$virhe = $this->db->errorInfo();
			throw new PDOException($virhe[2], $virhe[1]);
		}

		$stmt->bindValue(":id", $id, PDO::PARAM_INT);

		if (! $stmt->execute()) {
			$virhe = $stmt->errorInfo();
			throw new PDOException($virhe[2], $virhe[1]);
		}
	} 
}// class suoritusPDO
?>