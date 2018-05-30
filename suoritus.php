<?php 

class Suoritus implements JsonSerializable {
	private $id;
	private $painot;
	private $toistot;
	private $sarjat;
	private $liike;
	private $huomiot;
	private $aika;

	private static $virhelista = array (
					0 => "",
					1 => "Kenttä on pakollinen",
					2 => "Virheellinen luku",
					3 => "Kentässä on liikaa merkkejä");
	

	function __construct($painot="", $toistot="", $sarjat="", $liike="", $huomiot="", $id=0) {

		$this->painot = trim($painot);
		$this->toistot = trim($toistot);
		$this->sarjat = trim($sarjat);
		$this->liike = trim($liike);
		$this->huomiot = trim($huomiot);
	}

	public function setId($id) {
		$this->id = trim($id);
	}

	public function setPainot($painot) {
		$this->painot = trim($painot);
	}


	public function setToistot($toistot) {
		$this->toistot = trim($toistot);
	}

	public function setSarjat($sarjat) {
		$this->sarjat = trim($sarjat);
	}

	public function setLiikkeet($liike) {
		$this->liike = trim($liike);
	}

	public function setHuomiot($huomiot) {
		$this->huomiot = trim($huomiot);
	}

	public function setAika($aika) {
		$this->aika = trim($aika);
	}

	public function getId() {
		return $this->id;
	}

	public function getPainot() {
		return $this->painot;
	}

	public function getToistot() {
		return $this->toistot;
	}

	public function getSarjat() {
		return $this->sarjat;
	}

	public function getLiikkeet() {
		return $this->liike;
	}

	public function getHuomiot() {
		return $this->huomiot;
	}

	public function getAika() {
		return $this->aika;
	}

	public function checkLiike() {
		if (empty($this->liike)) {
      		return 1;
		}
		return 0;
	}

	public function checkPainot() {
		 if (empty($this->toistot)) {
      		return 1;
		} else if (preg_match('/[^0-9]/', $this->toistot)) {
			return 2;
		} else if ($this->painot == 0) {
			return 2;
		}
		return 0;
	}

	public function checkToistot() {
		if (empty($this->toistot)) {
      		return 1;
		} else if (preg_match('/[^0-9]/', $this->toistot)) {
			return 2;
		} else if ($this->toistot == 0) {
			return 2;
		}
		return 0;
	}

	public function checkSarjat() {
		if (strlen($this->sarjat) == 0) {
      		return 1;
		} else if (preg_match('/[^0-9]/', $this->sarjat)) {
			return 2;
		} else if ($this->sarjat == 0) {
			return 2;
		}	
		return 0;
	}

	public function checkHuomiot() {
		if (strlen($this->huomiot) >= 100) {
      		return 3;
		}
		return 0;
	}

	public static function getError($virhekoodi) {
		return Suoritus::$virhelista[$virhekoodi];
	}

	public function jsonSerialize() {
		return array (
			"id" => $this->id,
			"liike" => $this->liike,
			"painot" => $this->painot,
			"toistot" => $this->toistot,
			"sarjat" => $this->sarjat,
			"aika" => $this->aika,
			"huomiot" => $this->huomiot
		);
	}
}

?>